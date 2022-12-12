<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('authors');
        return [
            "error" => false,
            "message" => "Successfull query",
            "data" => $books
        ];
    }

    public function store(Request $request){
        $existIsbn = Book::where('isbn', trim($request->isbn))->exists();
        if(!$existIsbn){
            $book = new Book();
            $book->isbn = trim($request->isbn);
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category["id"];
            $book->editorial_id = $request->editorial_id;
            $book->publish_date = Carbon::now();
            $book->save();
            /*foreach($request->authors as $item){
                $book->authors()->attach($item);
            }*/
            $bookId = $book->id;
            return [
                "status" => true,
                "message" => "Your book has been created",
                "data" => [
                    "book_id" => $bookId,
                    "book" => $book
                ]
            ];
        }else{
            return [
                "status" => false,
                "message" => "The book already exist",
                "data" => []
            ];
        }
    }
}
