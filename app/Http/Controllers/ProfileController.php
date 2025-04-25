<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Show the authenticated user's profile
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Update the authenticated user's profile
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }

    // Delete the authenticated user's profile
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Optionally, revoke tokens if needed
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        $user->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
