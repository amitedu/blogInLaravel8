<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    // This way you can eager load the relation. It will be always eager load.
//    protected $with = ['category', 'author'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
//        dd($filters);
        $query->when($filters['search'] ?? FALSE, function ($query, $search) {
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['categories'] ?? FALSE, fn($query, $category) =>
//            $query->whereExists(fn($query) =>
//                $query->from('categories')
//                    ->whereColumn('categories.id', 'posts.category_id')
//                    ->where('categories.slug', $category)
//            )

            // This is same as above query
//            $query->whereHas('category', fn($query) =>
//                $query->where('slug', $category)
//            )

            // This is same as above two query. This function added in the laravel 8.58 version.
            $query->whereRelation('category', 'slug', $category)
        );
    }
}
