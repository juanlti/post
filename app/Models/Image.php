<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use hasFactory,ApiTrait;
    //habilitamos la la relacion polimorfica
    public function imageable(){
        return $this->morphTo();
    }
}
