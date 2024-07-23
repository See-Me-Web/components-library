@props([
    'label' => '',
    'wrapperClass' => '',
])

<div @class([
    'inline-block font-light relative',
    $wrapperClass,
])>

    <label class="flex gap-[0.75em] cursor-pointer">
        <div class="flex-none w-[1.5em]">
            <input type="checkbox" {{ $attributes->class('hidden peer') }}>

            <div @class([
                'flex items-center justify-center w-[1.5em] h-[1.5em]',
                'border border-border-secondary rounded-[0.5em] bg-surface-01',
                'peer-checked:border-border-active peer-checked:bg-cta-primary-default',
                '!border-border-active' => $isHighContrast,
            ])>
                <x-icon.checkmark class="w-[0.75em] h-[0.625em] text-surface-01" />
            </div>
        </div>

        <div class="leading-[1.5]">
            {!! $label !!}
        </div>
    </label>
</div>