<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create(
            'news',
            function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('image')->nullable();
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->timestamp('published_at')->nullable();
                $table->boolean('is_active')->default(false);
                $table->timestamps();

                $table->index('is_active');
                $table->index('published_at');
            }
        );
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
