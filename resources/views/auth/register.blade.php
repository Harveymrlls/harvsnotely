@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-lg">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="flex justify-center">
                    <i class="fas fa-sticky-note text-4xl text-black"></i>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Join HarvsNotely today
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="username" class="sr-only">Username</label>

                        <input id="username" 
                        name="username" type="text" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-[#FEEE91] outline-none" 
                        placeholder="Username" 
                        value="{{ old('username') }}">

                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="sr-only">Full Name</label>

                        <input id="name" 
                        name="name" 
                        type="text" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-[#FEEE91] outline-none" 
                        placeholder="Full Name" 
                        value="{{ old('name') }}">

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        
                        <input id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-[#FEEE91] outline-none" 
                        placeholder="Password">

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>

                        <input id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-[#FEEE91] outline-none" 
                        placeholder="Confirm Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="navsignup group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">
                        Already have an account? Sign in
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection