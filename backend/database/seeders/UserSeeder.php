<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        
        for($i=0;$i<10;$i++){
            User::create([
                'name' => 'Nhân viên '.($i+1),
                'email' => 'Nvtest'.($i+1).'@gmail.com',
                'password'=>Hash::make('123456'),
            ]);
        }
    }
}
