<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class LibraryController extends Controller
{
    public function index()
    {
        $bookChunks = Book::limit(10)->get()->chunk(2);

        return view('home')->with('bookChunks', $bookChunks);
    } 
}
