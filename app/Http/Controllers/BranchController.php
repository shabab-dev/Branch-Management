<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function AllBranch(){
        $branches = Branch::latest()->get();
        return view('branch.all_branch',compact('branches'));
    }

    public function AddBranch(){
        return view('branch.add_branch');
    }

    public function StoreBranch(Request $request){
        Branch::insert([
            'branch_name' => $request->branch_name,
            'branch_slug' => strtolower(str_replace(' ','-',$request->branch_name))
        ]);

        $notification = array(
            'message' => 'Branch Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.branch')->with($notification);
    }

    public function EditBranch($id){
        $branch = Branch::findOrFail($id);
        return view('branch.edit_branch',compact('branch'));  
    }

    public function UpdateBranch(Request $request){
        $branch_id = $request->id;
        var_dump($branch_id);
        die();
        Branch::findOrFail($branch_id)->update([
            'branch_name' => $request->branch_name,
            'branch_slug' => strtolower(str_replace(' ','-',$request->branch_name))
        ]);

        $notification = array(
            'message' => 'Branch Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.branch')->with($notification);
    }

    public function DeleteBranch($id){
        Branch::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Branch Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
