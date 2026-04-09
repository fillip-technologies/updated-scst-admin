@extends('layouts.app')

@section('content')
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
    <div class="p-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Manage Subjects</h1>

        <!-- ADD SUBJECT -->

        <form action="{{SchoolLogin() ?  route('create.subject') :  route('staff.create.subject')  }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ TeacherLog()->school_id ?? SchoolLogin()->id }}">
            <input type="hidden" name="teacher_id" value="{{ TeacherLog()->staff_id  ?? 0 }}">
            <div class="flex gap-2 mb-6">
                <input name="subject" type="text" placeholder="Enter Subject Name" class="border px-4 py-2 rounded w-full">

                <button type="submit" class="bg-blue-600 text-white px-6 rounded">
                    Add
                </button>
            </div>

        </form>

        <!-- SUBJECT LIST -->
        <div class="flex flex-wrap gap-2">
            @foreach ($subject as $sub)
                <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full flex items-center gap-2">

                    {{ $sub->subjects }}
                    <form action="{{SchoolLogin() ?  route('delete.subject', $sub->id) : route('staff.delete.subject', $sub->id)  }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 font-bold">
                            ✕
                        </button>
                    </form>


                </div>
            @endforeach
        </div>
    </div>
@endsection
