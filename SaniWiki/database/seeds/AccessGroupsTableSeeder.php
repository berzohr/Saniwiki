<?php
use Illuminate\Database\Seeder;
class AccessGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accessGroups')->insert([
            'name' => 'Lettura',
        ]);
        DB::table('accessGroups')->insert([
            'name' => 'Lettura/Scrittura',
        ]);
        DB::table('accessGroups')->insert([
            'name' => 'Amministratore',
        ]);
    }
}