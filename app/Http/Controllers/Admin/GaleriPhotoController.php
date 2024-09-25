<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\Category;
use Illuminate\Support\Facades\Auth;

class GaleriPhotoController extends Controller
{
    public function index()
    {
        return view('admin.galeri-photo.index', [
            'pageTitle' => 'Galeri-Photo',
            // 'listPost' => Post::all(),//Cara pertama
            'listPost' => Post::all(),
        ]);
    }

    public function create()
    {
        return view('admin.galeri-photo.create', [
            'pageTitle' => 'Create Photo',
            'listCategory' => Category::categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'category'      => 'required',
            'description'   => 'required'
        ],[
            'title.required'         => 'judul wajib diisi...',
            'description.required'   => 'keterangan wajib diisi'

        ]);
        //dd($validated);
        $post= Post::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'user_id'=> Auth::user()->id
        ]);


        return redirect(route('admin-galeri-photo', absolute: false));
    }
}
