<?php

use Illuminate\Database\Seeder;

class DesignInvoicesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('design_invoices')->insert([
            'show_customer_name' => 1,
            'show_pan_no' => 1,
            'show_amount_text' => 1,
            'show_greeting_note' => 1,
            'show_operator_name' => 1,
            'show_customer_address' => 1,
            'last_updated_by' => 1,
            'last_updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
