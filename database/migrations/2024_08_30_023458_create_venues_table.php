<?php

use App\Models\Amenity;
use App\Models\District;
use App\Models\Taluk;
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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('city')->nullable();
            $table->foreignIdFor(Taluk::class);
            $table->foreignIdFor(District::class);
            $table->foreignIdFor(Amenity::class)->nullable();
            $table->string('pincode')->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('gmap')->nullable();
            $table->string('avaiable')->nullable();
            $table->boolean('active')->nullable();
            $table->string('rate')->nullable();
            $table->string('avaiablearea')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
