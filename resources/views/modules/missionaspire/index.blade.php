@extends('layouts.app')

@section('content')
    <div class="space-y-6" data-mission-aspire>
        @include('modules.missionaspire.partials.filter-bar', [
            'districts' => $districts,
            'schools' => $schools,
            'missionOptions' => $missionOptions,
            'filters' => $filters,
        ])

        @include('modules.missionaspire.partials.report-output', [
            'reports' => $reports,
            'filters' => $filters,
        ])
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('[data-mission-form]');
            const district = document.querySelector('#district');
            const districtButton = document.querySelector('#district_button');
            const districtMenu = document.querySelector('#district_menu');
            const districtLabel = document.querySelector('[data-district-label]');
            const school = document.querySelector('#school');
            const reportOutput = document.querySelector('[data-report-table]');
            const selectedDistrict = document.querySelector('[data-selected-district]');
            const selectedSchool = document.querySelector('[data-selected-school]');
            const selectedMission = document.querySelector('[data-selected-mission]');

            function updateSummary() {
                selectedDistrict.textContent = district.value ? `District: ${district.value}` : 'District: Not selected';
                selectedSchool.textContent = school.value && school.selectedOptions.length ?
                    `School: ${school.selectedOptions[0].textContent}` :
                    'School: Not selected';
                selectedMission.textContent = form.mission_aspire.value && form.mission_aspire.selectedOptions.length ?
                    `Mission: ${form.mission_aspire.selectedOptions[0].textContent}` :
                    'Mission: Not selected';
            }

            function closeDistrictMenu() {
                districtMenu.classList.add('hidden');
                districtButton.setAttribute('aria-expanded', 'false');
            }

            function openDistrictMenu() {
                districtMenu.classList.remove('hidden');
                districtButton.setAttribute('aria-expanded', 'true');
            }

            districtButton.addEventListener('click', function() {
                if (districtMenu.classList.contains('hidden')) {
                    openDistrictMenu();
                    return;
                }

                closeDistrictMenu();
            });

            document.querySelectorAll('[data-district-option]').forEach(function(option) {
                option.addEventListener('click', function() {
                    district.value = option.dataset.districtOption;
                    districtLabel.textContent = district.value || 'Select District';
                    closeDistrictMenu();
                    district.dispatchEvent(new Event('change'));
                });
            });

            document.addEventListener('click', function(event) {
                if (!districtButton.contains(event.target) && !districtMenu.contains(event.target)) {
                    closeDistrictMenu();
                }
            });

            async function loadSchools() {
                school.innerHTML = '<option value="">Select School</option>';

                if (!district.value) {
                    updateSummary();
                    return;
                }

                const url = `{{ url('/admin/mission-aspire/schools') }}/${encodeURIComponent(district.value)}`;
                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });
                const result = await response.json();

                result.data.forEach(function(item) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.school_name;
                    school.appendChild(option);
                });

                updateSummary();
            }

            district.addEventListener('change', loadSchools);
            school.addEventListener('change', updateSummary);
            form.mission_aspire.addEventListener('change', updateSummary);

            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                const params = new URLSearchParams(new FormData(form));
                reportOutput.innerHTML = `
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-8 text-center text-sm text-slate-500">
                        Loading Mission Aspire report...
                    </div>
                `;

                try {
                    const response = await fetch(`${form.action}?${params.toString()}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });
                    const result = await response.json();
                    reportOutput.innerHTML = result.html;
                    updateSummary();
                } catch (error) {
                    reportOutput.innerHTML = `
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-8 text-center text-sm text-red-600">
                            Unable to load report data.
                        </div>
                    `;
                }
            });

            updateSummary();
        });
    </script>
@endsection
