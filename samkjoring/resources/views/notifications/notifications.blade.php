@extends('layouts.app')

@section('content')

  <!-- Page Content -->
  <div class="container">
    <div class="page card my-4">


      <div class="page-text-area">
        <h3 class="display-3">{{ __('Notifications!') }}</h3>

        @if (!empty($notifications))
          @foreach ($notifications as $notification)
            <p>{{ $notification->message }}</p>
            <p>{{ $notification->type_name }}</p>
          @endforeach
        @else
          <p>{{ __('You have no messages') }}</p>
          <p class="lead">{{ __('Here be dragons!') }}</p>
        @endif
      </div>
    </div>

  {{-- <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">{{ __('Notifications!') }}</h1>
      <!-- <a href="/registration" class="btn btn-primary btn-lg">Registrer deg nå!</a> -->
      @if (!empty($notifications))
        @foreach ($notifications as $notification)
          <p>{{ $notification->message }}</p>
          <p>{{ $notification->type_name }}</p>
        @endforeach
      @else
        <p>{{ __('You have no messages') }}</p>
        <p class="lead">{{ __('Here be dragons!') }}</p>
      @endif
    </header>

  </div> --}}
@endsection