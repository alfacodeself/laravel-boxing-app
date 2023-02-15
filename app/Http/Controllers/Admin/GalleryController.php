<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageHandlerService;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::get();
        return view('app.admin.galleries.index', compact('galleries'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar' => 'required|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'catatan' => 'required'
        ]);
        try {
            $data['gambar'] = ImageHandlerService::fileStoreHandler($request->gambar, 'public/img/app', 'gallery-');
            Gallery::create($data);
            return redirect()->route('admin.gallery.index')->with('success', 'Berhasil menambah galeri.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Gallery $gallery)
    {
        try {
            ImageHandlerService::fileDeleteHandler($gallery->gambar);
            $gallery->deleteOrFail();
            return redirect()->route('admin.gallery.index')->with('success', 'Berhasil menghapus galeri.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
