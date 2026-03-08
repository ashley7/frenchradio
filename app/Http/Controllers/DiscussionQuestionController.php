<?php

namespace App\Http\Controllers;

use App\Models\DiscussionQuestion;
use App\Models\PodcastLesson;
use Illuminate\Http\Request;

class DiscussionQuestionController extends Controller
{
     public function index($lesson_id)
    {
        $lesson = PodcastLesson::with('questions')->findOrFail($lesson_id);
        return view('discussion_questions.index', compact('lesson'));
    }

     public function create($lesson_id)
    {
        $lesson = PodcastLesson::findOrFail($lesson_id);
        return view('discussion_questions.create', compact('lesson'));
    }

    public function store(Request $request, $lesson_id)
    {
        $request->validate([
            'question' => 'required',
        ]);

        DiscussionQuestion::create([
            'podcast_lesson_id' => $lesson_id,
            'question' => $request->question,
        ]);

        return redirect()->route('discussion_questions.index', $lesson_id);
    }

    public function edit($id)
    {
        $question = DiscussionQuestion::findOrFail($id);
         return view('discussion_questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = DiscussionQuestion::findOrFail($id);

        $request->validate([
            'question' => 'required',
        ]);

        $question->update($request->only('question'));

        return redirect()->route('discussion_questions.index', $question->podcast_lesson_id);
    }

    public function destroy($id)
    {
        $question = DiscussionQuestion::findOrFail($id);
        $lesson_id = $question->podcast_lesson_id;
        $question->delete();

        return redirect()->route('discussion_questions.index', $lesson_id);
    }
}
