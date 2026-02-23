<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function doupdate(Request $request)
    {
        $new_name = $request->input("name");
        $new_email = $request->input("email");
        $new_password = bcrypt($request->input("password"));
        $new_phone = $request->input("phone");
        $new_location = $request->input("location");
        $new_role = $request->input("role");
        $userId = $request->input("update_id");
        $result = User::where("id", $userId)->update([
            "name" => $new_name,
            "email" => $new_email,
            "password" => $new_password,
            "phone" => $new_phone,
            "location" => $new_location,
            "role" => $new_role
        ]);

        if ($result) {
            return redirect()->route("user-profile")->with("success", "User updated successfully");
        } else {
            return redirect()->route("update-profile")->withErrors(["error" => "Failed to update user. Please try again."]);
        }
    }
    public function index()
    {
        $users = User::get();
        // pass the object directly
        return view("user-profile", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->token = bcrypt($request->email . $request->password);
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->role = $request->role;
        $user->save();
        return redirect()->route("home")->with("success", "User created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $userinfo = $request->input("update_id");
        $user = User::find($userinfo);
        return view('update-profile', compact('user')); // Changed from redirect
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, user $user)
    {
        $userId = $request->input('delete_id');
        User::destroy($userId);
        return redirect()->route("user-profile")->with("success", "User deleted successfully");
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password', 'name');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(["error" => "User not found. Please check your email and try again."], 404);
        }
        if (!password_verify($credentials['password'], $user->password)) {
            return response()->json(["error" => "Invalid password. Please try again."], 404);
        }
        if (!password_verify($credentials['email'] . $credentials['password'], $user->token)) {
            return response()->json(["error" => "Invalid token. Please try again."], 404);
        }
        Auth::login($user);
        return response()->json(["message" => "Logged in successfully"], 200);
        
    }
}
