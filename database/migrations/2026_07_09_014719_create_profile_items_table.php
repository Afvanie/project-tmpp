<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_section_id')
                ->constrained('profile_sections')
                ->cascadeOnDelete();

            $table->string('item_group')->nullable();
            $table->string('title')->nullable();
            $table->longText('content');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_items');
    }
};