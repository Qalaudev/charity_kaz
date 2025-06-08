<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit articles');
    }

    /**
     * Получить все права
     */
    public function index(): JsonResponse
    {
        try {
            $permissions = Permission::withCount('roles')->get();

            return response()->json([
                'success' => true,
                'data' => $permissions,
                'message' => 'Права успешно получены'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка получения прав',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Создать новое право
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $permission = Permission::create([
                'name' => $request->name,
                'guard_name' => 'web' // Указываем guard по умолчанию
            ]);
            return response()->json([
                'success' => true,
                'data' => $permission,
                'message' => 'Право успешно создано'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка создания права',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Получить конкретное право
     */
    public function show(Permission $permission): JsonResponse
    {
        try {
            $permission->loadCount('roles');

            return response()->json([
                'success' => true,
                'data' => $permission,
                'message' => 'Право успешно получено'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Право не найдено',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Обновить право
     */
    public function update(Request $request, Permission $permission): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($permission->id)
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $permission->update(['name' => $request->name]);

            return response()->json([
                'success' => true,
                'data' => $permission,
                'message' => 'Право успешно обновлено'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка обновления права',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Удалить право
     */
    public function destroy(Permission $permission): JsonResponse
    {
        try {
            // Проверяем, не используется ли право в ролях
            if ($permission->roles()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Невозможно удалить право, которое используется в ролях'
                ], 400);
            }

            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Право успешно удалено'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка удаления права',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
