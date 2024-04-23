<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuuController extends Controller
{
    public function index()
    {
        $bukus = buku::paginate(10);
        return view('petugas.databukuu.index', compact('bukus'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = kategori::all();
        $title = 'Create | Data';
        return view('petugas.databukuu.create', compact('title', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validasi data dari formulir
            $rules = [
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'tahunterbit' => 'required|date',
                'kategori' => 'required|array',
                'deskripsi' => 'required|string',
            ];
    
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate($rules);
    
            // Ambil file cover dan file PDF dari request
            $covered = $request->file('cover');
    
            // Generate nama file unik berdasarkan tanggal
            $coverFilename = date('Y-m-d') . $covered->getClientOriginalName();
    
            // Tentukan path penyimpanan untuk file cover dan file PDF
            $coverPath = 'cover/' . $coverFilename;
    
            // Simpan file cover
            Storage::disk('public')->put($coverPath, file_get_contents($covered));
    
            // Buat objek Dataartikel dan simpan ke database
            $book = buku::create([
                'cover' => $coverFilename,
                'judul' => $validatedData['judul'],
                'penulis' => $validatedData['penulis'],
                'penerbit' => $validatedData['penerbit'],
                'tahunterbit' => $validatedData['tahunterbit'],
                'deskripsi' => $validatedData['deskripsi'],
            ]);
    
            // Ambil kategori yang dipilih dari formulir
            $selectedCategories = $validatedData['kategori'];
    
            // Dapatkan kategori yang sudah terkait dengan buku
            $currentCategories = $book->kategori->pluck('id')->toArray();
    
            // Tentukan kategori baru yang perlu ditambahkan
            $newCategories = array_diff($selectedCategories, $currentCategories);
    
            // Attach kategori yang baru ke buku
            $book->kategori()->attach($newCategories);
    
            // Redirect ke halaman daftar buku dengan pesan sukses
            return redirect()->route('databukuu.index')->with('success', 'buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = buku::findOrFail($id);
        $kategoris = kategori::all();
        $title = 'Edit | Data';
        
        return view('petugas.databukuu.edit', compact('title', 'buku', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $rules = [
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:100000',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahunterbit' => 'required|date',
            'kategori' => 'required|array',
            'deskripsi' => 'required|string',
        ];

        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate($rules);

        // Ambil buku yang akan diperbarui
        $buku = buku::findOrFail($id);

        // Cek apakah ada file cover baru yang diunggah
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            Storage::disk('public')->delete('cover/' . $buku->cover);

            // Ambil file cover yang baru
            $covered = $request->file('cover');

            // Generate nama file cover yang baru berdasarkan tanggal
            $coverFilename = date('Y-m-d') . $covered->getClientOriginalName();

            // Tentukan path penyimpanan untuk file cover yang baru
            $coverPath = 'cover/' . $coverFilename;

            // Simpan file cover yang baru
            Storage::disk('public')->put($coverPath, file_get_contents($covered));

            // Update nama file cover pada database
            $buku->update(['cover' => $coverFilename]);
        }

        // Update data buku (termasuk cover jika ada perubahan)
        $buku->update([
            'judul' => $validatedData['judul'],
            'penulis' => $validatedData['penulis'],
            'penerbit' => $validatedData['penerbit'],
            'tahunterbit' => $validatedData['tahunterbit'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        // Ambil kategori yang dipilih dari formulir
        $selectedCategories = $validatedData['kategori'];

        // Sync kategori yang dipilih ke buku menggunakan relasi many-to-many
        $buku->kategori()->sync($selectedCategories);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('databukuu.index')->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    // Temukan dan hapus buku berdasarkan ID
    $buku = buku::findOrFail($id);

    // Hapus file cover dari penyimpanan
    Storage::disk('public')->delete('cover/' . $buku->cover);

    // Hapus relasi many-to-many di tabel pivot
    $buku->kategori()->detach();

    // Hapus buku dari database
    $buku->delete();

    // Redirect ke halaman daftar buku dengan pesan sukses
    return redirect()->route('databukuu.index')->with('success', 'Buku berhasil dihapus');
    }
}
