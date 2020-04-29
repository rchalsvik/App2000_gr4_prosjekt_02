{{-- Endret av Grp04 --}}

@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="page card my-4">
      <div class="page-text-area">
        <h3 class="display-3">{{ __('Notifications!') }}</h3>

        {{-- hvis du har varslinger, skriv de. ellers skiv du hakke beskjeder --}}
        @if (!empty($notifications))
          @foreach ($notifications as $notification)
            {{-- skriver litt annen beskjed avhengig av varslingstype --}}
            @if ($notification->type_id == 3 || $notification->type_id == 4)
            <p><a href="/trips/{{$notification->trip_id}}/seemore">
              {{ __('Someone has ') }} {{ $notification->type_name }} {{ __('your trip from ') }} {{ $notification->start_point }}
              {{ __(' - ') }} {{ $notification->end_point }}
            </a></p>
            @else
            <p><a href="/trips/{{$notification->trip_id}}/seemore">
              {{ __('Your trip from ') }} {{ $notification->start_point }}
              {{ __(' - ') }} {{ $notification->end_point }} {{ __(' has been ') }} {{ $notification->type_name }}
            </a></p>
            @endif
          @endforeach
        @else
          <p>{{ __('You have no messages') }}</p>
        @endif
      </div>
    </div>
  </div>
@endsection
