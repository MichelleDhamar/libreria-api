<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        "id",
        "isbn",
        "title",
        "description",
        "publish_date",
        "category_id",
        "editorial_id"
    ];

    public $timestamps = false;

    public function authors(){
        return $this->belongsToMany(
            Author::class, //Table relationship
            'authors_books', //Table private o intersection
            "books_id", //from
            "authors_id" //to
        );
    }
}
