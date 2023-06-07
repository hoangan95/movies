<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
     /**
     * show table list database
     */
    public function index(){
        $data['users'] = DB::table('users')
        ->get();
        
        return view('admin.users.index',$data);
    }

    /*
    * Show view create
    */
    public function create(){
      
        return view('admin.users.create');
    }

    /**
     * Create data
     * StoreRequest $request
     */
    public function store(StoreRequest $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $data['password'] = bcrypt($request->password);
        $fileName = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $fileName);
        $data['image'] = $fileName;
        $data['slug'] = Str::slug($request->fullname);
        DB::table('users')->insert($data);
        
        return redirect()->route('admin.users.index')->with('sucsess', 'Create Users sucsess');
    }
    
    /**
     * show view edit
     * int $id
     */
    public function edit($id){
        $data['users'] = DB::table('users')
        ->where('id',$id)
        ->first();

        return view('admin.users.edit',$data);
    }

    /**
     * Update database
     * UpdateRequest $request 
     * int $id
     */
    public function update(UpdateRequest $request, $id){
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->fullname);
        if (!empty($request->image)) {
            $fileName = time().'.'.$request->image->getClientOriginalName();  
            $request->image->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
            
        }
        $data['password'] = bcrypt($request->password);
        DB::table('users')->where('id',$id)->update($data);
        
        return redirect()->route('admin.users.index')->with('sucsess', 'Edit Users sucsess');
    }

    /**
     * Delete 
     * int $id
     */
    public function delete($id){
        try {
            $users =  DB::table('users')->where('id',$id)->first();
            $count_users = DB::table('users')->where('level',1)->count();
             if ($users->level == 1 && $count_users == 1){

            return redirect()->route('admin.users.index')->with('erors', 'Không được xóa admin cuối cùng');
        } 
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('sucsess', 'Delete Users sucsess');
        } catch (\Throwable $th) {
            return redirect()->route('admin.users.index')->with('erors', 'Không thể xóa users superAdmin');
        }
    }

    public function changeStatusUser($id) {
        // lấy dữ liệu của thằng user đó ra.
        $users = DB::table('users')->where('id',$id)->first();
        // kiểm tra
        // nếu user là supper admin thì return response()->json với status bằng fail
        if($users->id != 1) {
            // nếu user đó có status == 1 thì update nó thành 2
            if($users->status == 1){
                DB::table('users')->where('id',$id)->update(['status'=>'2']);
            }
            // nếu user đó có status == 2 thì update nó thành 1
            if($users->status == 2){
                DB::table('users')->where('id',$id)->update(['status'=>'1']);
            }
            return response()->json([
                "status" => "success",
                "msg" => "Cập nhập status thành công"
            ]);
        }
        return response()->json([
            "status" => "fail",
            "msg" => "Cập nhập status không thành công"
        ]);
    }
}