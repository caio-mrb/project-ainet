@php
$mode = $mode ?? 'edit';
$readonly = $mode == 'show';
@endphp

<div>
    <div class="flex space-x-4">
        <div class="flex-1">
            <x-field.input required name="title" label="Name" type="text" :readonly="$readonly" value="{{ $movie->title }}" />
            <x-field.input required name="genre_code" label="Genero" type="text" :readonly="$readonly" value="{{ $movie->genre_code }}" />
            <x-field.input name="year" label="Year" type="number" :readonly="$readonly" value="{{ $movie->year }}" />
            <x-field.input name="trailer_url" label="Trailer" type="url" :readonly="$readonly" value="{{ $movie->trailer_url }}" />
            
            <x-field.text-area name="synopsis" label="Synopsis" :readonly="$readonly"
                            value="{{ old('objectives', $movie->synopsis) }}"/>
        </div>
        <div class="pb-6">
            <x-field.image name="poster_filename" label="Poster" width="md" :readonly="$readonly" 
             deleteTitle="Delete Photo" :deleteAllow="($mode == 'edit') && (asset('storage/posters/' . $movie->poster_filename))"
            deleteForm="form_to_delete_photo" :imageUrl="asset('storage/posters/' . $movie->poster_filename)"/>
        </div>
    </div>
</div>
