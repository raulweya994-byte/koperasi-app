<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            UserSeeder::class,
            KoperasiSeeder::class,
            AnggotaKoperasi15Seeder::class,
            GaleriFromStorageSeeder::class,
            StrukturFromStorageSeeder::class,
        ]);
    }
}
