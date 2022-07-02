<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class LibraryController extends Controller
{
    public function index()
    {
        $bookChunks = Book::simplePaginate(12);

        return view('library')->with('bookChunks', $bookChunks);
    } 
}
