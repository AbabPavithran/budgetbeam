<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title');
            $table->decimal('amount', 10, 2);
            $table->string('category');
            $table->date('expense_date');
            $table->string('note')->nullable();

            $table->timestamps(); // creates created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};