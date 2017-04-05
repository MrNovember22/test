<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'James',
                'email' => 'james@gmail.com',
                'password' => bcrypt('111111'),
                'status_id' => 1
            ]);
    }
}
