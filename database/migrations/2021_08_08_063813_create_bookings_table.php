<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();
      $table->date('checkin');
      $table->date('checkout');
      $table->integer('guest_count');
      $table->integer('total_price');
      $table->integer('status');
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('place_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
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
    Schema::dropIfExists('bookings');
  }
}
