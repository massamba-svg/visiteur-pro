@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 focus:outline-0 focus:ring-2 focus:ring-blue-500/50 border border-gray-300 bg-gray-50 focus:border-blue-600 placeholder:text-gray-500 p-[15px] text-base font-normal leading-normal']) }}>
