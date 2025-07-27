@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 py-1 px-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
