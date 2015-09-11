<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CASerialNumber;
class SerialnoTableSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CASerialNumber::truncate();
        CASerialNumber::create([
            'startno'=>'0'
        ] );
    }

}
