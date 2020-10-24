@props([
    'type' => 'text',
    'name',
    'value' => null,
    'errorClasses' => $errors->has($name) ? ' border-red-600' : '',
])

<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => 'form-input w-full'.$errorClasses]) }}>