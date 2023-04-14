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
        Schema::disableForeignKeyConstraints();
        Schema::create('application_fonction', function (Blueprint $table) {
            $table->unsignedBigInteger('fonction_id')
                    ->index();
            $table->foreign('fonction_id')
                    ->references('id')
                    ->on('fonctions')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('application_id')
                    ->index();
            $table->foreign('application_id')
                    ->references('id')
                    ->on('applications')
                    ->onDelete('cascade');

            $table->primary(['fonction_id','application_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('application_fonction');
      
    }
};
