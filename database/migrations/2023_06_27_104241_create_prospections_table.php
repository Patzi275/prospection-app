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
        Schema::create('prospections', function (Blueprint $table) {
            $table->id();
            $table->string('agent_name');
            $table->string('client_name');
            $table->string('address');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('duration');
            $table->enum('product', ['table', 'chaise', 'ordinateur', 'ecran'])->nullable();
            $table->text('observation')->nullable();
            $table->boolean('is_sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospections');
    }
};
