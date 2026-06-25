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
        Schema::connection('mongodb')->create('images', function (Blueprint $collection) {
            $collection->autoIncrement('_id');
            $collection->unsignedBigInteger('company_id');
            $collection->string('image_path');
            $collection->timestamps();

            // Ajoutez l'index pour la référence à la compagnie
            $collection->index('company_id');

            // Définissez la relation avec la compagnie
            $collection->foreign('company_id')
                        ->references('_id')
                        ->on('companies')
                        ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('images');
    }
};
