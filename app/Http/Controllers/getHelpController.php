<?php

namespace App\Http\Controllers;

use App\Models\GetHelp;
use Illuminate\Http\Request;

class getHelpController extends Controller
{
    public function getHelp(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number' => 'required|string',
            'email' => 'required|email',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
            'info' => 'required|string',
        ]);

        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $imagePath = $request->file('file')->storeAs('GetHelp', $fileName, 'public');
        $validated['file'] = 'storage/' . $imagePath;

        $help = GetHelp::create($validated);

        return response()->json($help);
    }
    public function update(Request $request, $id)
    {
        $help = GetHelp::find($id);

        if (!$help) {
            return response()->json(['message' => 'Help request not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'number' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'file' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
            'info' => 'sometimes|required|string',
        ]);

        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $imagePath = $request->file('file')->storeAs('GetHelp', $fileName, 'public');
            $validated['file'] = 'storage/' . $imagePath;
        }

        $help->update($validated);

        return response()->json($help);
    }


    public function approveHelp($id)
    {
        $help = GetHelp::find($id);

        if (!$help) {
            return response()->json(['message' => 'Help request not found'], 404);
        }

        $help->update(['is_approved' => true]);

        return response()->json(['message' => 'Help approved', 'data' => $help]);
    }

    public function rejectHelp($id)
    {
        $help = GetHelp::find($id);

        if (!$help) {
            return response()->json(['message' => 'Help request not found'], 404);
        }

        try {
            $help->update(['is_approved' => false]);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Help request '.$e], 404);
        }


        return response()->json(['message' => 'Help rejected', 'data' => $help]);
    }

    public function getOneHelp(){

        $helps= GetHelp::where('is_approved',1)->get();

        return response()->json($helps);
    }

    public function allHelp(){

        $helps= GetHelp::all();

        return response()->json($helps);
    }

}
