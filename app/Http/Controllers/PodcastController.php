<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PodcastController extends Controller
{
    
    public function index()
    {
        $podcasts = Podcast::latest()->get();
        return view('podcasts.index', compact('podcasts'));
    }

    
    public function create()
    {
        return view('podcasts.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg',
            'you_tube_embed_url' => 'nullable|string'
        ]);

        // must have at least one
        if (!$request->audio_file && !$request->you_tube_embed_url) {
            return back()->withErrors('Provide audio OR video');
        }

          $audio = null;

        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file')
                ->store('podcasts', 'public');
        }

        Podcast::create([
            'title' => $request->title,
            'description' => $request->description,
            'audio_file' => $audio,
            'you_tube_embed_url' => $request->you_tube_embed_url,
            'created_by' => Auth::id()
        ]);

         return redirect()->route('podcasts.index');
    }

   
    public function show($id)
    {

        $podcast = Podcast::with(['lessons.questions'])->findOrFail($id);

        // Load user progress for this podcast if logged in
        $userProgress = [];
        if (Auth::check()) {
            $userProgress = UserProgress::where('user_id', Auth::id())
                ->where('podcast_id', $podcast->id)
                ->pluck('completed', 'lesson_plan_id')
                ->toArray();
        }

        return view('podcasts.show', compact('podcast', 'userProgress'));
     
    }

    
    public function edit(Podcast $podcast)
    {         
        return view('podcasts.edit', compact('podcast'));
    }

   
    public function update(Request $request, Podcast $podcast)
    {
      

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if (!$request->audio_file && !$request->you_tube_embed_url && !$podcast->audio_file && !$podcast->you_tube_embed_url) {
            return back()->withErrors('Provide audio OR video');
        }

        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file')
                ->store('podcasts', 'public');

            $podcast->audio_file = $audio;
        }

        $podcast->update([
            'title' => $request->title,
            'description' => $request->description,
            'you_tube_embed_url' => $request->you_tube_embed_url,
        ]);

        return redirect()->route('podcasts.index');


    }

  
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();
        return back();
    }

    // FRONTEND

    public function frontend()
    {
        $podcasts = Podcast::latest()->get();
        return view('podcasts.frontend', compact('podcasts'));
    }
}
