<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                    ->orWhere('penulis', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('user.books', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        $relatedBooks = Book::where('kategori', $book->kategori)
            ->where('id_buku', '!=', $id)
            ->limit(4)
            ->get();

        return view('user.detail', compact('book', 'relatedBooks'));
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);

        // Increment views
        $book->increment('views');

        return view('user.read', compact('book'));
    }

    public function trending(Request $request)
    {
        $query = Book::with('category')->orderBy('views', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                    ->orWhere('penulis', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $trendingBooks = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('user.books', [
            'books' => $trendingBooks,
            'categories' => $categories,
            'trending' => true
        ]);
    }
}
