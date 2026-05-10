<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

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

        DB::table('colors')->insert([
            ['name' => 'White',   'value' => '#FFFFFF'],
            ['name' => 'Black',   'value' => '#000000'],
            ['name' => 'Red',     'value' => '#FF0000'],
            ['name' => 'Navy',    'value' => '#001F5B'],
            ['name' => 'Gray',    'value' => '#A1A1A1'],
            ['name' => 'Blue',    'value' => '#1447e6'],
            ['name' => 'Green',   'value' => '#2aa63e'],
            ['name' => 'Magenta', 'value' => '#8a0194'],
            ['name' => 'Yellow',  'value' => '#FFDF20'],
        ]);

        DB::table('products')->insert([
            [
                'product_code' => 'SNK-01',
                'brand'        => 1,
                'name'         => 'Air Tech 3',
                'material'     => 'Leather',
                'basic_info'   => 'Classic low-top sneaker with premium cushioning',
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
            [
                'product_code' => 'SNK-04',
                'brand'        => 4,
                'name'         => 'Rita Cloud Run',
                'material'     => 'Knit',
                'basic_info'   => 'Lightweight everyday trainer with foam midsole',
                'origin'       => 'China',
                'price'        => 119.99,
            ],
            [
                'product_code' => 'SNK-05',
                'brand'        => 1,
                'name'         => 'Air Force Low',
                'material'     => 'Leather',
                'basic_info'   => 'Clean low-profile court shoe with padded collar',
                'origin'       => 'Vietnam',
                'price'        => 94.99,
            ],
            [
                'product_code' => 'SNK-06',
                'brand'        => 2,
                'name'         => 'Abibas Samba OG',
                'material'     => 'Leather/Suede',
                'basic_info'   => 'Retro indoor football shoe turned street icon',
                'origin'       => 'Germany',
                'price'        => 84.99,
            ],
            [
                'product_code' => 'SNK-07',
                'brand'        => 3,
                'name'         => 'Old Chaos 550',
                'material'     => 'Mesh/Suede',
                'basic_info'   => 'Retro basketball silhouette with plush cushioning',
                'origin'       => 'USA',
                'price'        => 114.99,
            ],
            [
                'product_code' => 'SNK-08',
                'brand'        => 4,
                'name'         => 'Rita Speed Elite',
                'material'     => 'Carbon Mesh',
                'basic_info'   => 'Competition-grade racing flat for serious runners',
                'origin'       => 'Japan',
                'price'        => 159.99,
            ],
        ]);

        DB::table('products_categories')->insert([
            ['product_id' => 'SNK-01', 'category_id' => 2],
            ['product_id' => 'SNK-01', 'category_id' => 4],
            ['product_id' => 'SNK-02', 'category_id' => 2],
            ['product_id' => 'SNK-02', 'category_id' => 4],
            ['product_id' => 'SNK-03', 'category_id' => 1],
            ['product_id' => 'SNK-03', 'category_id' => 4],
            ['product_id' => 'SNK-04', 'category_id' => 3],
            ['product_id' => 'SNK-04', 'category_id' => 4],
            ['product_id' => 'SNK-05', 'category_id' => 1],
            ['product_id' => 'SNK-05', 'category_id' => 2],
            ['product_id' => 'SNK-06', 'category_id' => 1],
            ['product_id' => 'SNK-06', 'category_id' => 2],
            ['product_id' => 'SNK-07', 'category_id' => 1],
            ['product_id' => 'SNK-07', 'category_id' => 3],
            ['product_id' => 'SNK-08', 'category_id' => 3],
            ['product_id' => 'SNK-08', 'category_id' => 4],
        ]);

        // color_id reference:
        // 1=White, 2=Black, 3=Red, 4=Navy, 5=Gray, 6=Blue, 7=Green, 8=Magenta, 9=Yellow
        $variants = [
            ['product_code' => 'SNK-01', 'color_id' => 1], // White
            ['product_code' => 'SNK-01', 'color_id' => 5], // Gray
            ['product_code' => 'SNK-02', 'color_id' => 2], // Black
            ['product_code' => 'SNK-02', 'color_id' => 6], // Blue
            ['product_code' => 'SNK-03', 'color_id' => 3], // Red
            ['product_code' => 'SNK-03', 'color_id' => 9], // Yellow
            ['product_code' => 'SNK-04', 'color_id' => 1], // White
            ['product_code' => 'SNK-04', 'color_id' => 2], // Black
            ['product_code' => 'SNK-05', 'color_id' => 1], // White
            ['product_code' => 'SNK-05', 'color_id' => 5], // Gray
            ['product_code' => 'SNK-06', 'color_id' => 5], // Gray
            ['product_code' => 'SNK-06', 'color_id' => 3], // Red
            ['product_code' => 'SNK-07', 'color_id' => 2], // Black
            ['product_code' => 'SNK-07', 'color_id' => 9], // Yellow
            ['product_code' => 'SNK-08', 'color_id' => 6], // Blue
            ['product_code' => 'SNK-08', 'color_id' => 3], // Red
        ];

        $shoes = [];
        foreach ($variants as $variant) {
            foreach (range(1, 6) as $size_id) {
                $shoes[] = [
                    'product_code'   => $variant['product_code'],
                    'color_id'       => $variant['color_id'],
                    'size_id'        => $size_id,
                    'stock_quantity' => rand(2, 20),
                ];
            }
        }
        DB::table('shoes')->insert($shoes);

        // Available images: black_shoes.png, black_var2.png, blue_shoes.png,
        //                   cream_shoes.png, gray_shoes.png, red_shoes.png,
        //                   swamp_shoes.png, yellow_shoes.png
        DB::table('images')->insert([
            // SNK-01 White
            ['product_code' => 'SNK-01', 'color_id' => 1, 'filename' => 'shoes/cream_shoes.png'],
            // SNK-01 Gray
            ['product_code' => 'SNK-01', 'color_id' => 5, 'filename' => 'shoes/gray_shoes.png'],
            ['product_code' => 'SNK-01', 'color_id' => 5, 'filename' => 'shoes/swamp_shoes.png'],
            // SNK-02 Black
            ['product_code' => 'SNK-02', 'color_id' => 2, 'filename' => 'shoes/black_shoes.png'],
            ['product_code' => 'SNK-02', 'color_id' => 2, 'filename' => 'shoes/black_var2.png'],
            // SNK-02 Blue
            ['product_code' => 'SNK-02', 'color_id' => 6, 'filename' => 'shoes/blue_shoes.png'],
            // SNK-03 Red
            ['product_code' => 'SNK-03', 'color_id' => 3, 'filename' => 'shoes/red_shoes.png'],
            ['product_code' => 'SNK-03', 'color_id' => 3, 'filename' => 'shoes/swamp_shoes.png'],
            // SNK-03 Yellow
            ['product_code' => 'SNK-03', 'color_id' => 9, 'filename' => 'shoes/yellow_shoes.png'],
            // SNK-04 White
            ['product_code' => 'SNK-04', 'color_id' => 1, 'filename' => 'shoes/cream_shoes.png'],
            // SNK-04 Black
            ['product_code' => 'SNK-04', 'color_id' => 2, 'filename' => 'shoes/black_shoes.png'],
            ['product_code' => 'SNK-04', 'color_id' => 2, 'filename' => 'shoes/black_var2.png'],
            // SNK-05 White
            ['product_code' => 'SNK-05', 'color_id' => 1, 'filename' => 'shoes/cream_shoes.png'],
            // SNK-05 Gray
            ['product_code' => 'SNK-05', 'color_id' => 5, 'filename' => 'shoes/gray_shoes.png'],
            // SNK-06 Gray
            ['product_code' => 'SNK-06', 'color_id' => 5, 'filename' => 'shoes/gray_shoes.png'],
            ['product_code' => 'SNK-06', 'color_id' => 5, 'filename' => 'shoes/swamp_shoes.png'],
            // SNK-06 Red
            ['product_code' => 'SNK-06', 'color_id' => 3, 'filename' => 'shoes/red_shoes.png'],
            // SNK-07 Black
            ['product_code' => 'SNK-07', 'color_id' => 2, 'filename' => 'shoes/black_shoes.png'],
            ['product_code' => 'SNK-07', 'color_id' => 2, 'filename' => 'shoes/black_var2.png'],
            // SNK-07 Yellow
            ['product_code' => 'SNK-07', 'color_id' => 9, 'filename' => 'shoes/yellow_shoes.png'],
            // SNK-08 Blue
            ['product_code' => 'SNK-08', 'color_id' => 6, 'filename' => 'shoes/blue_shoes.png'],
            // SNK-08 Red
            ['product_code' => 'SNK-08', 'color_id' => 3, 'filename' => 'shoes/red_shoes.png'],
        ]);

        DB::table('users')->insert([
            [
                'name'      => 'John',
                'surname'   => 'Doe',
                'phone_num' => '+1234567890',
                'email'     => 'john@example.com',
                'password'  => Hash::make('password'),
            ],
            [
                'name'      => 'Jane',
                'surname'   => 'Smith',
                'phone_num' => '+0987654321',
                'email'     => 'jane@example.com',
                'password'  => Hash::make('password'),
            ],
        ]);

        $admin = User::create([
            'name'      => 'Admin',
            'surname'   => 'User',
            'phone_num' => '+111111111',
            'email'     => 'admin@example.com',
            'password'  => Hash::make('password'),
        ]);

        Role::firstOrCreate(['name' => 'ADMIN']);
        $admin->assignRole('ADMIN');

        DB::table('stores')->insert([
            ['name' => 'Downtown Store', 'address' => '123 Main St, New York, NY'],
            ['name' => 'Mall Branch',    'address' => '456 Shopping Ave, Los Angeles, CA'],
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
            [
                'store_id'         => null,
                'user_id'          => 1,
                'payed_by_card'    => true,
                'deliver_to_store' => true,
                'address'          => 'Downtown Store',
                'total_price'      => 204.98,
                'user_name'        => 'John',
                'user_surname'     => 'Doe',
                'user_phone_num'   => '+1234567890',
                'user_email'       => 'john@example.com',
                'status'           => 1,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);

        DB::table('order_items')->insert([
            ['shoe_id' => 1,  'order_id' => 1, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shoe_id' => 13, 'order_id' => 2, 'quantity' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['shoe_id' => 20, 'order_id' => 2, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shoe_id' => 7,  'order_id' => 3, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shoe_id' => 31, 'order_id' => 3, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
