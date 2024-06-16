<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex flex-row w-full gap-6">
                
                    <x-field.input name="name" label="Name"
                        value="{{ $name }}"/>

                    <x-field.select name="genre" label="Gênero"
                        value="{{ $genre}}"
                        :options="$listGenres"/>
        </div>
    
        <div class="flex items-center gap-2 justify-end mt-4">    
            <x-button element="a" type="light" text="Cancel" :href="$resetUrl"/>
            <x-button
                            element="submit"
                            type="secondary"
                            text="Buscar"/>
        </div>
    </form>
</div>
