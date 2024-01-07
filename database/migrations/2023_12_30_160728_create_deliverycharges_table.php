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
        Schema::create('deliverycharges', function (Blueprint $table) {
            $table->id();
            $table->string('from_location');
            $table->string('destination');
            $table->string('category');
            // $table->string('category_regular')->default('regular');
            // $table->string('category_document')->default('document');
            // $table->string('category_book')->default('book');
            $table->float('regular')->default(50);
            $table->float('same_day')->default(50);
            // $table->float('pickup')->default(50);
            // $table->float('pickup_drop')->default(80);
            // $table->float('weight')->default(1);
            // $table->float('price')->default(50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliverycharges');
    }
};
