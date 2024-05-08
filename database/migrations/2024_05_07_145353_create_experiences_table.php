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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_datos')->unsigned();
            $table->foreign('id_datos')->references('id')->on('datos')->onDelete('cascade');
            $table->string('place', 250)->default('');
            $table->string('position', 250)->default('');
            $table->string('date', 250)->default('');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
