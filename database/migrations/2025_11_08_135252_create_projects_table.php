<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description')->nullable();

            // New fields
            $table->string('location')->nullable();
            $table->string('project_type')->nullable();
            $table->decimal('estimated_cost', 15, 2)->nullable();
            $table->string('rab_file')->nullable();
            $table->string('design_file')->nullable();

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->enum('status', [
                'pending',
                'on_progress',
                'completed'
            ])->default('pending');

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
