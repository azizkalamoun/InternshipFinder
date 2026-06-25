<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('companies', function (Blueprint $table) {
        $table->id()->autoIncrement();
        $table->string('name_company');
        $table->string('adresse');
        $table->string('logo_img')->nullable();
        $table->string('language');
        $table->text('description')->nullable();
        $table->integer('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('full_location')->nullable();
        $table->string('linked_in_name')->nullable();
        $table->string('website')->nullable();
        $table->integer('rating')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
