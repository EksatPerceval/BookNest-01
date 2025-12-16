<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $bookId = $request->book_id;

        $favorite = Favorite::where('id_user', $userId)
            ->where('id_buku', $bookId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Buku dihapus dari favorit'
            ]);
        } else {
            Favorite::create([
                'id_user' => $userId,
                'id_buku' => $bookId
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Buku ditambahkan ke favorit'
            ]);
        }
    }
}
