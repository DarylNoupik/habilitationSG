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
        Schema::create('user_equipement', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                    ->index();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->unsignedBigInteger('equipement_id')
                    ->index();
                $table->foreign('equipement_id')
                    ->references('id')
                    ->on('equipements')
                    ->onDelete('cascade');

                $table->primary(['user_id','equipement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_equipement');
    }
};
