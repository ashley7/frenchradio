<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    public function index()
    {
        $progress = UserProgress::with('user','podcast','lesson')->latest()->get();
        return view('user_progress.index', compact('progress'));
    }

    public function markComplete($id)
    {
        $progress = UserProgress::findOrFail($id);
        $progress->update([
            'completed' => true,
            'completed_at' => now(),
        ]);

        return back();
    }
}
