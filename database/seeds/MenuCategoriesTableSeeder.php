<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
class MenuCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 'prefix', 'name', 'description','status'
        DB::table('menu_categories')->insert([
            'is_special'=>1,
            'prefix' => 'S',
            'name' => 'Special',
            'description' => $faker->text,
            'status' => 1,
            'slug'=>'special',
            'created_by'=>1,
            'created_at'=>Carbon::now() 
        ]);
        for($i=1;$i<=6;$i++){
            DB::table('menu_categories')->insert([
                'prefix' => $faker->stateAbbr,
                'name' => $faker->name,
                'description' => $faker->text,
                'status' => 1,
                'slug'=>$faker->slug,
                'created_by'=>1,
                'created_at'=>Carbon::now() 
            ]);

        }
    }
}
