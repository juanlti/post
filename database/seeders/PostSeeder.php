<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //para agregar a cada objeto de Post, utilizo la funcion each y una funcion aninima en la cual,
        //le paso por parametro ese objeto que deseo modificar
        Post::factory(25)->create()->each(function (Post $post) {
            Image::factory(4)->create([
                'imageable_id'=>$post->id,
                'imageable_type'=>Post::class,
            ]);
            // $post a 4 tags (M a M)
            //metodo atacch, agregar a la coleccion
            try {
                $post->tags()->attach([random_int(1, 4), random_int(5, 8)]);
            } catch (RandomException $e) {
                dd($e->getMessage());
            }
        });
    }
}
