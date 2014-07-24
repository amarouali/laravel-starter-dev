<?php

class UsersTableSeeder extends Seeder {

 public function run()
    {
        DB::table('users')->delete();

		$role = new Role();
        $users = array(
            array(
                'username'      => 'admin',
                'email'      	=> 'admin@admin.fr',
                'password'   	=> Hash::make('admin'),
                'role_id'		=>$role->where('name','=','admin')->firstOrFail()->id,
                'created_at' 	=> new DateTime,
                'updated_at' 	=> new DateTime,
            ),
            array(
                'username'      => 'user',
                'email'      	=> 'user@example.org',
                'password'   	=> Hash::make('user'),
                'role_id'		=>$role->where('name','=','membre')->firstOrFail()->id,
                'created_at' 	=> new DateTime,
                'updated_at' 	=> new DateTime,
            )
        );

        DB::table('users')->insert( $users );
    }

}