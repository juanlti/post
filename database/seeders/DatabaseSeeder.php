<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //si existe la carpeta Post, la elimino, con eso evitamos tener archivos inncesarios
        Storage::deleteDirectory('posts');
        // Creo la carpeta Post en C:\Users\juanc\Herd\post\public\storage\posts
        Storage::makeDirectory('posts');

        //UserSeeder
        $this->call(UserSeeder::class);
        //category
        Category::factory(4)->create();
        //Tag
        Tag::factory(8)->create();
        //PostSeeder
        $this->call(PostSeeder::class);

    }
}
