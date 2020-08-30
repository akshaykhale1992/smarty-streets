<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummyData = [
            [
                'address'       => '3301 E South 13th St, York NE',
                'city'          => 'York',
                'state'         => 'NE',
                'zipcode'       => '62534',
                'property_type' => 'single_home',
                'longitude'     => '39.52077',
                'latitude'      => '-88.75366',
                'sa_country'    => 'US',
                'ga_country'    => 'US',
            ],
            [
                'address'       => '31 Bridget Way, Sparta NJ',
                'city'          => 'Sparta',
                'state'         => 'NJ',
                'zipcode'       => '07871',
                'property_type' => 'multifamily',
                'longitude'     => '-74.63868',
                'latitude'      => '41.03575',
                'sa_country'    => 'US',
                'ga_country'    => 'US',
            ],
        ];
        Address::insert($dummyData);
    }
}
