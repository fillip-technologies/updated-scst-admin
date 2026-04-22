@php
    $resolvedType = in_array($type ?? 'minister', ['minister', 'secretary', 'ias'], true) ? $type : 'minister';

    $leaders = [
        'minister' => [
            'label' => 'Minister',
            'name' => 'Shri A.K. Verma',
            'designation' => "Hon'ble Minister",
            'message' => 'Empowering every institution with accountable leadership and citizen-first service delivery across the department.',
            'image' => 'https://ui-avatars.com/api/?name=AK+Verma&background=ffffff&color=1f2937&size=256',
        ],
        'secretary' => [
            'label' => 'Secretary',
            'name' => 'Smt. Neha Sinha',
            'designation' => 'Department Secretary',
            'message' => 'Driving policy execution with clarity, speed, and measurable outcomes for every district and service unit.',
            'image' => 'https://ui-avatars.com/api/?name=Neha+Sinha&background=ffffff&color=1f2937&size=256',
        ],
        'ias' => [
            'label' => 'IAS Officer',
            'name' => 'Sri R. Kumar',
            'designation' => 'IAS Officer',
            'message' => 'Strengthening field implementation through data-led planning, transparent governance, and timely public delivery.',
            'image' => 'https://ui-avatars.com/api/?name=R+Kumar&background=ffffff&color=1f2937&size=256',
        ],
    ];

    $leader = $leaders[$resolvedType];
@endphp

<section class="space-y-6">
    <x-cms.department-website-cms.leader.leader-tabs :type="$resolvedType" :route-name="$routeName ?? 'admin.department.cms.leader'" />

    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
        <x-cms.department-website-cms.leader.leader-form :leaderdata="$allleaders" :button-text="$buttonText ?? 'Save'" />
        <x-cms.department-website-cms.leader.leader-preview :leader="$leader" :leaderdata="$allleaders" />
    </div>
</section>
