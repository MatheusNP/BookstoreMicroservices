<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class CreateBook extends Command
{
    protected $name = 'create:book';

    protected $description = 'create a new book';

    public function handle()
    {
        $data = [
            'product_id' => 'ENT-99',
            'title' => 'Another Book for Beginners',
            'author' => 'Matheus Nobre',
            'maximum_price' => 100,
            'offered_price' => 70,
            'discount_pctg' => 30,
            'available' => 15,
            'publisher' => 'New editora',
            'edition' => 2,
            'category' => 'Literature and Fiction',
            'description' => 'Some description here',
            'language' => 'Portuguese',
            'page' => 320,
            'weight' => 550,
        ];

        $book = Book::create($data);

        event(new \App\Events\BookCreatedEvent($book));
    }
}
