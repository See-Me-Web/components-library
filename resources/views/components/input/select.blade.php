@props([
    'label' => '',
    'wrapperClass' => '',
    'id' => '',
    'values' => [],
])

<div 
    @class([
        'inline-block relative z-10',
        $wrapperClass,
    ])
    x-data="{ 
        current: '',
        open: false,
        selectValue(value) {
            this.current = value;
            this.$refs.select.value = value;
            $dispatch('select-changed', { value: value, el: this.$refs.select });
        }
    }"
    :class="{
        '!z-30': open,
    }"
>
    <div 
        @class([
            'flex flex-col justify-center w-full h-[3.125rem] cursor-pointer',
            'bg-surface-01 text-text-secondary text-sm shadow-01',
            'px-3 border border-border-secondary rounded-lg transition-all',
            'hover:border-border-active hover:bg-surface-hover-01'
        ])
        :class="{
            '!rounded-b-none !border-border-active !bg-surface-hover-01': open
        }"
        x-on:click="open = !open"
    >
        <span x-text="current"></span>

        <span class="absolute z-10 pointer-events-none right-2 top-1/2 -translate-y-1/2">
            <x-icon.chevron-down class='w-6 h-6' />
        </span>

        <label
            @class([
                'flex w-full h-full select-none pointer-events-none absolute z-10 left-0 px-3 transition-all',
                '!overflow-visible truncate leading-tigh',
                'text-text-tertiary',
                '-top-[1.25rem] text-xs',
                '-left-3',
            ])
            :class="{
                '-top-[1.25rem] text-xs': current !== '',
                'top-4 left-0 text-sm': current === '',
            }"
            for="{{ $id }}"
        >
            {{ $label }}
        </label>
    </div>

    <div 
        class="flex flex-col absolute z-20 top-full bg-surface-01 inset-x-0 shadow-01 -mt-px rounded-b-lg"
        x-show="open"
        x-on:click.away="open = false"
        x-collapse
        x-cloak
    >
        @foreach($values as $key => $value)
            @if (! $value)
                @continue
            @endif

            <button
                class="text-left px-3 py-2"
                type="button"
                x-on:click="selectValue(@Js($value)); open = false;"
            >
                {{ $value }}
            </button>
        @endforeach
    </div>

    <select
        {{ $attributes->merge(['id' => $id, 'class' => 'hidden'])}}
        x-ref="select"
    >
        @foreach ($values as $key => $value)
            <option>{{ $value }}</option>
        @endforeach
    </select>
</div>