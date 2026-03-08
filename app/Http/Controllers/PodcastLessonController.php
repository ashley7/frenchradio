<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\PodcastLesson;
use Illuminate\Http\Request;

class PodcastLessonController extends Controller
{
     
    public function index()
    {
        $lessons = PodcastLesson::with('podcast')->latest()->get();
        return view('podcasts.lessons', compact('lessons'));
    }

   
    public function create()
    {
        $podcasts = Podcast::all();
        return view('podcasts.create_lesson', compact('podcasts'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'key_themes' => 'required',
            'learning_outcomes' => 'required',
            'practical_applications' => 'required',
        ]);

        PodcastLesson::create($request->all());
        return redirect()->route('podcast_lessons.index');
    }

    
    public function show($id)
    {
       $lesson = PodcastLesson::findOrFail($id);
        $podcasts = Podcast::all();
        return view('podcast_lessons.edit', compact('lesson', 'podcasts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PodcastLesson $podcastLesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lesson = PodcastLesson::findOrFail($id);

        $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'key_themes' => 'required',
            'learning_outcomes' => 'required',
            'practical_applications' => 'required',
        ]);

        $lesson->update($request->all());
        return redirect()->route('podcast_lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PodcastLesson $podcastLesson)
    {
        $podcastLesson->delete();
        return back();
    }
}
