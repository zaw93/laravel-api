<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAminityPlaceTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('aminity_place', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('amenity_id');
      $table->unsignedBigInteger('place_id');
      $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
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
    Schema::dropIfExists('aminity_place');
  }
}
