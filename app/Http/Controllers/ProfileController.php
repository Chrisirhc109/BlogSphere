<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate the uploaded file
        ]);
        
        $user = Auth::user();

        // Check if a new profile photo has been uploaded
        if ($request->hasFile('profile_photo')) {
            // Get the uploaded file
            $profilePhoto = $request->file('profile_photo');
            
            // Generate a unique filename
            $filename = time() . '.' . $profilePhoto->getClientOriginalExtension();
            
            // Define the directory where the file will be stored
            $directory = 'profilePic/';
            
            // Move the uploaded file to the directory
            $profilePhoto->move(public_path($directory), $filename);
            
            // Delete the previous profile photo if it exists
            if ($user->profile_photo_path) {
                File::delete(public_path($user->profile_photo_path));
            }
            
            // Update the profile photo path in the user model
            $user->profile_photo_path = $directory . $filename;
        }

        // Update other user details
        $user->name = $request->name;
        // Add other fields if needed
        
        if ($user instanceof User) {
            // $user is an instance of User model
            $user->save();
        } else {
            // Handle error or log message
        }
        

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'The current password is incorrect.']);
        }
    
        try {
            $user->updatePassword($request->new_password);
            return response()->json(['success' => true, 'message' => 'Password changed successfully.']);
        } catch (\Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while changing the password. Please try again.']);
        }
    }
    
}
