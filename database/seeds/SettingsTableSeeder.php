<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([

        	'site_name'       =>     "For Events",

        	'address'         =>     'Egypt, Cairo',

        	'contact_number'  =>     '02 0111 167 3229',

        	'contact_email'   =>     'ahmed.d.hamdallah@gmail.com'
        ]);
    }
}
