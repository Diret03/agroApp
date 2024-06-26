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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['initiated', 'in_progress', 'cancelled', 'completed'])->default('initiated');
            $table->float('progress_percentage')->default(0);
            $table->unsignedBigInteger('responsible_id');
            $table->timestamps();

            // foreign key
            $table->foreign('responsible_id')->references('id')->on('responsibles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
