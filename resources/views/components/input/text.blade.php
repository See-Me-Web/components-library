@props([
    'label' => '',
    'wrapperClass' => '',
    'id' => '',
])

<div @class([
    'inline-block relative',
    $wrapperClass,
])>
  <input
    @class([
      'peer w-full h-[3.125rem]',
      'bg-transparent text-text-secondary text-sm shadow-01',
      'px-3 border border-border-secondary rounded-lg transition-all',
      'hover:border-border-active hover:bg-surface-hover-01',
      'focus:border-border-active focus:outline-0 focus:ring-0',
      'disabled:bg-border-disabled disabled:text-text-disabled disabled:cursor-not-allowed disabled:border-border-disabled',
    ])
    placeholder=" "
    {{ $attributes->merge(['id' => $id])}}
  />
  <label
    @class([
        'flex w-full h-full select-none pointer-events-none absolute px-3 transition-all',
        '!overflow-visible truncate leading-tigh',
        'text-text-tertiary peer-placeholder-shown:text-text-tertiary',
        'peer-disabled:text-text-disabled peer-disabled:peer-placeholder-shown:text-text-disabled',
        '-top-[1.25rem] peer-placeholder-shown:top-4 peer-focus:-top-[1.25rem]',
        '-left-3 peer-placeholder-shown:left-0 peer-focus:-left-3',
        'peer-placeholder-shown:text-sm text-xs peer-focus:text-xs',
    ])
    for="{{ $id }}"
  >
    {{ $label }}
  </label>
</div>