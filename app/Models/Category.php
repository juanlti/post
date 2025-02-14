<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use hasFactory;

    protected $fillable = ['name', 'slug'];

    //Permite incluir relaciones en la consulta, va ser usados en el foreach para comparar su validez
    protected array $allowIncludes = ['posts','posts.user'];

    //Permite incluir filtros (o condiciones), en la consulta, va ser usados en el for eanch para comprar su validez
    protected array $allowFilters = ['id','name','slug'];
    // 1 a M
    public function posts():HasMany{
        return $this->hasMany(Post::class);
    }


    //Query escope
    //Se pasa en la url como ??included=posts,posts.user
    public function scopeIncluded(Builder $query){
        //verificamos que exista el conjunto de relaciones y que el parametro includ este definido
        if(empty($this->allowIncludes) || empty(request('included'))){
            return;
        }
        $relations = explode(',',request()->query('included',)); //['posts','relacion2']
         // en la funcion de query, pasamos por parametro el datos que queremos recuperar, en este caso:
        // included tiene el valor de 'posts',
        //Conclusion, obtenemos las publicaciones de una categoria
        //http://post.test/api/categorias/1?included=posts

        $allowIncludes=collect($this->allowIncludes);
        foreach ($relations as $key => $relation){
            if(!$allowIncludes->contains($relation)){
                //eliminamos la relacion que no coincide con  $allowIncludes
                unset($relations[$key]);
            }

        }
        //retornamos la consulta en CategoeryController
        $query->with($relations);

    }
    public function scopeFilter(Builder $query){

        if(empty($this->allowFilters) || empty(request('filter'))){
            return;
        }
        //http://post.test/api/categorias/1?filter[name]=juan&filter[id]=3
        $filters=request('filter');
        //comparamos si los filtros son validos
        $allowFilters=collect($this->allowFilters);
        foreach ($filters as $filterIndex => $value){
            if($allowFilters->contains($filterIndex)){
               $query->where($filterIndex,'LIKE','%'.$value.'%');
            }
        }





    }
}
