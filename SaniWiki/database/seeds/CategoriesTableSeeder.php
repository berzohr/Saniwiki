<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Scale di Valutazione',
            'iconFontAw' => 'fas fa-chart-line',
            'iconURL' => '',
            'type' => 1,
        ]);

        DB::table('categories')->insert([
            'name' => 'Anatomia',
            'iconFontAW' => '',
            'iconURL' => '/images/categories/anatomia.png',
            'isIconURL' => 1,
            'type' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'Clinical Assessment',
            'iconFontAw' => 'fas fa-microscope',
            'iconURL' => '',
            'type' => 1,
        ]);

        DB::table('categories')->insert([
            'name' => 'Fisiologia',
            'iconFontAw' => '',
            'iconURL' => '/images/categories/fisiologia.png',
            'isIconURL' => true,
            'type' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'Patologia',
            'iconFontAw' => 'fas fa-diagnoses',
            'iconURL' => '',
            'type' => 1,
        ]);
    }
}
