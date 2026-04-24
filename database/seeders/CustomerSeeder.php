<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['name' => 'Walk-in Customer', 'gender' => '-', 'phone' => '0000000000'],
            ['name' => 'John Doe', 'gender' => 'Male', 'phone' => '08123456789'],
            ['name' => 'Jane Smith', 'gender' => 'Female', 'phone' => '08987654321'],
        ];

        foreach ($customers as $customer) {
            \App\Models\Customer::create($customer);
        }
    }
}
