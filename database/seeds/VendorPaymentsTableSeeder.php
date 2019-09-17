<?php

use Illuminate\Database\Seeder;

class VendorPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendor_payments')->insert([
            'vendor_id' => 1,
            'amount' => '1000',
            'payment_mode'=>1,
            'refrence_no'=>'98418552555',
            'made_by'=>1,
        ]);
        //
    }
}
