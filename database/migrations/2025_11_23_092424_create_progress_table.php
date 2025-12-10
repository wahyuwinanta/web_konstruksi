<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel progress proyek
        Schema::create('project_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->text('progress_description');
            $table->integer('progress_percentage')->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel gambar progress (masih dalam migration yang sama)
        Schema::create('project_progress_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progress_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('progress_id')
                  ->references('id')
                  ->on('project_progress')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_progress_images');
        Schema::dropIfExists('project_progress');
    }
};
