<?php
namespace App\Http\Controllers;
use App\Book;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            return Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ],404);
        }
    }
}