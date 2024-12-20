<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('candidate_id')->constrained()->references('id')->on('candidates')->onDelete('restrict');
            $table->foreignId('vacancy_id')->constrained()->references('id')->on('vacancies')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_vacancies');
    }
};
