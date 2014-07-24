<?php

class RolesTableSeeder extends Seeder {


    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $membreRole = new Role;
        $membreRole->name = 'membre';
        $membreRole->save();

    }
}