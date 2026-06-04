

@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: "Validation Error",
                html: `<ul>
        @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
        @endforeach
        </ul>
        `,
                showConfirmButton: true,
            })
        </script>
    @endif
    <div class="space-y-6" data-mission-aspire>
        @include('modules.missionaspire.partials.filter-bar')

        @include('modules.missionaspire.partials.report-output', [
            'report' => $reports ?? [],
            'colums' => $datacolum ?? [],
        ])
    </div>
    <script>
        $(document).ready(function() {
            let schoolBox = $("#schooldata").hide();
            let getschool = @json(getSchools());
            $("#district").on('change', function() {
                let value = $(this).val();
                let html = '';
                if (value) {

                    let filteredSchools = getschool.filter(item => item.district == value);

                    html += `
                    <label for="school" class="mb-1 block text-sm text-gray-500">
                        Select School
                    </label>
                    <select
                        id="school"
                        name="school"
                        class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="">Select School</option>
                `;
                    filteredSchools.forEach((item) => {

                        html += `
                        <option value="${item.id}">
                            ${item.school_name}
                        </option>
                    `;
                    });
                    html += `</select>`;
                    schoolBox.html(html).show();
                } else {
                    schoolBox.hide();
                }
            });
        });
    </script>
@endsection
