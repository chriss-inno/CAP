<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserRights;
class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // User::truncate();

        $user=new User;
        $user->firstname = 'Administrator';
        $user->lastname = 'Administrator';
        $user->email = 'portal.administrator@bankm.com';
        $user->username = 'admin';
        $user->role = 'Administrator';
        $user->password = bcrypt('admin');
        $user->save();


       // UserRights::truncate();

        $usa=new UserRights;
        $usa->user_id=$user->id;
        $usa->cr=1;
        $usa->edit=1;
        $usa->dl=1;
        $usa->vw=1;
        $usa->authorize=1;
        $usa->modulecode=1;

        for($i=1; $i <5; $i++) {
            $usa->save();
            $usa = new UserRights;
            $usa->user_id = $user->id;
            $usa->cr = 1;
            $usa->edit = 1;
            $usa->dl = 1;
            $usa->vw = 1;
            $usa->authorize = 1;
            $usa->modulecode = $i;
            $usa->save();
        }

        $user1=new User;
        $user1->firstname = 'Adolph';
        $user1->lastname = 'Mwakalinga';
        $user1->email = 'adolph.mwakalinga@bankm.com';
        $user1->username = 'adolph.mwakalinga';
        $user1->role = 'Administrator';
        $user1->password = bcrypt('password1,');
        $user1->save();


       // UserRights::truncate();

        $usa=new UserRights;
        $usa->user_id=$user1->id;
        $usa->cr=1;
        $usa->edit=1;
        $usa->dl=1;
        $usa->vw=1;
        $usa->authorize=1;
        $usa->modulecode=1;

        for($i=1; $i <5; $i++) {
            $usa->save();
            $usa = new UserRights;
            $usa->user_id = $user->id;
            $usa->cr = 1;
            $usa->edit = 1;
            $usa->dl = 1;
            $usa->vw = 1;
            $usa->authorize = 1;
            $usa->modulecode = $i;
            $usa->save();
        }


    }

}
