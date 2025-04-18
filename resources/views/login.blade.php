@extends('layouts.main')

@section('maincontent')
    <form class="border rounded p-4 w-50 mx-auto" method="POST" action="{{ route('user.login') }}">
        @csrf
        <h3 class="text-center text-golden">Login</h3>
        <div class="mb-3">
            @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
            <label for="name" class="form-label text-golden">Username</label>
            <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
            @endif
            <label for="password" class="form-label text-golden">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-warning mx-auto">Login</button>
    </form>
@endsection