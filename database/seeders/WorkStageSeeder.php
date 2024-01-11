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
            ['id' => 1, "work_stage" => "Material Plat"],
            ['id' => 2, "work_stage" => "Perlengkapan Lambung Guard Railing"],
            ['id' => 3, "work_stage" => "Perlengkapan Lambung Ventilasi"],
            ['id' => 4, "work_stage" => "Perlengkapan Lambung Pintu Kedap Rumah Geladak"],
            ['id' => 5, "work_stage" => "Perlengkapan Lambung Jendela Bulat"],
            ['id' => 6, "work_stage" => "Perlengkapan Lambung Jendela Kotak"],
            ['id' => 7, "work_stage" => "Pengadaan Mesin-mesin dan Perlengkapan Geladak"],
            ['id' => 8, "work_stage" => "Pekerjaan Mesin-mesin dan Perlengkapan Geladak"],
            ['id' => 9, "work_stage" => "Proses Assembly/Fabrikasi/Ereksi"],
            ['id' => 10, "work_stage" => "Kedatangan ME/AE/Pompa dan Perlengkapan Mesin Lainnya"],
            ['id' => 11, "work_stage" => "Install ME/AE/Pompa dan Perlengkapan Mesin Lainnya"],
            ['id' => 12, "work_stage" => "Propeller dan As Propeller"],
            ['id' => 13, "work_stage" => "Pekerjaan Perpipaan"],
            ['id' => 14, "work_stage" => "Pekerjaan Tangki-Tangki"],
            ['id' => 15, "work_stage" => "Kedatangan Material Panel dan Kabel"],
            ['id' => 16, "work_stage" => "Kedatangan Peralatan Listrik dan Lampu"],
            ['id' => 17, "work_stage" => "Pekerjaan Listrik"],
            ['id' => 18, "work_stage" => "Kedatangan Peralatan Pemadam Kebakaran"],
            ['id' => 19, "work_stage" => "Kedatangan Perlengkapan Keselamatan (standard SOLAS)"],
            ['id' => 20, "work_stage" => "Kedatangan Perlengkapan Makan & Minum"],
            ['id' => 21, "work_stage" => "Kedatangan Perlengkapan Serang"],
            ['id' => 22, "work_stage" => "Kedatangan Perlengkapan Komunikasi & Navigasi (GMDSS A2)"],
            ['id' => 23, "work_stage" => "Kedatangan Perkakas Kerja Mesin"],
        ]);
    }
}
