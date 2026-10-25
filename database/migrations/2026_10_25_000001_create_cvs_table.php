<?php

declare(strict_types=1);

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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title')->default('Resume Saya');
            $table->string('slug')->unique();
            $table->string('template_id')->default('classic');
            $table->string('selected_font')->default('inter');
            $table->string('doc_font_size')->default('doc-size-base');
            $table->string('accent_color')->default('#111827');
            $table->json('content');
            $table->unsignedTinyInteger('ats_score')->default(0);
            $table->boolean('is_public')->default(false);
            $table->timestamps();

            // Composite index untuk dashboard query yang ringan dan cepat
            $table->index(['user_id', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
