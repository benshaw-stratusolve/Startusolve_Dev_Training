<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index()
    {
        $ideas = Auth::user()->ideas()->get();

        return view('ideas.index', ['ideas' => $ideas]);
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(IdeaRequest $request)
    {
        $idea = Auth::user()->ideas()->create([
            'description' => $request->description,
            'state'       => 'pending',
        ]);

        Auth::user()->notify(new IdeaPublished($idea));

        return redirect('/ideas');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', ['idea' => $idea]);
    }

    public function edit(Idea $idea)
    {
        abort_unless($idea->user_id === Auth::id(), 403);

        return view('ideas.edit', ['idea' => $idea]);
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        abort_unless($idea->user_id === Auth::id(), 403);

        $idea->update(['description' => $request->description]);

        return redirect('/ideas/' . $idea->id);
    }

    public function destroy(Idea $idea)
    {
        abort_unless($idea->user_id === Auth::id(), 403);

        Idea::destroy($idea->id);

        return redirect('/ideas');
    }
}
