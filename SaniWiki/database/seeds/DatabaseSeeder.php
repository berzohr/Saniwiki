<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //$this->call(SectionsTableSeeder::class);
        //$this->call(PostsTableSeeder::class);
        //$this->call(SectionsPostsTableSeeder::class);
        $this->call(AccessGroupsTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@supsi.ch',
            'password' => bcrypt('saniadmin'),
            'accessGroup' => 3,
        ]);
        DB::table('users')->insert([
            'name' => 'Writer',
            'email' => 'writer@supsi.ch',
            'password' => bcrypt('saniwriter'),
            'accessGroup' => 2,
        ]);
        DB::table('users')->insert([
            'name' => 'Reader',
            'email' => 'reader@supsi.ch',
            'password' => bcrypt('sanireader'),
            'accessGroup' => 1,
        ]);
    }
}
