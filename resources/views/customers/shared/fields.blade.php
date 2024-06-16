@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="flex flex-wrap space-x-8">
    <div class="grow mt-6 space-y-4">
        <x-field.input name="name" label="Nome" :readonly="$readonly"
                        value="{{ old('name', $user->name) }}"/>

        <x-field.input name="email" type="email" label="Email" :readonly="$readonly"
                        value="{{ old('email', $user->email) }}"/>

        <x-field.input name="nif" label="NIF" :readonly="$readonly"
                        value="{{ old('nif', $user->customer?->nif) }}"/>

        <x-field.input name="payment_type" label="Método de Pagemento" :readonly="$readonly"
                        value="{{ old('payment_type', $user->customer?->payment_type) }}"/>

        <x-field.input name="email" type="payment_ref" label="Referência de Pagamento" :readonly="$readonly"
                        value="{{ old('payment_ref', $user->customer?->payment_ref) }}"/>

    </div>
    <div class="pb-6">
        <x-field.image
            name="photo_file"
            label="Photo"
            width="md"
            :readonly="$readonly"
            deleteTitle="Delete Photo"
            :deleteAllow="($mode == 'edit') && ($user->photo_url)"
            deleteForm="form_to_delete_photo"
            :imageUrl="$user->photoFullUrl"/>
    </div>
</div>
