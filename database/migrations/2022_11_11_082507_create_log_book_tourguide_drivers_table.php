<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogBookTourguideDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_book_tourguide_drivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tourguide_driver_id')->references('id')->on('tourguide_drivers');
            $table->foreignUuid('log_book_id')->references('id')->on('log_books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_book_tourguide_drivers');
    }
}
