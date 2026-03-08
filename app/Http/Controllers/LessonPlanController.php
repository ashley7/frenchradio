<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonPlanRequest;
use App\Models\LessonPlan;
use App\Models\RadioProgram;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
   
    public function index()
    {
       $lessons = LessonPlan::with('program')->latest()->paginate(10);

        return view('lesson_plans.index', compact('lessons'));
    }
 
    public function create()
    {
       $programs = RadioProgram::pluck('title','id');

       $title = "Create a Lesson plan";

       return view('lesson_plans.create', compact('programs','title'));
    }

   
    public function store(LessonPlanRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('downloadable_material')) {

            $data['downloadable_material'] =
                $request->file('downloadable_material')
                        ->store('lesson_materials');

        }

        LessonPlan::create($data);

        return redirect()
            ->route('lesson-plans.index')
            ->with('success','Lesson created');
    }

  
    public function show($lesson_plan_id)
    {
        $lesson_plan = LessonPlan::find($lesson_plan_id);

        return view('lesson_plans.show', [
            'lesson' => $lesson_plan
        ]);
    }

   
    public function edit(LessonPlan $lessonPlan)
    {
        $programs = RadioProgram::pluck('title','id');

        return view('lesson_plans.edit', [
            'lesson' => $lessonPlan,
            'programs' => $programs
        ]);
    }

    
    public function update(LessonPlanRequest $request, LessonPlan $lessonPlan)
    {

       $data = $request->validated();

        if ($request->hasFile('downloadable_material')) {

            $data['downloadable_material'] =
                $request->file('downloadable_material')
                        ->store('lesson_materials');

        }

        $lessonPlan->update($data);

         return redirect()
            ->route('lesson-plans.index')
            ->with('success','Updated');

    }

   
    public function destroy(LessonPlan $lessonPlan)
    {
        $lessonPlan->delete();

        return redirect()
            ->route('lesson-plans.index')
            ->with('success','Deleted');
    }
}
