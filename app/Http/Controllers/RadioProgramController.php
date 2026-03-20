<?php

namespace App\Http\Controllers;

use App\Http\Requests\RadioProgramRequest;
use App\Models\RadioProgram;
 

class RadioProgramController extends Controller
{
   
    public function index()
    {

       $programs = RadioProgram::latest()->paginate(10);

      

       $data = [
        'programs'=>$programs,
        'title'=>'Radio Program'
       ];

       return view('radio_programs.program_list')->with($data);
    

    }

   
    public function create()
    {
        $data = [
        'title'=>'create Radio Program'
       ];

       return view('radio_programs.create_program')->with($data);
    }

 
    public function store(RadioProgramRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('recorded_file')) {
            $data['recorded_file'] = $request->file('recorded_file')->store('radio_programs','public');
        }

        $data['created_by'] = auth()->id();

        RadioProgram::create($data);

        return redirect()->route('radio-programs.index');
    }

    
    public function show($radioProgram_id)
    {

        $radioProgram = RadioProgram::with('lessonPlans')->find($radioProgram_id);

        $data = [
        'program'=>$radioProgram,
        'title'=>'Radio Program'
       ];

       return view('radio_programs.program')->with($data);
    }

   
    public function edit(RadioProgram $radioProgram)
    {

        $data = [
            'program'=>$radioProgram,
            'title'=>'Edit Radio Program'
       ];

       return view('radio_programs.edit_program')->with($data);

    }

    
    public function update(RadioProgramRequest $request, RadioProgram $radioProgram)
    {    

        $data = $request->validated();      

        if ($request->hasFile('recorded_file')) {
            

            $data['recorded_file'] = $request->file('recorded_file')
                                ->store('radio_programs', 'public');
        }     

        $radioProgram->update($data);

        $radioProgram->refresh();

    

        return redirect()->route('radio-programs.index');
    }

   
    public function destroy(RadioProgram $radioProgram)
    {
        $radioProgram->delete();

        return redirect()->route('radio-programs.index');
    }
}
