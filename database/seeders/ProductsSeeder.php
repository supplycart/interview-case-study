<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Samsung Galaxy S9',
            'description' => 'A brand new, sealed Lilac Purple Verizon Global Unlocked Galaxy S9 by Samsung. This is an upgrade. Clean ESN and activation ready.',
            'photo' => 'https://i.ebayimg.com/00/s/ODY0WDgwMA==/z/9S4AAOSwMZRanqb7/$_35.JPG?set_id=89040003C1',
            'price' => 698.88
         ]);
         Product::create([
            'name' => 'Apple iPhone X',
            'description' => 'GSM & CDMA FACTORY UNLOCKED! WORKS WORLDWIDE! FACTORY UNLOCKED. iPhone x 64gb. iPhone 8 64gb. iPhone 8 64gb. iPhone X with iOS 11.',
            'photo' => 'https://i.ebayimg.com/00/s/MTYwMFg5OTU=/z/9UAAAOSwFyhaFXZJ/$_35.JPG?set_id=89040003C1',
            'price' => 983.00
         ]);
         Product::create([
            'name' => 'Google Pixel 2 XL',
            'description' => 'New condition
• No returns, but backed by eBay Money back guarantee',
            'photo' => 'https://i.ebayimg.com/00/s/MTYwMFg4MzA=/z/G2YAAOSwUJlZ4yQd/$_35.JPG?set_id=89040003C1',
            'price' => 675.00
         ]);
         Product::create([
            'name' => 'LG V10 H900',
            'description' => 'NETWORK Technology GSM. Protection Corning Gorilla Glass 4. MISC Colors Space Black, Luxe White, Modern Beige, Ocean Blue, Opal Blue. SAR EU 0.59 W/kg (head).',
            'photo' => 'https://i.ebayimg.com/00/s/NjQxWDQyNA==/z/VDoAAOSwgk1XF2oo/$_35.JPG?set_id=89040003C1',
            'price' => 159.99
         ]);
         Product::create([
            'name' => 'Huawei Elate',
            'description' => 'Cricket Wireless - Huawei Elate. New Sealed Huawei Elate Smartphone.',
            'photo' => 'https://ssli.ebayimg.com/images/g/aJ0AAOSw7zlaldY2/s-l640.jpg',
            'price' => 68.00
         ]);
         Product::create([
            'name' => 'HTC One M10',
            'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
            'photo' => 'https://i.ebayimg.com/images/g/u-kAAOSw9p9aXNyf/s-l500.jpg',
            'price' => 129.99
         ]);
    }
}
