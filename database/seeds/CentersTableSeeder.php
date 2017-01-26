<?php

use Illuminate\Database\Seeder;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centers')->delete();

        $center1 = Center::create(array(
            'name'  => 'Center1',
            ));
        $center2 = Center::create(array(
            'name'  => 'Center2',
        ));
        $center3 = Center::create(array(
            'name'  => 'Center3',
        ));
        $center4 = Center::create(array(
            'name'  => 'Center4',
        ));


    }
}
