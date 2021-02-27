<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [
            [
                'name' => 'Xiaomi Redmi 6',
                'description' => 'Display 5.45-inch HD+,Processor MediaTek Helio P22 chipset,RAM 3GB/4GB,Storage 32GB/64GB, expandable up to 256GB via microSD,Rear Cameras 12MP + 5MP,Front Camera 5MP,Battery 3,000mAh,Android 8.1 Oreo (Upgradeable to Android 9 Pie MIUI Global 11),Dimensions 147.5mm x 71.5mm x 8.3mm,Connectivity 802.11b/g/n, 2.4G WiFi / WiFi Direct, Bluetooth 4.2',
                'price' => 309,
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDiR1nTn9O3ZPgZJ9URtWyexg-sEy_cOjkJHVZWWcAqg-Vw11CzX3UXR66z8pIJyMlKimgSOXP&usqp=CAc'
            ],
            [
                'name' => 'Huawei P30',
                'description' => '128GB ROM, 8GB RAM',
                'price' => 1800,
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8d5ArO2D26iv5MgJvGqNAM3tMAHGEcZLMOvZlCgrXEdlez9lz9I2h18222meRR311MY-UECk&usqp=CAc'
            ],
            [
                'name' => 'Samsung Galaxy Note 8',
                'description' => 'Model:For Samsung Galaxy Note 8, Color: Black;Blue;Grey;Pink;Gold, Language: Multi-language, Display:6.3 inches,Super AMOLED capacitive touchscreen, 16M colors',
                'price' => 1200,
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrED8XJgRSOuWozwcHBWcy9NFOINM-M_wxnQHeHfrYhE998LwHwDH5tnPkBqn4_CutmLCS1sI5&usqp=CAc'
            ],
            [
                'name' => 'Vivo V17',
                'description' => '[8GB RAM/128GB ROM] Blue/White',
                'price' => 1093,
                'image_url' => 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRSMHDPkXAh7x1j4a50hjxQBeKd6mW4efMnfxbdr6jclWjzVANckmYDFVV6M6jUj-0BbP-hprObmjub7sXaYtiXj5py2BZK&usqp=CAY'
            ],
            [
                'name' => 'Apple Iphone SE',
                'description' => 'Powerful 4-inch iPhone with the A9 chip, 12MP iSight camera with 4K video recording, Secure Touch ID unlocking with fingerprint',
                'price' => 557,
                'image_url' => 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSZYeQ4XN-H8iovsftGxbBfyPYCJ-8Tumt-JOyhVK83KCpNbEhpGowLfalvWnlrrCs-41v0_wwS51WoEvETaF-6I3Yj4DQbA2yLiqQmO7DDUPSGDFG2heDgGQ&usqp=CAE'
            ],
            [
                'name' => 'Vivo V19',
                'description' => '8GB RAM 256GB ROM 5.5 inch Full Screen Smart Phone Android 9.1',
                'price' => 155,
                'image_url' => 'https://cf.shopee.com.my/file/a649e74ebf44a9ce2aa82d65a9e943be_tn'
            ],
            [
                'name' => 'Panasonic telephone system KX-TS500ML',
                'description' => '1 YEAR Local Manufacturer Warranty, ELECTRONIC VOLUME CONTROL, 3- STEP RINGER SELECTION, TIMED FLASH, SWITCHABLE TONE/ PULSE SETTINGS, LAST NUMBER REDIAL, WALL MOUNTABLE',
                'price' => 36.90,
                'image_url' => 'https://cf.shopee.com.my/file/1cbd9e9c9982c7884d5b28d103bcf2b4_tn'
            ],
        ];

        foreach ($datas as $data) {
            Product::create($data);
        }

    }
}
