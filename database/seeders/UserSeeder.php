<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'App Admin',
            'email' => 'admin@doqsys.com',
        ]);

        $user->givePermissionTo(['modify document', 'modify folder', 'manage users']);

        $users = User::factory(7)->create();

        $users->each(function (User $user) {
            $user->givePermissionTo('modify document');
        });

        $users = User::factory(7)->create();

        $users->each(function (User $user) {
            $user->givePermissionTo('modify folder');
        });

        $users = User::factory(7)->create();

        $users->each(function (User $user) {
            $user->givePermissionTo('manage users');
        });

        User::factory(7)->create();
    }
}
