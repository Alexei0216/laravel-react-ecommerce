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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'canceled'])
                ->default('pending');

            $table->decimal('total', 10, 2);
            $table->enum('currency', ['EUR', 'USD'])
                ->default('EUR');

            $table->foreignId('shipping_address_id')
                ->nullable()
                ->constrained('user_addresses')
                ->nullOnDelete();

            $table->foreignId('billing_address_id')
                ->nullable()
                ->constrained('user_addresses')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
