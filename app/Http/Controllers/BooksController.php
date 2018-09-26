<?php
namespace App\Http\Controllers;
use App\Book;
use Log;
/**
* Class BooksController
* @package App\Http\Controllers
*/
class BooksController
{
/**
 * GET /books
 * @return array
 */
    public function index() {
        return Book::all();
    }
    public function show($id) {
        return Book::findOrFail($id);
    }
}