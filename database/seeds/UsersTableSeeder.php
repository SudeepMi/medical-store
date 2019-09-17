<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'address'=>'address',
            'phone'=>'98418552555',
            'pin'=>1234,
            'role'=>'1',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'created_by'=>1,
            'discount'=>20,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        // factory(App\Models\User::class, 5)->create();
    }
}
