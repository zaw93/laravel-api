<?php

use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $amenities = App\Amenity::all();

    factory(App\Place::class, 10)->create()->each(function ($place) use ($amenities) {
      $place->amenities()->attach(
        $amenities->random(rand(3, 8))->pluck('id')->toArray()
      );
    });
  }
}
