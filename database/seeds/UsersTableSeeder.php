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
        DB::table('users')->delete();


        $users = array(
            array(
                'first_name'    => 'Admin',
                'last_name'     => 'User',
                'phone'         => '0000000000',
                'email'         => 'admin@taskmanagement.com',
                'password'      => '$2y$10$LjSFIC7ffhdkLCUJazMzkuwNXI9s9RLVyAeuDhofbvgKb9p1c6JAO', //123456
                'is_active'     => '1',
                'user_role'     => '1',
                'apikey'        => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('users')->insert( $users );
    }
}