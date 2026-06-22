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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            $table->string('sku')
                ->unique();

            $table->decimal('price', 10, 2);

            $table->decimal('old_price', 10, 2)
                ->nullable();

            $table->unsignedInteger('stock')
                ->default(0);

            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->index();

            $table->json('attributes')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
