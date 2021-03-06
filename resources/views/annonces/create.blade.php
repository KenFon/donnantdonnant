@extends('layouts.app')

@section('content')

<h1> Formulaire de création d'une annonce : </h1>
<form method="POST" action="{{ route('annonces.create') }}">
    @csrf
    <div class="">
            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="">Choisir le type de l'annonce</option>
                <option value="search">Dog</option>
                <option value="offer">Cat</option>
            </select>
    </div>

    <div class="">
        <label for="title" class="">Choisir le titre de l'annonce</label>
        <div class="">
            <input id="title" type="text" class="form-control @error('email') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="">
        <label for="desc" class="">Description de l'annonce</label>
        <input id="desc" type="text-area" class="@error('password') is-invalid @enderror" name="desc" required autocomplete="desc">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
    </div>

    <div class="">
        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password">
    </div>

    <div class="">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
                
    </div>
</form>

@endsection