<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=1;$i<=30;$i++){

            DB::table('menu_items')->insert([
               'code' => $faker->userName,
               'menu_category_id'=> $faker->numberBetween($min = 1, $max = 5),
               'slug'=>$faker->slug,
               'name' => $faker->name,
               'description' => $faker->text,
               'price' => $faker->numberBetween($min = 200, $max = 400),
               'is_discountable' => 1,
               'discount'=>10,
               'status' => 1,
               'created_by'=>1,
               'created_at'=>Carbon::now()
   
           ]);
        }
    }
}
