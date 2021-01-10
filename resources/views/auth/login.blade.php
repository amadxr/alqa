@extends('layouts.app')

@section('content')
<div class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen bg-black">
    <div class="w-4/6 h-auto px-1 py-5 text-center text-white bg-black font-alqa-special lg:px-10 lg:py-20 lg:h-card lg:w-card">
        <div class="pb-16 text-2xl lg:text-first-p-size">
            Welcome to Alqa Web
        </div>
        <div class="text-lg lg:text-2xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="pb-2">
                    <label class="block" for="email">Email Address</label>
                    <input id="email" type="email" class="text-black px-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="pb-2">
                    <label class="block" for="password">Password</label>
                    <input id="password" type="password" class="text-black px-1 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="block pb-5">
                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>

                <div class="space-y-4">
                    <div>
                        <button type="submit" class="px-6 py-1 border border-white border-solid rounded-full">
                            Login
                        </button>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
