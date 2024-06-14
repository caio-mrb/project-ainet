@php
$mode = $mode ?? 'edit';
$readonly = $mode == 'show';
@endphp
<x-field.input name="abbreviation" label="Abbreviation" width="md" :readonly="$readonly || ($mode == 'edit')" value="{{ $course->abbreviation }}" />
<x-field.select name="type" label="Type of course" width="md" :readonly="$readonly" value="{{ $course->type }}" :options="[
'Degree' => 'Degree',
'Master' => 'Master',
'TESP' => 'TESP'
]" />
<x-field.input name="name" label="Name" :readonly="$readonly" value="{{ $course->name }}" />
<x-field.input name="name_pt" label="Name (Portuguese)" :readonly="$readonly" value="{{ $course->name_pt }}" />
<div class="flex space-x-4">
    <x-field.input name="semesters" label="Nº Semesters" width="sm" :readonly="$readonly" value="{{ $course->semesters }}" />
    <x-field.input name="ECTS" label="Nº ECTS" width="sm" :readonly="$readonly" value="{{ $course->ECTS }}" />
    <x-field.input name="places" label="Nº Places" width="sm" :readonly="$readonly" value="{{ $course->places }}" />
</div>
<x-field.input name="contact" label="Contact" :readonly="$readonly" value="{{ $course->contact }}" />
<x-field.text-area name="objectives" label="Objectives" :readonly="$readonly" value="{{ $course->objectives }}" />
<x-field.text-area name="objectives_pt" label="Objectives (Portuguese)" :readonly="$readonly" value="{{ $course->objectives_pt }}" />