<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class FloorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=1; $i<=3; $i++){
            DB::table('floors')->insert([
                'name' => $faker->name,
                'display_order' => $i,
                'slug'=>$faker->slug,
                'created_by'=>1
    
            ]);

        }
        // factory(App\Models\Floor::class, 5)->create();
    }
}
