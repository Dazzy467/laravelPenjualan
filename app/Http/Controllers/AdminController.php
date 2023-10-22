<?php

namespace App\Http\Controllers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Logic for the admin dashboard
        $user = User::all();
        
        return view('admin/dashboard',['user' => $user]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required','integer','in:0,1']
        ]);
    }

    public function adduser_form()
    {
        return view('admin/adduser');
    }

    public function edituser_form($userID)
    {
        $user = User::findOrFail($userID);

        if ($user->id == 1)
        {
            return redirect()->route('admin.show')->with('error', 'Default Admin cannot be edited');

        }
        return view('admin/edituser',['user' => $user]);
    }

    public function adduser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required','integer','in:0,1']
        ]);
        

        // Create a new user
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.show')->with('success', 'User added successfully');
    }

    public function edituser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required','integer','in:0,1']
        ]);
        

        // Create a new user
        $user = User::find($request->input('id'));
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.show')->with('success', 'User successfully edited');
    }


    public function deleteUser($userID)
    {
        try{
            $user = User::findOrFail($userID);

            if ($user->id == 1)
            {
                return redirect()->route('admin.show')->with('error', 'Default Admin cannot be deleted');
            }

            $user->delete();
            return redirect()->route('admin.show')->with('success', 'User deleted successfully');
        }
        catch(Exception $e)
        {
            return redirect()->route('admin.show')->with('error', 'User record not found');
        }
    }
}
