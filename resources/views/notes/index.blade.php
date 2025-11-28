@extends('layouts.app')

@section('content')
<div class="bg-gradient min-h-screen  justify-center pt-20">
    <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Notes</h1>
                <p class=" text-gray-800">Welcome to HarvsNotely, <span class="font-bold">{{ Str::upper(Auth::user()->name) }}!</span></p>
            </div>
            <a href="{{ route('notes.create') }}" class="bg-[#7B542F] text-white px-6 py-3 rounded-lg hover:bg-[#B77466] transition duration-300 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>New Note</span>
            </a>
        </div>

        <!-- Pinned Notes -->
        @if($pinnedNotes->count() > 0)
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-thumbtack text-red-500 mr-2"></i>
                Pinned Notes
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pinnedNotes as $note)  
                <div class="bg-black rounded-lg shadow-md border-l-4 border-red-500 transform hover:scale-105 transition duration-300 {{ $note->color }} cursor-pointer" 
                     onclick="openNoteModal({{ $note->id }})"
                     data-note-id="{{ $note->id }}"
                     data-note-title="{{ $note->title }}"
                     data-note-content="{{ $note->content }}"
                     data-note-color="{{ $note->color }}"
                     data-note-created="{{ $note->created_at->format('M j, Y') }}"
                     data-note-pinned="{{ $note->is_pinned }}"
                     data-note-archived="{{ $note->is_archived }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg text-gray-800">{{ $note->title }}</h3>
                            <div class="flex space-x-2" onclick="event.stopPropagation()">
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
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')" onclick="event.stopPropagation()">
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
            <h2 class="text-xl font-bold text-gray-800 mb-4">All Notes</h2>
            @if($notes->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($notes as $note)
                <div class="bg-black rounded-lg shadow-md transform hover:scale-105 transition duration-300 {{ $note->color }} cursor-pointer"
                     onclick="openNoteModal({{ $note->id }})"
                     data-note-id="{{ $note->id }}"
                     data-note-title="{{ $note->title }}"
                     data-note-content="{{ $note->content }}"
                     data-note-color="{{ $note->color }}"
                     data-note-created="{{ $note->created_at->format('M j, Y') }}"
                     data-note-pinned="{{ $note->is_pinned }}"
                     data-note-archived="{{ $note->is_archived }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-semibold text-lg text-gray-800" title="{{ $note->title }}">
                                {{ Str::words($note->title, 5, '...') }}
                            </h3>
                            <div class="flex space-x-2" onclick="event.stopPropagation()">
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
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')" onclick="event.stopPropagation()">
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
                <i class="fas fa-sticky-note text-6xl text-black mb-4"></i>
                <h3 class="text-xl font-semibold text-black mb-2">No notes yet</h3>
                <p class="text-gray-800 mb-6">Create your first note to get started!</p>
                <a href="{{ route('notes.create') }}" class="bg-[#7B542F] text-white px-6 py-3 rounded-lg hover:bg-[#B77466] transition duration-300">
                    Create Your First Note
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Note Modal -->
<div id="noteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-black rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-700" id="modalHeader">
            <h2 class="text-2xl font-bold text-gray-800" id="modalTitle"></h2>
            <button onclick="closeNoteModal()" class="text-gray-500 hover:text-gray-700 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto max-h-[60vh]" id="modalBody">
            <div class="prose max-w-none">
                <p class="text-gray-600 whitespace-pre-wrap" id="modalContentText"></p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-between items-center p-6 border-t border-gray-700 bg-gray-900">
            <div class="text-sm text-gray-500">
                <span id="modalDate"></span>
                <span id="modalStatus" class="ml-2"></span>
            </div>
            <div class="flex space-x-3">
                <button onclick="closeNoteModal()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 flex items-center space-x-2">
                    <i class="fas fa-times"></i>
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/notely.js') }}"></script>


@endsection

