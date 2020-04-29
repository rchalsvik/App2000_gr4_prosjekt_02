@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
      <div class="card">
        <div class="card-header">{{ __('Profile') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          @if (auth()->user()->hasLicense)
            <div id="new_trip" class="profile-row">
              <a href="{{ route('createTrip') }}">
                <img src="/img/icons/pro_new_trip.svg" alt="{{ __('New trip') }}">
              </a>
              <a href="{{ route('createTrip') }}">{{ __('New trip') }}</a>
            </div>

            <div id="my_trips" class="profile-row">
              <a href="{{ route('myTrips') }}">
                <img src="/img/icons/pro_my_trips.svg" alt="{{ __('My trips') }}">
              </a>
              <a href="{{ route('myTrips') }}">{{ __('My trips') }}</a>
            </div>
          @endif

          <div id="my_joined_trips" class="profile-row">
            <a href="{{ route('myJoinedTrips') }}">
              <img src="/img/icons/pro_joined_trips.svg" alt="{{ __('Joined trips') }}">
            </a>
            <a href="{{ route('myJoinedTrips') }}">{{ __('Joined trips') }}</a>
          </div>
        </div>

        <hr>

        <div class="card-body">
          <div id="edit_user" class="profile-row">
            {{--<a href="{{ route('editUser', $user) }}">--}}
            <a href="{{ route('editUser', auth()->user()) }}">
              <img src="/img/icons/pro_profile.svg" alt="{{ __('Edit user info') }}">
            </a>
            {{--<a href="{{ route('editUser', $user) }}">{{ __('Edit user info') }}</a>--}}
            <a href="{{ route('editUser', auth()->user()) }}">{{ __('Edit user info') }}</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
