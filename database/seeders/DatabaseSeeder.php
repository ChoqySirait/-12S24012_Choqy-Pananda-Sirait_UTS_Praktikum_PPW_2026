<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $catSrv = DB::table('categories')->insertGetId([
            'name' => 'Server & Cloud',
            'code' => 'SRV',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $catIot = DB::table('categories')->insertGetId([
            'name' => 'Internet of Things',
            'code' => 'IOT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $catDrn = DB::table('categories')->insertGetId([
            'name' => 'Multimedia & Drone',
            'code' => 'DRN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('equipments')->insert([
            [
                'category_id' => $catSrv,
                'asset_code' => 'EQ-SRV-001',
                'name' => 'Dell PowerEdge T40 Server',
                'specification' => 'Intel Xeon E-2224G, 16GB DDR4 ECC, 1TB SATA HDD',
                'condition' => 'baik',
                'status' => 'dipinjam',
                'daily_rental_fee' => 75000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $catSrv,
                'asset_code' => 'EQ-SRV-002',
                'name' => 'HP ProLiant MicroServer Gen10 Plus',
                'specification' => 'Intel Xeon E-2224, 32GB RAM, 2x 2TB NVMe SSD',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 90000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $catIot,
                'asset_code' => 'EQ-IOT-001',
                'name' => 'NVIDIA Jetson Nano Developer Kit',
                'specification' => 'Quad-core ARM A57, 128-core Maxwell GPU, 4GB LPDDR4',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 30000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $catIot,
                'asset_code' => 'EQ-IOT-002',
                'name' => 'Espressif ESP32 IoT Sensor Starter Pack',
                'specification' => 'Dual-Core 240MHz, Wi-Fi & Bluetooth, 15+ Sensor Kit',
                'condition' => 'rusak_ringan',
                'status' => 'dalam_perbaikan',
                'daily_rental_fee' => 10000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $catDrn,
                'asset_code' => 'EQ-DRN-001',
                'name' => 'DJI Mavic Air 2 Fly More Combo',
                'specification' => '4K 60fps Video, 34 Min Flight Time, 3-Axis Gimbal',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 50000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $catDrn,
                'asset_code' => 'EQ-DRN-003',
                'name' => 'FPV Racing Drone BetaFPV Cetus Pro',
                'specification' => 'Brushless Motors, Altitude Hold, Emergency Landing',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 25000,
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}