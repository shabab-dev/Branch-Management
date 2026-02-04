<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'
        );

        return redirect('/admin/logout/page')->with($notification);
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminLogoutPage(){
        return view('admin.admin_logout');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('photo')){
            $file = $request-> file('photo');
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
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        //Match the old password
        if(!Hash::check($request->old_password,auth::user()->password)){
            return back()->with('error',"Old Password doesn't Match");
        }
        //Update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password) 
        ]);
        
        return back()->with('status','Password Changed Successfully');
    }

    //All Manager method
    public function AllManager(){
        $alladminuser = User::where('role','branch-manager')->latest()->get();
        return view('manager.all_manager',compact('alladminuser'));
    }

    //AddManager method
    public function AddManager(){
        return view('manager.add_manager');
    }

    //StoreManager method
    public function StoreManager(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'branch-manager';
        $user->status = 'inactive';
        $user->save();

        $notification = array(
            'message' => 'New Branch Manager Created Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('all.manager')->with($notification);
    }

    //EditManager method
    public function EditManager($id){
        $managerData = User::findOrFail($id);
        return view('manager.edit_manager',compact('managerData'));  
    }

    //update method
    public function UpdateManager(Request $request){
        $manager_id = $request->id;

        $user = User::findOrFail($manager_id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; 
        $user->role = 'branch-manager';
        $user->status = 'inactive';
        $user->save();

         $notification = array(
            'message' => 'Manager Info Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.manager')->with($notification);
    }
    //delete method
    public function DeleteManager($id){
        User::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Manager Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }


    public function InactiveManager($id){

        User::findOrFail($id)->update(['status' => 'inactive']);

        $notification = array(
            'message' => 'Manager Id Inactive',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    } 

     public function ActiveAManager($id){

        User::findOrFail($id)->update(['status' => 'active']);

        $notification = array(
            'message' => 'Manager Id Active',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }
}
