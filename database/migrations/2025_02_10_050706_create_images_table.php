<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            // Polimorfismo, de manera manual
            /*
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            */
            // Polimorfismo, de manera automatica, utilizando la clase Morphs
            $table->morphs('imageable');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
