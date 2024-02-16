<?php

namespace Database\Seeders;

use App\Models\WorkStage;
use Illuminate\Database\Seeder;

class WorkStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkStage::insertOrIgnore([
            ['id' => 1, "name" => "Material Plat"],
            ['id' => 2, "name" => "Perlengkapan Lambung Guard Railing"],
            ['id' => 3, "name" => "Perlengkapan Lambung Ventilasi"],
            ['id' => 4, "name" => "Perlengkapan Lambung Pintu Kedap Rumah Geladak"],
            ['id' => 5, "name" => "Perlengkapan Lambung Jendela Bulat"],
            ['id' => 6, "name" => "Perlengkapan Lambung Jendela Kotak"],
            ['id' => 7, "name" => "Pengadaan Mesin-mesin dan Perlengkapan Geladak"],
            ['id' => 8, "name" => "Pekerjaan Mesin-mesin dan Perlengkapan Geladak"],
            ['id' => 9, "name" => "Proses Assembly/Fabrikasi/Ereksi"],
            ['id' => 10, "name" => "Kedatangan ME/AE/Pompa dan Perlengkapan Mesin Lainnya"],
            ['id' => 11, "name" => "Install ME/AE/Pompa dan Perlengkapan Mesin Lainnya"],
            ['id' => 12, "name" => "Propeller dan As Propeller"],
            ['id' => 13, "name" => "Pekerjaan Perpipaan"],
            ['id' => 14, "name" => "Pekerjaan Tangki-Tangki"],
            ['id' => 15, "name" => "Kedatangan Material Panel dan Kabel"],
            ['id' => 16, "name" => "Kedatangan Peralatan Listrik dan Lampu"],
            ['id' => 17, "name" => "Pekerjaan Listrik"],
            ['id' => 18, "name" => "Kedatangan Peralatan Pemadam Kebakaran"],
            ['id' => 19, "name" => "Kedatangan Perlengkapan Keselamatan (standard SOLAS)"],
            ['id' => 20, "name" => "Kedatangan Perlengkapan Makan & Minum"],
            ['id' => 21, "name" => "Kedatangan Perlengkapan Serang"],
            ['id' => 22, "name" => "Kedatangan Perlengkapan Komunikasi & Navigasi (GMDSS A2)"],
            ['id' => 23, "name" => "Kedatangan Perkakas Kerja Mesin"],
        ]);
    }
}
