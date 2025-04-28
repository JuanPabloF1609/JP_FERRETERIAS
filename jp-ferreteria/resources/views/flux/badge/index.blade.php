@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'iconVariant' => 'micro',
    'iconTrailing' => null,
    'variant' => null,
    'color' => null,
    'inset' => null,
    'size' => null,
    'icon' => null,
])

@php
$insetClasses = Flux::applyInset($inset, top: '-mt-1', right: '-me-2', bottom: '-mb-1', left: '-ms-2');

// When using the outline icon variant, we need to size it down to match the default icon sizes...
$iconClasses = Flux::classes()->add($iconVariant === 'outline' ? 'size-4' : '');

$classes = Flux::classes()
    ->add('inline-flex items-center font-medium whitespace-nowrap')
    ->add($insetClasses)
    ->add('[print-color-adjust:exact]')
    ->add(match ($size) {
        'lg' => 'text-sm py-1.5 **:data-flux-badge-icon:me-2',
        default => 'text-sm py-1 **:data-flux-badge-icon:me-1.5',
        'sm' => 'text-xs py-1 **:data-flux-badge-icon:size-3 **:data-flux-badge-icon:me-1',
    })
    ->add(match ($variant) {
        'pill' => 'rounded-full px-3',
        default => 'rounded-md px-2',
    })
    /**
     * We can't compile classes for each color because of variants color to color and Tailwind's JIT compiler.
     * We instead need to write out each one by hand. Sorry...
     */
    ->add($variant === 'solid' ? match ($color) {
        default => 'text-white',
        'red' => 'text-white',
        'orange' => 'text-white',
        'amber' => 'text-white',
        'yellow' => 'text-white',
        'lime' => 'text-white',
        'green' => 'text-white',
        'emerald' => 'text-white',
        'teal' => 'text-white',
        'cyan' => 'text-white',
        'sky' => 'text-white',
        'blue' => 'text-white',
        'indigo' => 'text-white',
        'violet' => 'text-white',
        'purple' => 'text-white',
        'fuchsia' => 'text-white',
        'pink' => 'text-white',
        'rose' => 'text-white',
    } :  match ($color) {
        default => 'text-zinc-700 [&_button]:text-zinc-700!',
        'red' => 'text-red-700 [&_button]:text-red-700!',
        'orange' => 'text-orange-700 [&_button]:text-orange-700!',
        'amber' => 'text-amber-700 [&_button]:text-amber-700!',
        'yellow' => 'text-yellow-800 [&_button]:text-yellow-800!',
        'lime' => 'text-lime-800 [&_button]:text-lime-800!',
        'green' => 'text-green-800 [&_button]:text-green-800!',
        'emerald' => 'text-emerald-800 [&_button]:text-emerald-800!',
        'teal' => 'text-teal-800 [&_button]:text-teal-800!',
        'cyan' => 'text-cyan-800 [&_button]:text-cyan-800!',
        'sky' => 'text-sky-800 [&_button]:text-sky-800!',
        'blue' => 'text-blue-800 [&_button]:text-blue-800!',
        'indigo' => 'text-indigo-700 [&_button]:text-indigo-700!',
        'violet' => 'text-violet-700 [&_button]:text-violet-700!',
        'purple' => 'text-purple-700 [&_button]:text-purple-700!',
        'fuchsia' => 'text-fuchsia-700 [&_button]:text-fuchsia-700!',
        'pink' => 'text-pink-700 [&_button]:text-pink-700!',
        'rose' => 'text-rose-700 [&_button]:text-rose-700!',
    });
@endphp

<flux:button-or-div :attributes="$attributes->class($classes)" data-flux-badge>
    <?php if (is_string($icon) && $icon !== ''): ?>
        <flux:icon :$icon :variant="$iconVariant" :class="$iconClasses" data-flux-badge-icon />
    <?php else: ?>
        {{ $icon }}
    <?php endif; ?>

    {{ $slot }}

    <?php if ($iconTrailing): ?>
        <div class="ps-1 flex items-center" data-flux-badge-icon:trailing>
            <?php if (is_string($iconTrailing)): ?>
                <flux:icon :icon="$iconTrailing" :variant="$iconVariant" :class="$iconClasses" />
            <?php else: ?>
                {{ $iconTrailing }}
            <?php endif; ?>
        </div>
    <?php endif; ?>
</flux:button-or-div>
