<?php

namespace App\Http\Controllers;

use App\Mail\RegisteredMail;
use App\Http\Requests\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function AdminDashboard(Request $request)
    {

        $user = User::selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();
    
        $data['months'] = $user->pluck('month');
        $data['counts'] = $user->pluck('count');

        return view('admin.index', $data);
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }

    public function admin_profile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.admin_profile', $data);
    }

    public function view($id)
    {
        $data['getRecord'] = User::findOrfail($id);
        return view('admin.users.view', $data);
    }

    public function admin_profile_update(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);

        // if(!empty($request->password)) {
        //     $user->password = Hash::make($request->password);
        // }

        if(!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $fileName = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload', $fileName);
            $user->photo = $fileName;
        }

        // $user->photo = trim($request->photo);
        $user->phone = trim($request->phone);
        $user->address = trim($request->address);
        $user->about = trim($request->about);
        $user->website = trim($request->website);
        $user->save();

        return redirect('admin/profile')->with('success', 'Profile Update Successfully');
    }

    public function admin_users_list(Request $request)
    {

        $search = $request->get('search'); // or just: request('search')
        $startDate = $request->get('start_date'); // or just: request('search')
        $endDate = $request->get('end_date'); // or just: request('search')
        $data['getRecord']      = User::getRecord($search, $startDate, $endDate);
        $data['totalAdmin']     = (int) User::countBy('role', 'admin');
        $data['totalAgent']     = (int) User::countBy('role', 'agent');
        $data['totalUser']      = (int) User::countBy('role', 'user');
        $data['totalActive']    = (int) User::countBy('status', 'active');
        $data['totalInactive']  = (int) User::countBy('status', 'inactive');
        $data['totalTotal']     = (int) User::count();
    
        return view('admin.users.list', $data);
    }

    public function checkemail(Request $request)
    {
        $email = $request->input('email');

        $isExists = User::where('email', '=', $email)->first();

        if($isExists) {
            return response()->json(array("exists" => true));
        }else {
            return response()->json(array("exists" => false));
        }
    }

    public function admin_add_users_store(Request $request)
    {
        // Let Laravel handle validation automatically

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'nullable|regex:/^\+?[0-9]+$/|max:20',
            'role'     => 'required|in:admin,user,agent',
            'status'   => 'required|in:active,inactive',
        ]); 
    
        try {
            DB::beginTransaction();
    
            $save = new User;
            $save->name     = trim($validated['name']);
            $save->username = trim($validated['username']);
            $save->email    = trim($validated['email']);
            $save->phone    = trim($validated['phone'] ?? '');
            $save->role     = trim($validated['role']);
            $save->status   = trim($validated['status']);
            $save->remember_token = Str::random(50);
            $save->save();

            Mail::to($save->email)->send(new RegisteredMail($save));
    
            DB::commit();
            return redirect('admin/users')->with('success', 'New User added Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    public function admin_add_users(Request $request)
    {
        return view('admin.users.add');
    }

    public function set_new_password($token)
    {
        $data['token'] = $token;
        return view('auth.reset_pass', $data);
    }

    public function set_new_password_post($token, ResetPassword $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('remember_token', '=', $token);
            if($user->count() == 0) 
            {
                abort(403);
            }
            $user = $user->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(50);
            $user->save();

            DB::commit();
            return redirect('admin/login')->with('success', 'New password has been set.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong in changing password. Please try again.');
        }
    }

    public function admin_add_users_edit($id)
    {
        $data['getRecord'] = User::findOrFail($id);
        return view('admin.users._edit', $data);
    }

    public function admin_add_users_edit_id_update($id, Request $request)
    {
        $save = User::findOrFail($id);
        $save->name     = trim($request['name']);
        $save->username = trim($request['username']);
        $save->email    = trim($request['email']);
        $save->phone    = trim($request['phone'] ?? '');
        $save->role     = trim($request['role']);
        $save->status   = trim($request['status']);
        $save->save();

        return redirect('admin/users')->with('success', 'User info updated Successfully');
    }

    public function admin_delete_soft($id)
    {
        try {
            DB::beginTransaction();

            $userId = User::findOrFail($id);
            $userId->delete();

            DB::commit();
            return redirect('admin/users')->with('success', 'User deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong, you cant delete the user, Please try again.');
        }
    }

    public function admin_profile_edit_pass()
    {
        $id = Auth::user()->id;
        $data['getRecord'] = User::findOrFail($id);
        return view('admin.admin_change_pass', $data);
    }

    public function admin_profile_edit_pass_id($id, Request $request)
    {
        $user = User::findOrFail($id);
    
        // Validate input
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|string|min:6|confirmed',
        ]);
    
        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }
    
        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->back()->with('success', 'Password updated successfully.');
    }
    
}