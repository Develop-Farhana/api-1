<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());

            // Send email notification
            Mail::to($user->email)->send(new UserNotification($user));

            return response()->json($user, 201);
        } catch (\Exception $e) {
            Log::error('Error creating user or sending email: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        try {
            $path = $request->file('file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $header = array_shift($data);

            foreach ($data as $row) {
                $user = array_combine($header, $row);

                // Create or update user based on email uniqueness
                $existingUser = User::where('email', $user['email'])->first();
                if ($existingUser) {
                    $existingUser->update($user);
                } else {
                    $newUser = User::create($user);
                    Mail::to($newUser->email)->send(new UserNotification($newUser));
                }
            }

            return response()->json(['message' => 'Users uploaded successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error uploading users: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while uploading users.'], 500);
        }
    }
}
