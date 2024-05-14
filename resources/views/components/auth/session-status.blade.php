@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-sccuess'] }}>
        {{ $status }}
    </div>
@endif
