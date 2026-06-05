@extends('layouts.app')

@section('content')
    <style>
        /* ── Brand tokens ── */
        :root {
            --primary-900: #0b3c5d;
            --primary-800: #123B52;
            --primary-700: #164B68;
            --primary-600: #1D5F80;
            --accent-500: #F4B400;
            --accent-600: #E09E00;
        }

        /* ── Form card ── */
        .syl-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(11, 60, 93, .10);
            border: 1px solid #e4edf5;
        }

        .syl-header {
            background: linear-gradient(135deg, var(--primary-900) 0%, var(--primary-700) 100%);
            border-radius: 16px 16px 0 0;
            padding: 22px 28px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .syl-header-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(244, 180, 0, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ── Labels / Inputs ── */
        .syl-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--primary-800);
            margin-bottom: 6px;
        }

        .syl-input,
        .syl-select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #d1dde8;
            border-radius: 10px;
            font-size: 14px;
            color: #1e293b;
            background: #f8fafc;
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
        }

        .syl-input:focus,
        .syl-select:focus {
            border-color: var(--primary-600);
            box-shadow: 0 0 0 3px rgba(29, 95, 128, .12);
            background: #fff;
        }

        .syl-input.error,
        .syl-select.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .10);
        }

        .select-wrap {
            position: relative;
        }

        .select-wrap::after {
            content: '';
            pointer-events: none;
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #6b7280;
        }

        /* ── Submit Button ── */
        .syl-btn-primary {
            background: linear-gradient(135deg, var(--primary-800), var(--primary-600));
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 28px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform .15s, box-shadow .15s, opacity .15s;
            box-shadow: 0 4px 14px rgba(11, 60, 93, .25);
        }

        .syl-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(11, 60, 93, .35);
            opacity: .93;
        }

        .syl-btn-primary:active {
            transform: translateY(0);
        }

        .syl-btn-reset {
            background: #f1f5f9;
            color: #475569;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 22px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background .15s;
        }

        .syl-btn-reset:hover {
            background: #e2e8f0;
        }

        /* ── Table ── */
        .syl-table-wrap {
            overflow-x: auto;
            border-radius: 0 0 16px 16px;
        }

        .syl-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .syl-table thead tr {
            background: linear-gradient(135deg, var(--primary-900), var(--primary-700));
            color: #fff;
        }

        .syl-table thead th {
            padding: 13px 16px;
            font-weight: 600;
            font-size: 11.5px;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
            text-align: left;
        }

        .syl-table tbody tr {
            border-bottom: 1px solid #eef2f7;
            transition: background .15s;
        }

        .syl-table tbody tr:last-child {
            border-bottom: none;
        }

        .syl-table tbody tr:hover {
            background: #f0f7ff;
        }

        .syl-table td {
            padding: 13px 16px;
            color: #1e293b;
            vertical-align: middle;
        }

        /* ── Edit Button ── */
        .btn-edit {
            background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 2px 8px rgba(244, 180, 0, .35);
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(244, 180, 0, .5);
        }

        .btn-delete {
            background: #fff0f0;
            color: #dc2626;
            border: 1.5px solid #fecaca;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background .15s;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* ── Edit Modal ── */
        .edit-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 60, 93, .45);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 16px;
        }

        .edit-modal-overlay.open {
            display: flex;
        }

        .edit-modal {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(11, 60, 93, .25);
            animation: modalSlide .25s ease;
            overflow: hidden;
        }

        .edit-modal-header {
            background: linear-gradient(135deg, var(--primary-900), var(--primary-700));
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edit-close {
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background .15s;
        }

        .edit-close:hover {
            background: rgba(255, 255, 255, .28);
        }

        @keyframes modalSlide {
            from {
                opacity: 0;
                transform: translateY(-18px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── Misc ── */
        .required-star {
            color: #ef4444;
        }

        .err-msg {
            font-size: 11.5px;
            color: #ef4444;
            margin-top: 4px;
            display: none;
        }

        .err-msg.show {
            display: block;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #94a3b8;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-info {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .section-divider {
            border: none;
            border-top: 1.5px dashed #e2e8f0;
            margin: 4px 0 18px;
        }
    </style>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

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
    <div class="p-3 sm:p-4 lg:p-6 bg-gray-100 min-h-screen">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-book-open-reader" style="color:var(--primary-700)"></i>
                    Syllabus Assignment
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">Assign syllabus to classes with tracking dates</p>
            </div>
            <a href="" class="inline-flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-lg border"
                style="color:var(--primary-700); border-color:var(--primary-600); background:#f0f7fc;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Tracking
            </a>
        </div>

        <!-- ═══════════════════════════ ADD FORM CARD ═══════════════════════════ -->
        <div class="syl-card mb-8">

            <!-- Card Header -->
            <div class="syl-header">
                <div class="syl-header-icon">
                    <i class="fa-solid fa-plus" style="color:var(--accent-500); font-size:18px;"></i>
                </div>
                <div>
                    <h2 class="text-white font-semibold text-base">Add Syllabus Entry</h2>
                    <p class="text-blue-200 text-xs mt-0.5">Fill all required fields to assign syllabus</p>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-6 sm:p-8">
                <form id="sylForm" action="{{ route('add.syllabus.track') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Row 1: Class + Subject -->
                    <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:var(--primary-700)">
                        Class & Subject Details
                    </p>
                    <hr class="section-divider">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">

                        <!-- Class -->
                        {{-- <div>
                            <label class="syl-label" for="syl_class">
                                Districts <span class="required-star">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="district" name="district" class="syl-select">
                                    <option value="">— Select District —</option>
                                    @foreach (getDisc() as $dis)
                                        <option value="{{ $dis->district }}">{{ $dis->district }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <p class="err-msg" id="err_class">Please select a class.</p>
                        </div> --}}

                        {{-- <div>
                            <label class="syl-label" for="syl_class">
                                Schools <span class="required-star">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="school_field" name="school_id[]" class="syl-select">
                                </select>
                            </div>
                            <p class="err-msg" id="err_class">Please select a class.</p>
                        </div> --}}

                        <!-- Subject -->
                        <div>
                            <label class="syl-label" for="syl_subject">
                                Calsses <span class="required-star">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="class_field" name="class_name" class="syl-select">
                                    <option value="">— Select Class —</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <p class="err-msg" id="err_subject">Please select a subject.</p>
                        </div>

                        <div>
                            <label class="syl-label" for="syl_subject">
                                Subjects <span class="required-star">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="syl_subject" name="subject" class="syl-select">
                                    <option value="">— Select Subject —</option>
                                    @foreach (all_syllabus() as $subject)
                                        <option value="{{ $subject }}">{{ $subject }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="err-msg" id="err_subject">Please select a subject.</p>
                        </div>
                        <div>
                            <label class="syl-label" for="syl_completion_date">
                                File Imports <span class="required-star">*</span>
                            </label>
                            <input type="file" id="syl_completion_date" name="file" class="syl-input">
                            <p class="err-msg" id="err_completion_date">Please select a completion date.</p>
                        </div>
                    </div>

                    <p class="text-xs font-bold uppercase tracking-widest mb-2 mt-6" style="color:var(--primary-700)">
                        Dates
                    </p>
                    <hr class="section-divider">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">



                        <div>
                            <label class="syl-label" for="syl_assign_date">
                                Syllabus Assign Date <span class="required-star">*</span>
                            </label>
                            <input type="date" id="syl_assign_date" name="assign_date" class="syl-input">
                            <p class="err-msg" id="err_assign_date">Please select an assign date.</p>
                        </div>


                        <div>
                            <label class="syl-label" for="syl_completion_date">
                                Expected Completion Date <span class="required-star">*</span>
                            </label>
                            <input type="date" id="syl_completion_date" name="completion_date" class="syl-input">
                            <p class="err-msg" id="err_completion_date">Please select a completion date.</p>
                        </div>


                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <button type="submit" class="syl-btn-primary" id="submitBtn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Save Entry
                            </button>
                            <button type="button" class="syl-btn-reset" onclick="resetForm()">
                                <i class="fa-solid fa-rotate-left"></i>
                                Reset
                            </button>
                        </div>

                        <p class="text-blue-500 hover:underline hover:text-red-500"><a
                                href="{{ asset('Syllabus.zip') }}">Download Sampale Files</a></p>
                    </div>



                </form>
            </div>
        </div>


        <div class="syl-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" id="tableCard">

    <!-- Table Header -->
    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-blue-50">
                <i class="fa-solid fa-table-list text-blue-700"></i>
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-base">Assigned Syllabus Entries</h2>
                <p class="text-xs text-gray-500">Click on any class to view its subjects & topics</p>
            </div>
        </div>
        <span id="entryCount" class="bg-gray-100 text-gray-700 px-2.5 py-0.5 rounded-full text-xs font-medium">{{ $paginatedData->total() }} Classes</span>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-700">
                <tr class="border-b border-gray-200">
                    <th class="px-6 py-3 text-left font-semibold w-16">S.No</th>
                    <th class="px-6 py-3 text-left font-semibold w-48">Class</th>
                    <th class="px-6 py-3 text-left font-semibold">Subjects & Topics</th>

                </tr>
            </thead>
            <tbody id="sylTableBody" class="divide-y divide-gray-100">
                @forelse ($paginatedData as $className => $classRecords)
                    @php
                        $groupedBySubject = $classRecords->groupBy('subject_name');
                        $serialNumber = ($paginatedData->currentPage() - 1) * $paginatedData->perPage() + $loop->iteration;
                    @endphp
                    <tr class="border-b border-gray-100">
                        <td class="px-6 py-3 text-gray-700 align-top font-medium">{{ $serialNumber }}</td>
                        <td class="px-6 py-3 align-top">
                            <button onclick="toggleClass('class_{{ $loop->index }}_{{ $paginatedData->currentPage() }}')" class="class-btn inline-flex items-center justify-between w-full gap-2 px-4 py-2.5 rounded-xl bg-primary-800 text-white transition-all shadow-md">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                   Class {{ $className }}
                                </span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" id="icon_class_{{ $loop->index }}_{{ $paginatedData->currentPage() }}"></i>
                            </button>
                        </td>
                        <td class="px-6 py-3">
                            <div id="class_{{ $loop->index }}_{{ $paginatedData->currentPage() }}" class="class-content hidden">
                                <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
                                    @foreach ($groupedBySubject as $subjectName => $topics)
                                        <div class="border-b border-gray-200 last:border-0">
                                            <div class="p-3 bg-white">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <i class="fa-solid fa-book text-indigo-500 text-sm"></i>
                                                    <span class="font-semibold text-gray-800">{{ $subjectName }}</span>
                                                    <span class="text-xs text-gray-400">({{ count($topics) }})</span>
                                                </div>
                                                <div class="flex flex-wrap gap-1.5 ml-6">
                                                    @foreach ($topics as $topic)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-indigo-50 text-indigo-700 border border-indigo-200">
                                                            <i class="fa-regular fa-circle-check mr-1 text-[10px]"></i>
                                                            {{ $topic->topics_name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        {{-- <td class="px-6 py-3 text-center align-top">
                            <button class="text-red-400 hover:text-red-600 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">No Data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($paginatedData->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
            <div class="text-sm text-gray-500">
                Showing {{ $paginatedData->firstItem() }} to {{ $paginatedData->lastItem() }} of {{ $paginatedData->total() }} classes
            </div>
            <div class="flex gap-2">
                @if($paginatedData->onFirstPage())
                    <span class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-400 text-sm cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i> Previous
                    </span>
                @else
                    <a href="{{ $paginatedData->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 hover:bg-indigo-500 hover:text-white transition-colors text-sm">
                        <i class="fa-solid fa-chevron-left"></i> Previous
                    </a>
                @endif

                <div class="flex gap-1">
                    @foreach ($paginatedData->getUrlRange(1, $paginatedData->lastPage()) as $page => $url)
                        @if($page == $paginatedData->currentPage())
                            <span class="px-3 py-1.5 rounded-lg bg-indigo-500 text-white text-sm font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 hover:bg-indigo-500 hover:text-white transition-colors text-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                @if($paginatedData->hasMorePages())
                    <a href="{{ $paginatedData->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 hover:bg-indigo-500 hover:text-white transition-colors text-sm">
                        Next <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-400 text-sm cursor-not-allowed">
                        Next <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>

<script>
    function toggleClass(id) {
        const content = document.getElementById(id);
        const icon = document.getElementById('icon_' + id);

        if (content.classList.contains('hidden')) {
            // Close other open dropdowns on the same page
            document.querySelectorAll('.class-content').forEach(container => {
                if (container.id !== id && !container.classList.contains('hidden')) {
                    container.classList.add('hidden');
                    const otherIconId = 'icon_' + container.id;
                    const otherIcon = document.getElementById(otherIconId);
                    if (otherIcon) {
                        otherIcon.style.transform = 'rotate(0deg)';
                    }
                }
            });

            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>

<style>
    .class-content {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .class-btn {
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.25);
    }

    .class-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
    }
</style>

    </div>
@endsection
