@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen items-center pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Archived Notes</h1>
                <p class="text-gray-600">Your archived notes</p>
            </div>
            <a href="{{ route('notes.index') }}" class="bg-[#7B542F] text-white px-6 py-3 rounded-lg hover:bg-[#B77466] transition duration-300 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Notes</span>
            </a>
        </div>

        <!-- Archived Notes -->
        @if($archivedNotes->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($archivedNotes as $note)
            <div class="bg-black rounded-lg shadow-md border-l-4 border-yellow-500 {{ $note->color }}">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $note->title }}</h3>
                        <div class="flex space-x-2">
                            <form action="{{ route('notes.toggle-archive', $note) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-500 hover:text-green-700" title="Restore Note">
                                    <i class="fas fa-box-open"></i>
                                </button>
                            </form>
                            <a href="{{ route('notes.edit', $note) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">{{ Str::limit($note->content, 150) }}</p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>Archived {{ $note->updated_at->format('M j, Y') }}</span>
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
            <i class="fas fa-archive text-6xl text-black mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No archived notes</h3>
            <p class="text-gray-800">Notes you archive will appear here</p>
        </div>
        @endif
    </div>
</div>
@endsection