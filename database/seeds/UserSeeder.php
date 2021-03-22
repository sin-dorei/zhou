<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(20)->create();

        $user = User::first();
        $user->name = 'Summer';
        $user->email = 'summer@emt.com';
        $user->save();
    }
}
