@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen  justify-center pt-20">
    <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Notes</h1>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}! </p>
            </div>
            <a href="{{ route('notes.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>New Note</span>
            </a>
        </div>

        <!-- Pinned Notes -->
        @if($pinnedNotes->count() > 0)
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-thumbtack text-red-500 mr-2"></i>
                Pinned Notes
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pinnedNotes as $note)  
                <div class="bg-black rounded-lg shadow-md border-l-4 border-red-500 transform hover:scale-105 transition duration-300 {{ $note->color }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $note->title }}</h3>
                            <div class="flex space-x-2">
                                <form action="{{ route('notes.toggle-pin', $note) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-thumbtack"></i>
                                    </button>
                                </form>
                                <a href="{{ route('notes.edit', $note) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('notes.toggle-archive', $note) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">{{ Str::limit($note->content, 150) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $note->created_at->format('M j, Y') }}</span>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Notes -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">All Notes</h2>
            @if($notes->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($notes as $note)
                <div class="bg-black rounded-lg shadow-md transform hover:scale-105 transition duration-300 {{ $note->color }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $note->title }}</h3>
                            <div class="flex space-x-2">
                                <form action="{{ route('notes.toggle-pin', $note) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-red-500">
                                        <i class="fas fa-thumbtack"></i>
                                    </button>
                                </form>
                                <a href="{{ route('notes.edit', $note) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('notes.toggle-archive', $note) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">{{ Str::limit($note->content, 150) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $note->created_at->format('M j, Y') }}</span>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-sticky-note text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No notes yet</h3>
                <p class="text-gray-500 mb-6">Create your first note to get started!</p>
                <a href="{{ route('notes.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300">
                    Create Your First Note
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection