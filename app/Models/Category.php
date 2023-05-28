<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = ['title', 'photo'];

    #[SearchUsingFullText(['title'])]
    public function toSearchableArray()
    {
        return [
          'title' => $this->title
        ];
    }
}
