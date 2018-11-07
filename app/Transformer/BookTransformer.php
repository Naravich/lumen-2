<?php namespace App\Transformer;

use App\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    // protected $availableIncludes = [
    //     'author'
    // ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Book $book)
    {
        return [
            'id' => (int) $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'author' => $book->author,
            'created' => $book->created_at->toIso8601String(),
            'updated' => $book->updated_at->toIso8601String(),
        ];
    }

    // /**
    //  * Include Author
    //  *
    //  * @return \League\Fractal\Resource\Item
    //  */
    // public function includeAuthor(Book $book)
    // {
    //     $author = $book->author;

    //     return $this->item($author, new AuthorTransformer);
    // }
}