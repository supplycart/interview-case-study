<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddressBook;

class AddressBookSeeder extends Seeder
{
    public function run()
    {
        AddressBook::create([
            'full_name'                     => 'Ahmad Zali Bin Jamil',
            'country_code'                  => '60',
            'phone_number'                  => '0185793457',
            'address'                       => 'No 2, Jalan Damai, Taman Melati',
            'postcode'                      => 53100,
            'city'                          => 'Kuala Lumpur',
            'state'                         => 'Kuala lumpur',
            'label'                         => 'Home',
            'user_id'                       => 1,
            'is_default_shipping_address'   => true,
            'is_default_billing_address'    => true,
        ]);
    }
}
