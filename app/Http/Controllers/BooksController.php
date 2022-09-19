<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\DB;


class BooksController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }

    public function books()
    {
        $book = Book::leftjoin('authors', 'book_author_id' , '=', 'author_id')->get();
        
        return response()->json($book);
    }

}
