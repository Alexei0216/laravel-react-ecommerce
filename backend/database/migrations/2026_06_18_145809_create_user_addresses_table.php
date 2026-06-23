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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type')
                ->default('shipping');

            $table->index(['user_id', 'type']);

            $table->string('country_code', 2)
                ->index();

            $table->string('province', 100)
                ->nullable();

            $table->string('city', 100);

            $table->string('postal_code', 20);

            $table->string('address_line_1', 255);

            $table->string('address_line_2', 255)
                ->nullable();

            $table->text('delivery_notes')
                ->nullable();

            $table->string('phone', 20)
                ->nullable();

            $table->string('recipient_name', 100);

            $table->boolean('is_default')
                ->default(false)
                ->index();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
