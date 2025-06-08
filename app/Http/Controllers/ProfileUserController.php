<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{

    public function authUser()
    {
        $user = auth()->user();
        return response()->json($user);
    }


    /**
     * Display a listing of users.
     */
    public function index()
    {
        try {
            $users = User::orderBy('name')->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first(), // Только первая роль
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $users,
                'message' => 'Users retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the user's role.
     */
    public function updateRole(UpdateUserRoleRequest $request, User $user)
    {
        try {
            $newRole = $request->validated()['role'];

            // Удаляем все текущие роли и назначаем новую
            $user->syncRoles([$newRole]);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first(), // Получаем текущую роль
                ],
                'message' => "User role updated successfully to {$newRole}"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user role',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'surname'  => 'string|max:255',
            'gender'     => 'in:male,female',
            'phone_number'      => 'string|max:20',
            'city'=> 'string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('public/profile_photos', $filename);
            $validatedData['photo_url'] = Storage::url($path);
        }

        User::find(Auth::id())->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Профиль сақталды!',
        ], 201);
    }

}
