<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // CategoryProduct::truncate();
        // Schema::enableForeignKeyConstraints();

        $data=['Guitar','Piano','Drum'];
        foreach($data as $dt){
            CategoryProduct::create([
                'name'=>$dt,
            ]);
        }
    }
}
