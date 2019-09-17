<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TestSeeder::class);

        $this->call(UsersTableSeeder::class);
        // $this->call(FloorsTableSeeder::class);
        // $this->call(MenuCategoriesTableSeeder::class);
        // $this->call(MenuItemsTableSeeder::class);
        // $this->call(DesignInvoicesTableDataSeeder::class);
        $this->call(SoftwareSettingsTableDataSeeder::class);
        // $this->call(VendorPaymentsTableSeeder::class);

    }
}
