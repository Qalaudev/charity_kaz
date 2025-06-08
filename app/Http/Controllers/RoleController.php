<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-roles');
    }

    /**
     * Получить все роли с их правами
     */
    public function index(): JsonResponse
    {
        try {
            $roles = Role::with('permissions')->get();

            return response()->json([
                'success' => true,
                'data' => $roles,
                'message' => 'Роли успешно получены'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка получения ролей',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Создать новую роль
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $role = Role::create(['name' => $request->name,
                'guard_name' => 'web']);

            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->get();
                $role->syncPermissions($permissions);
            }

            $role->load('permissions');

            return response()->json([
                'success' => true,
                'data' => $role,
                'message' => 'Роль успешно создана'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка создания роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Получить конкретную роль
     */
    public function show(Role $role): JsonResponse
    {
        try {
            $role->load('permissions');

            return response()->json([
                'success' => true,
                'data' => $role,
                'message' => 'Роль успешно получена'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Роль не найдена',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Обновить роль
     */
    public function update(Request $request, Role $role): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($role->id)
            ],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $role->update(['name' => $request->name]);

            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->get();
                $role->syncPermissions($permissions);
            }

            $role->load('permissions');

            return response()->json([
                'success' => true,
                'data' => $role,
                'message' => 'Роль успешно обновлена'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка обновления роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Удалить роль
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            // Проверяем, не используется ли роль
            if ($role->users()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Невозможно удалить роль, которая назначена пользователям'
                ], 400);
            }

            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Роль успешно удалена'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка удаления роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

