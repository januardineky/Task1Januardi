<?php

namespace App\Http\Controllers;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
        
class MajorController extends Controller
{
    //
    public function index()
    {
        $majors = Major::all(); // Ambil semua data jurusan
        return view('dashboard', compact('majors'));
    }

    public function create()
    {
        return view('createmajor');
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'major_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Menangani upload gambar
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('/image');
    } else {
        $imagePath = null;
    }

    // Mendapatkan ID pengguna yang sedang login
    $userId = auth()->id();

    // Menyimpan data jurusan
    Major::create([
        'major_name' => $request->major_name,
        'description' => $request->description,
        'image' => $imagePath,
        'user_id' => $userId, // Menyimpan user_id yang login
    ]);



    Alert::success('Success', 'Major Successfully Added!');
    return redirect('/index');
    }


    public function deletemajors($id)
    {
        // Find the major by ID
        $major = Major::find($id);

        // Check if the major exists
        if (!$major) {
            return redirect()->back()->with('error', 'Major not found.');
        }

        // Delete the major
        $major->delete();

        // Alert::success('Success', 'Data berhasil dihapus');
        Alert::success('Success', 'Major Successfully Deleted!');
        return redirect()->back();   
    }


    public function edit($id)
    {
        $major = Major::findOrFail($id);
        return view('updatemajor', compact('major'));
    }
    

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'major_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $major = Major::findOrFail($id);

        // Menangani upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/image');
            // Hapus gambar lama jika ada
            if ($major->image) {
                Storage::delete($major->image);
            }
            $major->image = $imagePath;
        }

        // Perbarui data major
        $major->major_name = $request->major_name;
        $major->description = $request->description;
        $major->save();

        Alert::success('Success', 'Major Successfully Updated!');
        return redirect('/index');
    }
}
