<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Очистим кэш ролей и пермишинов
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Список разрешений
        $permissions = [
            'view users',
            'edit users',
            'delete users',
            'create users',
            'view articles',
            'edit articles',
            'delete articles',
            'publish articles',
        ];

        // Создание пермишинов
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Создание ролей и назначение соответствующих прав

        // Админ — получает все права
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Редактор — только с правами на статьи
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $editorRole->syncPermissions([
            'view articles',
            'edit articles',
            'publish articles',
        ]);

        // Пользователь — только просмотр
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions([
            'view articles',
        ]);
    }
}
