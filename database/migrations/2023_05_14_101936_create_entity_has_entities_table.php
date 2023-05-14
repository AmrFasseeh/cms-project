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
        Schema::create('entity_has_entities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_entity_id');
            $table->unsignedBigInteger('secondary_entity_id');

            $table->foreign('primary_entity_id')
                ->references('id')
                ->on('entities');

            $table->foreign('secondary_entity_id')
                ->references('id')
                ->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_has_entities');
    }
};
