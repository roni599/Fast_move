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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('divisions');
            $table->string('district');
            $table->string('police_station');
            $table->string('category_type');
            $table->string('delivery_type');
            $table->uuid('order_tracking_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('cod_amount', 10, 2);
            $table->string('invoice');
            $table->text('note')->nullable();
            $table->decimal('weight', 8, 2);
            $table->string('exchange_parcel');
            $table->string('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
