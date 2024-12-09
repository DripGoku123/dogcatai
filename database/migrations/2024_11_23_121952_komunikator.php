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
        Schema::create('komunikator', function (Blueprint $table) {
            $table->id(); // Dodanie klucza głównego
            $table->string('od'); // Klucz obcy do tabeli `users`
            $table->string('do'); // Klucz obcy do tabeli `users`
            $table->text('wiadomosc');
            $table->datetime('kiedy_wyslano');
            $table->datetime('kiedy_odebrano')->nullable();
            $table->timestamps();
            $table->foreign('od')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('do')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunikator');
    }
};

