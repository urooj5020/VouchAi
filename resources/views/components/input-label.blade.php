@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-700 dark:text-slate-200']) }}>
    {{ $value ?? $slot }}
</label>