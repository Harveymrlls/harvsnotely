@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen items-center pt-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 mt-10">Create New Note</h1>
            
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-md font-bold text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#7B542F] focus:border-[#7B542F]" placeholder="Enter note title" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-md font-bold text-gray-700 mb-2">Content</label>
                    <textarea name="content" id="content" rows="12" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#7B542F] focus:border-[#7B542F]" placeholder="Write your note here...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Note Color</label>
                    <div class="flex space-x-2">
                        @foreach(['bg-white', 'bg-blue-100', 'bg-green-100', 'bg-yellow-100', 'bg-pink-100', 'bg-purple-100'] as $color)
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="{{ $color }}" {{ $loop->first ? 'checked' : '' }} class="sr-only">
                            <div class="w-8 h-8 rounded-full border-2 border-gray-300 hover:border-gray-400 transition {{ $color }} {{ $loop->first ? 'ring-2 ring-[#7B542F]' : '' }}"></div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_pinned" id="is_pinned" class="h-4 w-4 text-[#7B542F] focus:ring-[#7B542F] border-gray-300 rounded">
                        <label for="is_pinned" class="ml-2 block text-sm text-gray-700">Pin this note</label>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('notes.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                            Cancel
                        </a>
                        <button type="submit" class="bg-[#7B542F] text-white px-6 py-2 rounded-md hover:bg-[#B77466] transition duration-300">
                            Create Note
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/notely.js') }}"></script>
@endsection