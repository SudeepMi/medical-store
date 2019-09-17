<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=1;$i<=200;$i++){
            DB::table('kot_items')->insert([
                'kot_id' => 1,
                'item_id' => $faker->numberBetween($min = 1, $max = 30),
                'quantity' => $faker->numberBetween($min = 1, $max = 10000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        }
        for($i=1;$i<=100;$i++){
        
            DB::table('bills')->insert([
                'order_id'=>$i,
                'bill_no'=>'190816-'.$i,
                'customer_name'=>$faker->name,
                'customer_pan'=>$faker->name,
                'customer_phone'=>$faker->name,
                'customer_address'=>$faker->name,
                'pax'=>1,
                'is_discount'=>1,
                'discount_percent'=>1,
                'discount_amount'=>1,
                'is_service_charge'=>1,
                'service_charge_percent'=>1,
                'service_charge_amount'=>1,
                'sub_total'=>$faker->numberBetween($min = 1, $max = 1000),
                'sub_total_with_discount'=>1,
                'sub_total_with_sc'=>1,
                'total'=>$faker->numberBetween($min = 200, $max = 10000),
                'print_count'=>$faker->numberBetween($min = 1, $max = 3),
                'received'=>1,
                'return'=>1,
                'tip'=>1,
                'round'=>0.1,
                'payment_type'=>$faker->numberBetween($min = 1, $max = 2),
                'created_by'=>1,
                'created_at'=>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                'updated_at'=>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)

            ]);
        }
    }
}
