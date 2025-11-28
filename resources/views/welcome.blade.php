@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen flex items-center justify-center pt-16">
    <div class="max-w-4xl mx-auto text-center text-white px-4">
        <div class="mb-8">
            <i class="fas fa-sticky-note text-8xl mb-6 opacity-90 text-black"></i>
            <h1 class="text-black text-5xl font-bold mb-4">Welcome to HarvsNotely</h1>
            <p class="text-black text-xl mb-8 opacity-90">Your personal space for thoughts, ideas, and important notes</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="bg-black bg-opacity-10 p-6 rounded-lg backdrop-blur-sm">
                <i class="color-black fas fa-edit text-3xl mb-4 text-black"></i>
                <h3 class="text-black text-xl font-semibold mb-2">Create Notes</h3>
                <p class="text-black opacity-90">Write down your thoughts and ideas instantly</p>
            </div>
            <div class="bg-black bg-opacity-10 p-6 rounded-lg backdrop-blur-sm">
                <i class="fas fa-thumbtack text-3xl mb-4 text-black"></i>
                <h3 class="text-black text-xl font-semibold mb-2">Organize</h3>
                <p class="text-black opacity-90">Pin important notes and archive old ones</p>
            </div>
            <div class="bg-black bg-opacity-10 p-6 rounded-lg backdrop-blur-sm">
                <i class="fas fa-shield-alt text-3xl mb-4 text-black"></i>
                <h3 class="text-black text-xl font-semibold mb-2">Secure</h3>
                <p class="text-black opacity-90">Your notes are private and secure</p>
            </div>
        </div>

        @guest
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-200 transition duration-300">
                Get Started Free
            </a>
            <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:bg-opacity-10 transition duration-300">
                Sign In
            </a>
        </div>
        @else
        <a href="{{ route('notes.index') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
            Go to Dashboard
        </a>
        @endguest
    </div>
</div>
@endsection