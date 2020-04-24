<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','deepak.mca17.du@gmail.com')->first();

        if(!$user){
            User::create([
                'name'=>'Deepak Yadav',
                'email'=>'deepak.mca17.du@gmail.com',
                'role'=>'admin',
                'password'=>Hash::make('password')
            ]);
        }

    }
}
