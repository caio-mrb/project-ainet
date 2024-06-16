@php
$mode = $mode ?? 'edit';
$readonly = $mode == 'show';

@endphp
<x-field.input required name="customer_name" label="Name" type="name" :readonly="$readonly" value="{{ old('customer_name', $user?->name) }}" />
<x-field.input required name="customer_email" label="Email" type="email" :readonly="$readonly" value="{{ old('customer_email', $user?->email) }}" />
<x-field.input name="nif" label="NIF" :readonly="$readonly" value="{{ old('nif',$user?->customer?->nif) }}" />
<x-field.radio-group required name="payment_type" label="Type of payment"  :readonly="$readonly" value="{{ old('payment_type', $user?->customer?->payment_type) }}" :options="[
                'MBWAY' => 'MBWAY',
                'VISA' => 'VISA',
                'PAYPAL' => 'PAYPAL'
                ]" />
<div class="flex space-x-4">
<x-field.input :required="true" name="payment_ref" label="Payment Reference" :readonly="$readonly" value="{{ old('payment_ref',$user?->customer?->payment_ref) }}" />
