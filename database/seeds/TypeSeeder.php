<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $types = ['entire_place', 'private_room', 'shared_room'];

    foreach ($types as $type) {
      Type::create(['name' => $type]);
    }
  }
}
