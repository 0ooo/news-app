<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['admin', 'user', 'moderator']);
        $roles->each(function($role) {
            DB::table('roles')->insert([
                'slug' => $role
            ]);
        });
    }
}
