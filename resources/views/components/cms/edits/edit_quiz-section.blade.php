@extends('layouts.app')

@section('content')
    @php
        $homeSections = [
            [
                'key' => 'hero',
                'title' => 'Hero',
                'description' => 'Manage the homepage hero banner, school summary details and top-fold preview.',
                'route' => route('school.website-cms.home.hero'),
                'icon' => 'fa-solid fa-images',
            ],
            [
                'key' => 'gallery',
                'title' => 'Gallery',
                'description' => 'Edit the fixed homepage gallery cards and their supporting text.',
                'route' => route('school.website-cms.home.gallery'),
                'icon' => 'fa-solid fa-camera-retro',
            ],
            [
                'key' => 'about',
                'title' => 'About',
                'description' => 'Update the homepage about section content and related preview.',
                'route' => route('school.website-cms.home.about'),
                'icon' => 'fa-solid fa-circle-info',
            ],
            [
                'key' => 'glance',
                'title' => 'School At A Glance',
                'description' => 'Manage the key school statistics highlighted on the homepage.',
                'route' => route('school.website-cms.home.glance'),
                'icon' => 'fa-solid fa-chart-column',
            ],
            [
                'key' => 'infrastructure',
                'title' => 'Infrastructure',
                'description' => 'Control the homepage infrastructure content block and visual presentation.',
                'route' => route('school.website-cms.home.infrastructure'),
                'icon' => 'fa-solid fa-building',
            ],
            [
                'key' => 'activities',
                'title' => 'Activities',
                'description' => 'Maintain activities cards, labels and related homepage content.',
                'route' => route('school.website-cms.home.activities'),
                'icon' => 'fa-solid fa-person-running',
            ],
            [
                'key' => 'quiz',
                'title' => 'Quiz',
                'description' => 'Manage the homepage quiz section and its editable entries.',
                'route' => route('school.website-cms.home.quiz'),
                'icon' => 'fa-solid fa-puzzle-piece',
            ],
            [
                'key' => 'alumni',
                'title' => 'Alumni',
                'description' => 'Add, edit and organize alumni cards shown on the homepage.',
                'route' => route('school.website-cms.home.alumni'),
                'icon' => 'fa-solid fa-user-graduate',
            ],
            [
                'key' => 'faq',
                'title' => 'FAQ',
                'description' => 'Update frequently asked questions and answers for the homepage.',
                'route' => route('school.website-cms.home.faq'),
                'icon' => 'fa-solid fa-comments',
            ],
        ];
    @endphp
    @endphp
    <div x-show="activeTab === 'quiz'" x-transition.opacity.duration.200ms style="display: none;">
        <x-cms.edits.edit_quiz-section />
    </div>
@endsection
