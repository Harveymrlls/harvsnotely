<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class NoteController extends Controller
{
    use AuthorizesRequests; // Add this trait

    public function index()
    {
        $user = Auth::user();
        $notes = $user->notes()->active()->latest()->get();
        $pinnedNotes = $user->notes()->pinned()->active()->latest()->get();
        
        return view('notes.index', compact('notes', 'pinnedNotes'));
    }

    public function archived()
    {
        $user = Auth::user();
        $archivedNotes = $user->notes()->archived()->latest()->get();
        
        return view('notes.archived', compact('archivedNotes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'color' => 'nullable|string'
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color ?? 'bg-white',
            'is_pinned' => $request->has('is_pinned')
        ]);

        return redirect()->route('notes.index')->with('success', 'Note created successfully!');
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'color' => 'nullable|string'
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color ?? 'bg-white',
            'is_pinned' => $request->has('is_pinned')
        ]);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }

    public function togglePin(Note $note)
    {
        $this->authorize('update', $note);
        $note->update(['is_pinned' => !$note->is_pinned]);

        return back()->with('success', 'Note pin status updated!');
    }

    public function toggleArchive(Note $note)
    {
        $this->authorize('update', $note);
        $note->update(['is_archived' => !$note->is_archived]);

        $message = $note->is_archived ? 'Note archived!' : 'Note restored!';
        return back()->with('success', $message);
    }
}