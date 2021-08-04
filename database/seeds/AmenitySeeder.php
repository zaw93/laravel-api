<?php

use App\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $amenities = [
      'Breakfast',
      'Kitchen',
      'Microwave',
      'Bathtub',
      'Hair dryer',
      'Iron',
      'Refrigerator',
      'Washer',
      'Air conditioning',
      'Wifi',
      'TV'
    ];

    foreach ($amenities as $amenity) {
      Amenity::create(['name' => $amenity]);
    }
  }
}
