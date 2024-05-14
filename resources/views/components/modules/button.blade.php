@isset
    @if (($type) == "main-color")
    <button {{ $attributes->merge(['type'=>'submit', 'class'=>'w-full bg-green-900 text-white p-2 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-900 focus:ring-2 focus:ring-offset-2 focus:ring-green-900 transition-colors duration-300']) }}>
        {{ $slot }}
    </button>
    
    @elseif (($type) == "sub-color")
    
    @endif
@endisset
