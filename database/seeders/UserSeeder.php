<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        $editPermission = Permission::firstOrCreate(['name' => 'edit articles', 'guard_name' => 'web']);
        $viewPermission = Permission::firstOrCreate(['name' => 'view articles', 'guard_name' => 'web']);


        // Назначение прав ролям
        $adminRole->givePermissionTo($editPermission);
        $editorRole->givePermissionTo($viewPermission);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // поиск по email
            [ // если не найден — создать
                'name' => 'Admin User',
                'surname' => 'Admin',
                'gender' => 'male',
                'phone_number' => '123456789',
                'city' => 'City A',
                'password' => Hash::make('adminpassword')
            ]
        );

        // Назначение роли админа
        $admin->assignRole('admin');

        $user = User::firstOrCreate(
            [ 'name' => 'Normal User'],
            [
            'surname' => 'User',
            'gender' => 'female',
            'phone_number' => '987654321',
            'city' => 'City B',
            'email' => 'user@example.com',
            'password' => Hash::make('userpassword')
        ]);

        // Назначение роли пользователя
        $user->assignRole('user');

        $editor = User::firstOrCreate(
            [ 'name' => 'Editor User',],
            [
            'surname' => 'Editor',
            'gender' => 'male',
            'phone_number' => '111222333',
            'city' => 'City C',
            'email' => 'editor@example.com',
            'password' => Hash::make('editorpassword')
        ]);

        // Назначение роли редактора
        $editor->assignRole('editor');
    }
}
