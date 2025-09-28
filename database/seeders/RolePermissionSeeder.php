<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name'=> 'owner']);

        $memberRole = Role::create(['name'=> 'member']);

        $userOwner =  User::create([
            'name'  => 'Abdullah',
            'avatar'  => 'images/default-avatar.png',
            'email'  => 'admin@taarufland.com',
            'password'  => bcrypt('123123123'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
