<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Nuke'],
            ['name' => 'Abibas'],
            ['name' => 'Old Chaos'],
            ['name' => 'Rita'],
        ]);

        DB::table('categories')->insert([
            ['name' => 'men'],
            ['name' => 'women'],
            ['name' => 'sport'],
            ['name' => 'new'],
        ]);

        DB::table('sizes')->insert([
            ['size' => '40'],
            ['size' => '41'],
            ['size' => '42'],
            ['size' => '43'],
            ['size' => '44'],
            ['size' => '45'],
        ]);

        DB::table('products')->insert([
            [
                'product_code' => 'SNK-01',
                'brand'        => 1,
                'name'         => 'Air Tech 3',
                'material'     => 'Leather',
                'basic_info'   => 'Classic low-top sneaker',
                'origin'       => 'Vietnam',
                'price'        => 109.99,
            ],
            [
                'product_code' => 'SNK-02',
                'brand'        => 2,
                'name'         => 'Josh Smith',
                'material'     => 'Leather',
                'basic_info'   => 'Iconic tennis-inspired sneaker',
                'origin'       => 'Germany',
                'price'        => 89.99,
            ],
            [
                'product_code' => 'SNK-03',
                'brand'        => 3,
                'name'         => '6767 Style',
                'material'     => 'Mesh/Suede',
                'basic_info'   => 'Heritage runner with ENCAP cushioning',
                'origin'       => 'USA',
                'price'        => 99.99,
            ],
        ]);

        DB::table('products_categories')->insert([
            ['product_id' => 'SNK-01',  'category_id' => 2],
            ['product_id' => 'SNK-01',  'category_id' => 4],
            ['product_id' => 'SNK-02', 'category_id' => 2],
            ['product_id' => 'SNK-02', 'category_id' => 4],
            ['product_id' => 'SNK-03',  'category_id' => 1],
            ['product_id' => 'SNK-03',  'category_id' => 4],
        ]);

        DB::table('colors')->insert([
            ['name' => 'White',  'value' => '#FFFFFF'],
            ['name' => 'Black',  'value' => '#000000'],
            ['name' => 'Red',    'value' => '#FF0000'],
            ['name' => 'Navy',   'value' => '#001F5B'],
            ['name' => 'Gray',   'value' => '#A1A1A1'],
            ['name' => 'Blue',   'value' => '#1447e6'],
            ['name' => 'Green',   'value' => '#2aa63e'],
            ['name' => 'Magenta',   'value' => '#8a0194'],
            ['name' => 'Yellow',   'value' => '#FFDF20'],
        ]);

        $shoes = [];
        $variants = [
            ['product_code' => 'SNK-01',  'color_id' => 1], // White
            ['product_code' => 'SNK-02',  'color_id' => 2], // Black
            ['product_code' => 'SNK-03', 'color_id' => 3], // White
            ['product_code' => 'SNK-01', 'color_id' => 5], // Navy
            ['product_code' => 'SNK-03',  'color_id' => 9], // Black
            ['product_code' => 'SNK-02',  'color_id' => 6], // Red
        ];

        foreach ($variants as $variant) {
            foreach (range(1, 5) as $size_id) {
                $shoes[] = [
                    'product_code'   => $variant['product_code'],
                    'color_id'       => $variant['color_id'],
                    'size_id'        => $size_id,
                    'stock_quantity' => rand(0, 16),
                ];
            }
        }
        DB::table('shoes')->insert($shoes);

        DB::table('images')->insert([
            ['product_code' => 'SNK-01',  'color_id' => 1, 'filename' => 'cream_shoes.png'],
            ['product_code' => 'SNK-01',  'color_id' => 5, 'filename' => 'gray_shoes.png'],
            ['product_code' => 'SNK-02', 'color_id' => 2, 'filename' => 'black_shoes.png'],
            ['product_code' => 'SNK-02', 'color_id' => 6, 'filename' => 'blue_shoes.png'],
            ['product_code' => 'SNK-03',  'color_id' => 3, 'filename' => 'red_shoes.png'],
            ['product_code' => 'SNK-03',  'color_id' => 9, 'filename' => 'yellow_shoes.png'],
        ]);

        DB::table('users')->insert([
            [
                'name'       => 'John',
                'surname'    => 'Doe',
                'phone_num'  => '+1234567890',
                'email'      => 'john@example.com',
                'password'   => Hash::make('password'),
            ],
            [
                'name'       => 'Jane',
                'surname'    => 'Smith',
                'phone_num'  => '+0987654321',
                'email'      => 'jane@example.com',
                'password'   => Hash::make('password'),
            ],
        ]);

        DB::table('stores')->insert([
            ['name' => 'Downtown Store',  'address' => '123 Main St, New York, NY'],
            ['name' => 'Mall Branch',     'address' => '456 Shopping Ave, Los Angeles, CA'],
        ]);

        DB::table('orders')->insert([
            [
                'store_id'         => 1,
                'user_id'          => 1,
                'payed_by_card'    => true,
                'deliver_to_store' => false,
                'address'          => '123 Main St, New York, NY',
                'total_price'      => 109.99,
                'user_name'        => 'John',
                'user_surname'     => 'Doe',
                'user_phone_num'   => '+1234567890',
                'user_email'       => 'john@example.com',
                'status'           => 1,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'store_id'         => null,
                'user_id'          => 2,
                'payed_by_card'    => false,
                'deliver_to_store' => false,
                'address'          => '789 Oak Street, Chicago, IL',
                'total_price'      => 189.98,
                'user_name'        => 'Jane',
                'user_surname'     => 'Smith',
                'user_phone_num'   => '+0987654321',
                'user_email'       => 'jane@example.com',
                'status'           => 0,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);

        DB::table('order_items')->insert([
            [
                'shoe_id'    => 1,
                'order_id'   => 1,
                'quantity'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shoe_id'    => 3,
                'order_id'   => 2,
                'quantity'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shoe_id'    => 6,
                'order_id'   => 2,
                'quantity'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
