<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use hasFactory;
    //
    const BORRADOR = 1;
    const PUBLICADO = 2;


    //1 a M (inversa)
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
    //1 a M (inversa)
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    // M a M
    public function tags():BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }
    // 1 a M
    public function images():MorphMany{
        return $this->morphMany(Image::class, 'imageable');
    }

}
