@extends('layouts.main')

@section('maincontent')
    <form class="border rounded p-4 w-50 mx-auto" method="POST" action="{{ route('user.register') }}">
        @csrf
        <h3 class="text-center text-golden">Register</h3>

        @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="mb-3">
            <label for="name" class="form-label text-golden">Username</label>
            <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
        @endif
        <div class="mb-3">
            <label for="email" class="form-label text-golden">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        @if ($errors->has('password'))
            <div class="text-danger">{{ $errors->first('password') }}</div>
        @endif
        <div class="mb-3">
            <label for="password" class="form-label text-golden">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @if ($errors->has('repeat_password'))
            <div class="text-danger">{{ $errors->first('repeat_password') }}</div>
        @endif
        <div class="mb-3">
            <label for="repeat_password" class="form-label text-golden">Repeat password</label>
            <input type="password" class="form-control" id="repeat_password" name="repeat_password">
        </div>
        <button type="submit" class="btn btn-warning mx-auto">Register</button>
    </form>
@endsection