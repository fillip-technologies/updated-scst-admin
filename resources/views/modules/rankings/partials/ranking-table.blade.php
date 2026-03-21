<div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">Rank</th>
                <th class="px-6 py-3 text-left">School</th>
                <th class="px-6 py-3 text-left">District</th>
                <th class="px-6 py-3 text-left">Score</th>
                <th class="px-6 py-3 text-left">Trend</th>
                <th class="px-6 py-3 text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">

            @php
            $schools = [
            ['#4','Darbhanga','Darbhanga','89.5','-1'],
            ['#5','Gaya','Gaya','88.4','+3'],
            ['#6','Bhagalpur','Bhagalpur','87.1','-2'],
            ['#7','Purnia','Purnia','86.5','0'],
            ['#8','Munger','Munger','85.9','+1'],
            ['#9','Begusarai','Begusarai','84.2','-3'],
            ['#10','Rohtas','Rohtas','83.7','+2'],
            ];
            @endphp

            @foreach($schools as $s)
            <tr class="hover:bg-gray-50 transition">

                <td class="px-6 py-4 font-medium">{{ $s[0] }}</td>

                <td class="px-6 py-4">
                    Dr. B.R. Ambedkar Residential School, {{ $s[1] }}
                </td>

                <td class="px-6 py-4">{{ $s[2] }}</td>

                <td class="px-6 py-4 font-semibold text-blue-600">
                    {{ $s[3] }}
                </td>

                <td class="px-6 py-4">
                    @if(str_contains($s[4], '+'))
                    <span class="text-green-600 text-sm">▲ {{ $s[4] }}</span>
                    @elseif(str_contains($s[4], '-'))
                    <span class="text-red-600 text-sm">▼ {{ $s[4] }}</span>
                    @else
                    -
                    @endif
                </td>

                <td class="px-6 py-4 text-right">
                    <a href="#" class="text-primary-600 text-sm hover:underline">
                        View Profile
                    </a>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

</div>