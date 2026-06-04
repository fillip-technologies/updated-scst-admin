<div class="overflow-hidden rounded-3xl border border-slate-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Code</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">District</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Allocated</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Utilised</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Audit</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Reports Due</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">On Time</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Last Date</th>
                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Dashboard</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($reports as $report)
                    @php
                        $allocated = $report->budget_allocated
                            ?? $report->total_enrolled_students
                            ?? $report->students_tested_anaemia
                            ?? $report->sanctioned_teacher_posts
                            ?? $report->adequate_classrooms
                            ?? $report->total_students
                            ?? $report->ptm_conducted_count
                            ?? '-';

                        $utilised = $report->budget_utilised
                            ?? $report->current_students_enrolled
                            ?? $report->health_screening_covered
                            ?? $report->teachers_posted_total
                            ?? $report->functional_hostel_rooms
                            ?? $report->students_cocurricular
                            ?? $report->parents_attended_last_ptm
                            ?? '-';

                        $audit = $report->audit_status
                            ?? $report->infrastructure_audit_completed
                            ?? $report->safe_drinking_water
                            ?? $report->teacher_training_conducted
                            ?? $report->committee_active
                            ?? '-';

                        $reportsDue = $report->reports_due
                            ?? $report->dropouts_students
                            ?? $report->hospital_visits
                            ?? $report->vacant_teacher_posts
                            ?? $report->functional_toilets
                            ?? $report->eligible_competitive_students
                            ?? $report->grievances_received
                            ?? 0;

                        $onTime = $report->reports_submitted_on_time
                            ?? $report->student_attendance_percentage
                            ?? $report->students_normal_bmi
                            ?? $report->teacher_attendance_percentage
                            ?? $report->smart_classroom_operational
                            ?? $report->students_appearing_competitive
                            ?? $report->grievances_resolved
                            ?? 0;

                        $lastDate = $report->last_submission_date ?? optional($report->updated_at)->format('Y-m-d') ?? '-';
                        $dashboard = $report->dashboard_updated ?? ($report->updated_at ? 'Updated' : '-');

                        if (is_bool($dashboard) || $dashboard === 0 || $dashboard === 1) {
                            $dashboard = $dashboard ? 'Yes' : 'No';
                        }
                    @endphp

                    <tr class="transition hover:bg-slate-50">
                        <td class="px-5 py-4 text-xs font-medium text-slate-500">{{ $report->school_code ?? '-' }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $report->district ?? '-' }}</td>
                        <td class="px-5 py-4 font-medium text-slate-900">{{ $allocated }}</td>
                        <td class="px-5 py-4 font-medium text-green-600">{{ $utilised }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $audit }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $reportsDue }}</td>
                        <td class="px-5 py-4 text-green-600">{{ $onTime }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $lastDate }}</td>
                        <td class="px-5 py-4 text-blue-600">{{ $dashboard }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-8 text-center text-slate-500">
                            No data available
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
