<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

    } // End Method

public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }// End Method


    public function AdminLogin(){

        return view('admin.admin_login');

    }// End Method


    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));

     }// End Method


     public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }// End Method



     public function AdminChangePassword(){

         $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

     }// End Method


     public function AdminUpdatePassword(Request $request){

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


     /* Agent ALL Show By admin */

     public function AllAgent()
     {
        $allagent  = User::where('role','agent')->latest()->get();

        return view('admin.agentuser.all_agents',compact('allagent'));
     }

     public function AddAgent()
     {
        return view('admin.agentuser.add_agents');

     }

     public function EditAgent($id)
     {
        $editAgent = User::where('id', $id)->first();
        return view('admin.agentuser.edit_agents', compact('editAgent'));

     }


  public function StoreAgent(Request $request){

    User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'password' => Hash::make($request->password),
        'role' => 'agent',
        'status' => 'active',
    ]);


       $notification = array(
            'message' => 'Agent Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.agent')->with($notification);

  }// End Method

  public function UpdateAgent(Request $request){

    $user_id = $request->id;

    User::findOrFail($user_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);


       $notification = array(
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.agent')->with($notification);

  }// End Method


  public function DeleteAgent($id){

     $deleteAgent =   User::findOrFail($id)->delete();

     if ($deleteAgent) {
        return response()->json(["success"=> "Agent Deleted Successfully"],200);
     }else {
        return response()->json(["error"=> "Something went wrong.Agent delete in fail"],500);
     }

 /*     $notification = array(
            'message' => 'Agent Deleted Successfully',
            'alert-type' => 'success'
        ); */

        return redirect()->back()->with($notification);

  }// End Method


  public function ChangeStatus(Request $request){

    // dd($request->agent_id);
    $agent = User::where('id', $request->agent_id)->where('role','agent')->first();
    if ($agent->status == 'active') {
        User::find($request->agent_id)->update([
            'status'=>'inactive',
        ]);
        $status = 'inactive';
    }elseif($agent->status == 'inactive'){
        User::find($request->agent_id)->update([
            'status' => 'active',
        ]);
        $status = 'active';
    }
/*     $user = User::find($request->user_id);
    $user->status = $request->status;
    $user->save(); */

    return response()->json(['success'=>'Status Change Successfully','status'=> $status,'agent_id'=>$agent->id]);

  }// End Method

}
