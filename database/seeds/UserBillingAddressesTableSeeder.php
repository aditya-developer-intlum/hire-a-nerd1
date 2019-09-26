<?php

use Illuminate\Database\Seeder;

class UserBillingAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_billing_addresses')->delete();
        
        \DB::table('user_billing_addresses')->insert(array (
            0 => 
            array (
                'id' => 9,
                'user_id' => 18,
                'company_name' => 'Intlum',
                'full_name' => 'Aditya Kumar',
                'country_id' => 'India',
                'address' => '5 Thomas Avenue 
Waterford',
                'city_id' => 'MI',
                'zip_code' => 48329,
                'is_invoice' => 1,
                'created_at' => '2019-06-27 11:33:07',
                'updated_at' => '2019-06-27 11:33:07',
            ),
            1 => 
            array (
                'id' => 10,
                'user_id' => 71023,
                'company_name' => 'asdsa',
                'full_name' => 'Estell Schoen',
                'country_id' => 'India',
                'address' => 'kolkata',
                'city_id' => 'Muzaffarpur',
                'zip_code' => 55372,
                'is_invoice' => 1,
                'created_at' => '2019-07-09 11:04:43',
                'updated_at' => '2019-08-22 17:56:21',
            ),
        ));
        
        
    }
}