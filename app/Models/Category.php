<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use hasFactory, ApiTrait;

    protected $fillable = ['name', 'slug'];

    // 1 a M
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    //Permite incluir relaciones en la consulta, va ser usados en el foreach para comparar su validez
    protected array $allowIncludes = ['posts', 'posts.user'];

    //Permite incluir filtros (o condiciones), en la consulta, va ser usados en el for eanch para comprar su validez
    protected array $allowFilters = ['id', 'name', 'slug'];

    // Permite incluir campos validos para el ordenamiento
    protected array $allowSorts = ['id', 'name', 'slug'];


}
