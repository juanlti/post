<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->unique()->word(20);
        //slug, contiene el valor de $name pero reemplazando los espacios en blanco por guiones,
        //hola mundo=>hola-mundo
        $slug=Str::slug($name);
        return [
            'name'=>$name,
            'slug'=>$slug
        ];
    }
}
