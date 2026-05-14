<div class="rounded-3xl border border-slate-200 shadow-sm">

    <div class="max-w-full overflow-x-auto rounded-3xl">

        <table class="min-w-full whitespace-nowrap divide-y divide-slate-200 text-sm">

            <thead class="bg-slate-50">
                <tr>
                    @forelse ($colums as $colum)
                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            {{ ucfirst($colum) }}
                        </th>
                    @empty
                        <th class="px-5 py-4 text-center text-slate-500">
                            No Columns Found
                        </th>
                    @endforelse
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($report as $row)
                    <tr class="hover:bg-slate-50">

                        @foreach ($colums as $colum)

                            <td class="px-5 py-4 text-slate-700">
                                {{ $row->$colum ?? '-' }}
                            </td>
                        @endforeach

                    </tr>

                @empty
                    <tr>
                        <td colspan="{{ count($colums) }}" class="px-5 py-8 text-center text-slate-500">

                            Please Filters Datas

                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
