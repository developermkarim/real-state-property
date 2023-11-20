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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('ptype_id')->unsigned()->nullable();
            $table->unsignedBigInteger('amenities_id')->nullable();
            $table->string('property_slug')->unique();
            $table->string('property_code');
            $table->string('property_status');
            $table->decimal('lowest_price', 10, 2)->default(0.00)->nullable();
            $table->decimal('max_price',10,2)->default(0.00)->nullable();
            $table->string('property_thumbnail');
            $table->text('short_descp')->nullable();
            $table->text('long_descp')->nullable();
            $table->string('bedromms', 100)->nullable();
            $table->string('bathrooms', 100)->nullable();
            $table->string('garage', 100)->nullable();
            $table->string('garage_size', 100)->nullable();
            $table->string('property_size', 100)->nullable();
            $table->string('property_video', 100)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->integer('agent_id')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
