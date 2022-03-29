<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Database\Factories\VoucherFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create((new VoucherFactory())->definition());
    }
}
