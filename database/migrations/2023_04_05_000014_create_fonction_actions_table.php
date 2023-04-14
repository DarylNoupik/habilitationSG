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
        Schema::create('fonction_actions', function (Blueprint $table) {
            $table->unsignedBigInteger('fonction_id')
                    ->index();
            $table->foreign('fonction_id')
                    ->references('id')
                    ->on('fonctions')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('action_id')
                    ->index();
            $table->foreign('action_id')
                    ->references('id')
                    ->on('actions')
                    ->onDelete('cascade');

            $table->primary(['fonction_id','action_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonction_actions');
    }
};
