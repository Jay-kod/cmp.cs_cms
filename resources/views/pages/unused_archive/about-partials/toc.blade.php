    @php
        $sections = [
            'our-story' => 'Our Story',
            'vision-mission' => 'Vision, Mission & Objectives',
            'core-values' => 'Core Values',
            'programmes' => 'Academic Programmes',
            'departmental-board' => 'Departmental Board',
            'entry-requirements' => 'Entry Requirements',
            'facilities' => 'Facilities & Labs',
            'our-faculty' => 'Our Faculty',
        ];
    @endphp
    <x-sticky-toc :sections="$sections" />
</div>
