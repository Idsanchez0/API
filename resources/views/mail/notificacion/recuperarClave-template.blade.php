@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://www.soyvibra.com'])
            <img src="{{ $url . '/img/logo.png' }}" class="width-2" width="20%" height="20%">
        @endcomponent
    @endslot

    {{-- Body --}}
    # Hola {{ $nombre }}

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            Para confirmar tu reseteo de clave en SoyVibra, por favor has click en el siguiente enlace:
            @component('mail::button', ['url' => $url_verify])
                Click aquí
            @endcomponent

        @endcomponent
        Gracias por preferirnos,<br>
        El equipo de Soy Vibra.
    @endslot


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            Soy Vibra, todos los derechos reservados.
        @endcomponent
    @endslot
@endcomponent
