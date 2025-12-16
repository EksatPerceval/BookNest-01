<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalCategories = Category::count();
        $recentBooks = Book::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalCategories', 'recentBooks'));
    }

    // Books Management
    public function booksIndex()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function booksCreate()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function booksStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'required|exists:categories,id_kategori',
            'deskripsi' => 'required|string',
            'isi_buku' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:10240'
        ]);

        // Handle cover upload
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $coverPath;
        }

        // Handle PDF upload
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
            $validated['file_pdf'] = $pdfPath;
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function booksEdit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function booksUpdate(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'required|exists:categories,id_kategori',
            'deskripsi' => 'required|string',
            'isi_buku' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:10240'
        ]);

        // Handle cover upload
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $coverPath;
        }

        if ($request->has('delete_pdf') && $request->delete_pdf == '1') {
            if ($book->file_pdf) {
                Storage::disk('public')->delete($book->file_pdf);
                $validated['file_pdf'] = null;
            }
        }
        // Handle PDF upload
        elseif ($request->hasFile('file_pdf')) {
            if ($book->file_pdf) {
                Storage::disk('public')->delete($book->file_pdf);
            }
            $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
            $validated['file_pdf'] = $pdfPath;
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function booksDestroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        if ($book->file_pdf) {
            Storage::disk('public')->delete($book->file_pdf);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }

    // Categories Management
    public function categoriesIndex()
    {
        $categories = Category::withCount('books')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function categoriesStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori'
        ]);

        Category::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function categoriesDestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}
