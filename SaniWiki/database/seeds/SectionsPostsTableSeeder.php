<?php

use Illuminate\Database\Seeder;

class SectionsPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\SectionsPosts::class, 5)->create();
    }
}