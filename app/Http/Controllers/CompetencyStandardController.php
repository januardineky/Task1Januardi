<?php

namespace App\Http\Controllers;
use App\Models\CompetencyStandard;
use App\Models\Major;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetencyStandardController extends Controller
{
    //
    public function managestandards($id)
    {
    
        // Retrieve competency standards associated with the major
        $competencyStandards = CompetencyStandard::where('major_id', $id)->get();
    
        return view('detail', compact('competencyStandards'));
    }

    public function createCompetencyStandard()
    {
    // $majors = Major::all(); // Fetch all majors
    $userId = Auth::id();
    $majors = Major::where('user_id', $userId)->get();
    return view('create', compact('majors'));
    }

    public function addCompetencyStandard(Request $request)
    {
        // Validasi input
        $request->validate([
            'unit_code' => 'required|string|max:32',
            'unit_title' => 'required|string|max:64',
            'unit_description' => 'required|string',
            'grade_level' => 'required|integer',
            'major_id' => 'required|exists:majors,id',
        ]);
    
        // Menyimpan data competency standard dengan user_id yang login
        CompetencyStandard::create([
            'unit_code' => $request->unit_code,
            'unit_title' => $request->unit_title,
            'unit_description' => $request->unit_description,
            'grade_level' => $request->grade_level,
            'major_id' => $request->major_id,
            'user_id' => auth()->id(), // Menyimpan user_id yang login
        ]);

        Alert::success('Success', 'Competency Standard Successfully Added!');
        return redirect('/index');
    }
    
    public function edit($id)
    {
        $userId = Auth::id();
        $standard = CompetencyStandard::with('major')->findOrFail($id);
        $majors = Major::where('user_id', $userId)->get();
        return view('update', compact('standard', 'majors'));
    }
    
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'unit_code' => 'required|string|max:32',
        'unit_title' => 'required|string|max:64',
        'unit_description' => 'required|string',
        'grade_level' => 'required|integer',
        'major_id' => 'required|exists:majors,id',
    ]);

    // Temukan dan perbarui Competency Standard berdasarkan ID
    $standard = CompetencyStandard::findOrFail($id);
    $standard->update([
        'unit_code' => $request->input('unit_code'),
        'unit_title' => $request->input('unit_title'),
        'unit_description' => $request->input('unit_description'),
        'grade_level' => $request->input('grade_level'),
        'major_id' => $request->input('major_id'),
    ]);

    // Redirect dengan pesan sukses
    Alert::success('Success', 'Competency Standard Successfully Updated!');
    return redirect('/index');
}

    

    public function deletestandard($id)
    {
        // Find the major by ID
        $standard = CompetencyStandard::find($id);

        // Check if the standard exists
        if (!$standard) {
            return redirect()->back()->with('error', 'Standard not found.');
        }

        // Delete the standard
        $standard->delete();

        Alert::success('Success', 'Competency Standard Successfully Deleted');
        return redirect()->back();
    }

    
}
