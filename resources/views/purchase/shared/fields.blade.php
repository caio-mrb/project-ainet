@php
$mode = $mode ?? 'edit';
$readonly = $mode == 'show';
@endphp
<x-field.input name="name" label="Name" width="md" :readonly="$readonly || ($mode == 'edit')" value="{{ $user?->name }}" />
<x-field.input name="email" label="Email" width="md" :readonly="$readonly" value="{{ $user?->email }}" />
<x-field.input name="nif" label="NIF" :readonly="$readonly" value="{{ $user?->customer?->nif }}" />
<x-field.radio-group name="type" label="Type of payment"  :readonly="$readonly" value="{{ $user?->payment_type }}" :options="[
                'MBWAY' => 'MBWAY',
                'VISA' => 'VISA',
                'PAYPAL' => 'PAYPAL'
                ]" />
<div class="flex space-x-4">
<x-field.input name="payment ref" label="Payment Reference" :readonly="$readonly" value="{{ $user?->payment_ref }}" />
