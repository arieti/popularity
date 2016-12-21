<?php

use Illuminate\Database\Seeder;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('channels')->insert([
            'title' => 'PHP',
            'slug' => 'php',
            'color' => 'blue',
        ]);

        DB::table('channels')->insert([
            'title' => 'Javascript',
            'slug' => 'javascript',
            'color' => 'green',
        ]);

        DB::table('channels')->insert([
            'title' => 'Ruby',
            'slug' => 'ruby',
            'color' => 'pink',
        ]);

        factory(App\CommunityLink::class, 100)->create();
        factory(App\CommunityLinkVote::class, 200)->create();
    }
}
