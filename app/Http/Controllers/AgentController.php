<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AgentController extends Controller
{
    public function AgentDashboard(){

        return view('agent.agent_dashboard');

    } // End Method

    public function AgentLogin()
    {
        return view('agent.agent_login');
    }

    public function AgentRegister(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            
        ]);

        $data = new User();
        $data->username = $request->username;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = 'agent';
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'New Agent Successfully Registered',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function agentProfile()
    {
        $profileData = User::find(auth()->user()->id);
        return view('agent.agent_profile',compact('profileData'));
    }

    public function agentProfileStore()
    {
        $request = request();
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Agent Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }// End Method

     public function AgentChangePassword(){

        $id = Auth::user()->id;
       $profileData = User::find($id);
       return view('agent.agent_change_password',compact('profileData'));

    }// End Method


    public function AgentUpdatePassword(Request $request){

       // Validation
       $request->validate([
           'old_password' => 'required',
           'new_password' => 'required|confirmed'

       ]);

       /// Match The Old Password

       if (!Hash::check($request->old_password, auth::user()->password)) {

          $notification = array(
           'message' => 'Old Password Does not Match!',
           'alert-type' => 'error'
       );

       return back()->with($notification);
       }

       /// Update The New Password

       User::whereId(auth()->user()->id)->update([
           'password' => Hash::make($request->new_password)

       ]);

        $notification = array(
           'message' => 'Password Change Successfully',
           'alert-type' => 'success'
       );

       return back()->with($notification);

    }// End Method

    public function AgentLogout(Request $request)
    {
       Auth::guard('web')->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('agent/login');
    }
}
/*  */
