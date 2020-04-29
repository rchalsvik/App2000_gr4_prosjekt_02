{{-- Endret av Grp04 --}}

@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="page card my-4">
      <img id="tandem" src="img/tandem.jpg" alt="tandemsykkel">

      <div class="page-text-area">
        <h1 class="display-3">{{ __('aboutTitle') }}</h1>
        <p class="lead">{{ __('aboutText') }}</p>
      </div>
    </div>
  </div>
@endsection
