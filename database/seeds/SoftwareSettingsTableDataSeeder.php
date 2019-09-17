<?php

use Illuminate\Database\Seeder;

class SoftwareSettingsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('software_settings')->insert([
        //     'name' => 'Setup Wizard',
        //     'slug' => 'setup-wizard',
        //     'value' => '1',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('software_settings')->insert([
        //     'name' => 'name in bill',
        //     'slug' => 'name-in-bill',
        //     'value' => 'Klientsoft Pvt. Ltd',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('software_settings')->insert([
        //     'name' => 'address in bill',
        //     'slug' => 'address-in-bill',
        //     'value' => 'Gairidhara, Kathmandu',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('software_settings')->insert([
        //     'name' => 'phone no in bill',
        //     'slug' => 'phone-no-in-bill',
        //     'value' => '9801116772',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('software_settings')->insert([
        //     'name' => 'vat no in bill',
        //     'slug' => 'vat-no-in-bill',
        //     'value' => '123456789',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('software_settings')->insert([
        //     'name' => 'thank you note in bill',
        //     'slug' => 'thank-you-note-in-bill',
        //     'value' => 'Happy Customer',
        //     'created_by' => 1,
        //     'status' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        DB::table('software_settings')->insert([
            'name' => 'Print Bill',
            'slug' => 'print-bill',
            'value' => '1',
            'created_by' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('software_settings')->insert([
            'name' => 'Print Kot',
            'slug' => 'print-kot',
            'value' => '1',
            'created_by' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
