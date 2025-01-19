<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // Customer::truncate();
        // Schema::enableForeignKeyConstraints();
        
        for($i=0;$i<10;$i++){
            Customer::create([
                'customer_id'=>'KH'.substr('0000000000',strlen($i+1)).($i+1),
                'name' => 'Nhân viên '.($i+1),
                'email' => 'test'.($i+1).'@gmail.com',
                'password'=>Hash::make('123456'),
                'phone_number'=>'0903'.substr("0000000", strlen($i + 1)) . ($i + 1),
            ]);
        }
    }
}
