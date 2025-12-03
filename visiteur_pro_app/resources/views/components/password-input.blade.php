@props(['disabled' => false])

<div class="flex w-full flex-1 items-stretch" x-data="{ showPassword: false }">
    <input x-bind:type="showPassword ? 'text' : 'password'"
           class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-gray-900 focus:outline-0 focus:ring-2 focus:ring-blue-500/50 border border-gray-300 bg-gray-50 focus:border-blue-600 h-14 placeholder:text-gray-500 p-[15px] border-r-0 text-base font-normal leading-normal"
           {{ $disabled ? 'disabled' : '' }}
           {!! $attributes->merge(['class' => '']) !!} />
    <button type="button"
            @click="showPassword = !showPassword"
            class="text-gray-600 flex border border-gray-300 bg-gray-50 items-center justify-center pr-[15px] rounded-r-lg border-l-0">
        <span class="material-symbols-outlined cursor-pointer">
            <span x-show="!showPassword">visibility</span>
            <span x-show="showPassword">visibility_off</span>
        </span>
    </button>
</div>
