<?php

use App\Models\Event;
use App\Models\Menu;
use App\Models\Venue;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('number')->nullable();
            $table->date('from');
            $table->date('to');
            $table->foreignIdFor(Event::class);
            $table->foreignIdFor(Venue::class);
            $table->foreignIdFor(Menu::class);
            $table->integer('people');
            $table->string('bookby');
            $table->string('contact')->nullable();
            $table->string('email');






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
