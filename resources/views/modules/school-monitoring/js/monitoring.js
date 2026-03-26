document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('[data-school-monitoring]');

    if (!page) {
        return;
    }

    const drawer = document.querySelector('[data-school-drawer]');
    const visibleCount = document.querySelector('[data-visible-count]');
    const emptyStates = document.querySelectorAll('[data-empty-state]');
    const searchInput = document.querySelector('[data-filter-search]');
    const districtInput = document.querySelector('[data-filter-district]');
    const dropoutInput = document.querySelector('[data-filter-dropout]');
    const performanceInput = document.querySelector('[data-filter-performance]');
    const statusInput = document.querySelector('[data-filter-status]');
    const clearButton = document.querySelector('[data-clear-filters]');
    const noticeMessage = drawer ? drawer.querySelector('textarea[name="message"]') : null;
    const cards = Array.from(document.querySelectorAll('[data-school-card]'));

    const schoolData = cards.map(function (card) {
        return {
            element: card,
            payload: JSON.parse(card.dataset.school || '{}')
        };
    });

    const drawerFields = drawer ? {
        name: drawer.querySelector('[data-drawer-name]'),
        district: drawer.querySelector('[data-drawer-district]'),
        students: drawer.querySelector('[data-drawer-students]'),
        teachers: drawer.querySelector('[data-drawer-teachers]'),
        dropouts: drawer.querySelector('[data-drawer-dropouts]'),
        passPercentage: drawer.querySelector('[data-drawer-pass]'),
        attendance: drawer.querySelector('[data-drawer-attendance]'),
        reportTime: drawer.querySelector('[data-drawer-report-time]'),
        issues: drawer.querySelector('[data-drawer-issues]'),
        books: drawer.querySelector('[data-drawer-books]'),
        meals: drawer.querySelector('[data-drawer-meals]'),
        schoolId: drawer.querySelector('[data-notice-school-id]'),
        fullReport: drawer.querySelector('[data-full-report-link]'),
        triggerNotice: drawer.querySelector('[data-trigger-notice]')
    } : null;

    function normalise(value) {
        return String(value || '').toLowerCase().trim();
    }

    function renderDrawer(school) {
        if (!drawer || !drawerFields) {
            return;
        }

        drawerFields.name.textContent = school.name || 'School Details';
        drawerFields.district.textContent = school.district || '';
        drawerFields.students.textContent = school.students_count ?? 0;
        drawerFields.teachers.textContent = school.teachers_count ?? 0;
        drawerFields.dropouts.textContent = school.dropout_count ?? 0;
        drawerFields.passPercentage.textContent = (school.pass_percentage ?? 0) + '%';
        drawerFields.attendance.textContent = (school.attendance_percentage ?? 0) + '%';
        drawerFields.reportTime.textContent = school.last_report_time || '-';
        drawerFields.books.textContent = (school.stock_info && school.stock_info.books) || 'Data not available';
        drawerFields.meals.textContent = (school.stock_info && school.stock_info.meals) || 'Data not available';
        drawerFields.schoolId.value = school.id || '';
        drawerFields.fullReport.setAttribute('href', school.report_url || '#');

        drawerFields.issues.innerHTML = '';
        (school.issues || ['No critical issues reported.']).forEach(function (issue) {
            const item = document.createElement('li');
            item.className = 'rounded-md bg-gray-50 p-3';
            item.textContent = issue;
            drawerFields.issues.appendChild(item);
        });

        drawer.classList.remove('hidden');
    }

    function closeDrawer() {
        if (drawer) {
            drawer.classList.add('hidden');
        }
    }

    function matchesFilters(school) {
        const search = normalise(searchInput && searchInput.value);
        const district = normalise(districtInput && districtInput.value);
        const status = normalise(statusInput && statusInput.value);
        const dropout = Number(dropoutInput && dropoutInput.value ? dropoutInput.value : '');
        const performance = Number(performanceInput && performanceInput.value ? performanceInput.value : '');
        const text = normalise((school.name || '') + ' ' + (school.district || ''));

        if (search && !text.includes(search)) {
            return false;
        }

        if (district && normalise(school.district) !== district) {
            return false;
        }

        if (status && normalise(school.reporting_status) !== status) {
            return false;
        }

        if (!Number.isNaN(dropout) && dropoutInput.value !== '' && Number(school.dropout_count || 0) <= dropout) {
            return false;
        }

        if (!Number.isNaN(performance) && performanceInput.value !== '' && Number(school.pass_percentage || 0) >= performance) {
            return false;
        }

        return true;
    }

    function applyFilters() {
        let visible = 0;

        schoolData.forEach(function (school) {
            const match = matchesFilters(school.payload);
            school.element.classList.toggle('hidden', !match);

            if (match) {
                visible += 1;
            }
        });

        if (visibleCount) {
            visibleCount.textContent = String(visible);
        }

        emptyStates.forEach(function (state) {
            state.classList.toggle('hidden', visible !== 0);
        });
    }

    cards.forEach(function (card) {
        const payload = JSON.parse(card.dataset.school || '{}');
        const detailsButton = card.querySelector('[data-view-details]');
        const actionButton = card.querySelector('[data-school-action]');

        [detailsButton, actionButton].forEach(function (button) {
            if (!button) {
                return;
            }

            button.addEventListener('click', function () {
                renderDrawer(payload);
            });
        });
    });

    document.querySelectorAll('[data-alert-filter]').forEach(function (button) {
        button.addEventListener('click', function () {
            const filter = button.getAttribute('data-alert-filter');

            if (filter === 'not_reported' || filter === 'delayed' || filter === 'on_time') {
                statusInput.value = filter;
            } else if (filter === 'dropout') {
                dropoutInput.value = '0';
            } else if (filter === 'performance') {
                performanceInput.value = '60';
            } else {
                statusInput.value = '';
                dropoutInput.value = '';
                performanceInput.value = '';
            }

            applyFilters();
        });
    });

    [searchInput, districtInput, dropoutInput, performanceInput, statusInput].forEach(function (field) {
        if (!field) {
            return;
        }

        field.addEventListener('input', applyFilters);
        field.addEventListener('change', applyFilters);
    });

    if (clearButton) {
        clearButton.addEventListener('click', function () {
            [searchInput, districtInput, dropoutInput, performanceInput, statusInput].forEach(function (field) {
                if (field) {
                    field.value = '';
                }
            });

            applyFilters();
            closeDrawer();
        });
    }

    document.querySelector('[data-close-drawer]')?.addEventListener('click', closeDrawer);

    drawerFields?.triggerNotice?.addEventListener('click', function () {
        if (noticeMessage) {
            noticeMessage.focus();
        }
    });

    if (window.Chart) {
        const chartElement = document.getElementById('monitoringStatusChart');

        if (chartElement) {
            const counts = {
                onTime: schoolData.filter(function (item) { return item.payload.reporting_status === 'on_time'; }).length,
                delayed: schoolData.filter(function (item) { return item.payload.reporting_status === 'delayed'; }).length,
                notReported: schoolData.filter(function (item) { return item.payload.reporting_status === 'not_reported'; }).length
            };

            new window.Chart(chartElement, {
                type: 'bar',
                data: {
                    labels: ['On Time', 'Delayed', 'Not Reported'],
                    datasets: [{
                        label: 'Schools',
                        data: [counts.onTime, counts.delayed, counts.notReported],
                        backgroundColor: ['#22c55e', '#eab308', '#ef4444']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
    }

    applyFilters();
});
