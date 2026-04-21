@props([
    'cards' => [
        [
            'title' => 'Post-Matric Scholarship Program',
            'description' => 'Financial support for eligible students to continue higher education with reduced barriers and timely assistance.',
            'tags' => 'Scholarship, Education, Student Support',
        ],
    ],
    'buttonText' => null,
    'createRoute' => null,
])

<section class="space-y-6">
    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
        <x-cms.department-website-cms.schemes.schemes-form
            :cards="$cards"
            :button-text="$buttonText"
            :create-route="$createRoute" />
        <x-cms.department-website-cms.schemes.schemes-preview :cards="$cards" />
    </div>
</section>
