    @component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => ''])
        @if($data['company']['logo'])
            <img class="header-logo" src="https://prabaha.in/_next/static/media/Prabaha-yellow-green-logo-16-9.378983cc.png?w=150&h=150&q=75" alt="{{$data['company']['name']}}">
        @else
            {{$data['company']['name']}}
        @endif
        @endcomponent
    @endslot

    {{-- Body --}}
    <!-- Body here -->

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            {!! $data['body'] !!}
            @if(!$data['attach']['data'])
                @component('mail::button', ['url' => $data['url']])
                    View Invoice
                @endcomponent
            @endif
        @endcomponent
    @endslot
@endcomponent
