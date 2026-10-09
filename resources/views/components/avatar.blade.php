@props(['name' => 'مستخدم', 'size' => 'md'])
@php($sizeClass = ['sm'=>'h-8 w-8 text-[10px]','md'=>'h-10 w-10 text-xs','lg'=>'h-14 w-14 text-base'][$size] ?? 'h-10 w-10 text-xs')
<span {{ $attributes->merge(['class' => 'inline-grid shrink-0 place-items-center rounded-xl bg-brand/10 font-extrabold text-brand '.$sizeClass]) }}>{{ mb_strtoupper(mb_substr((string)$name, 0, 1)) }}</span>
