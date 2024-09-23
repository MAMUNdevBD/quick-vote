<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $polls = Poll::where('user_id', Auth::id())->get();
    return view('polls.index', ['polls' => $polls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $poll = Poll::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'is_public' => $request['is_public'] ?? false,
            'user_id' => Auth::id(),
        ]);

        foreach ($request['options'] as $option) {
            Option::create([
                'name' => $option,
                'poll_id' => $poll->id,
            ]);
        }

        return redirect()->route('polls.index')->with('status', 'Poll created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        if($poll->is_public || Auth::check()) {
            return view('polls.show', ['poll' => $poll]);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
    {
        if (!Auth::check() || $poll->user_id != Auth::id()) {
            return redirect()->route('home');
        }
        return view('polls.edit', ['poll' => $poll]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poll $poll)
    {
        $poll->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'is_public' => $request['is_public'] ?? false,
        ]);

        $existingOptions = $poll->options()->pluck('name')->toArray();
        foreach ($request['options'] as $option) {
            if (in_array($option, $existingOptions)) {
                $poll->options()->where('name', $option)->first()->update(['name' => $option]);
            } else {
                Option::create([
                    'name' => $option,
                    'poll_id' => $poll->id,
                ]);
            }
        }
        $poll->options()->whereNotIn('name', $request['options'])->delete();

        return redirect()->route('polls.index')->with('status', 'Poll updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poll $poll)
    {
        if (!Auth::check() || $poll->user_id != Auth::id()) {
            return redirect()->route('home');
        }
        $poll->delete();
        return redirect()->route('polls.index')->with('status', 'Poll deleted successfully!');
    }
}
