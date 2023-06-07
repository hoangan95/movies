<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Type\UpdateRequest;
use App\Http\Requests\Admin\Type\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
    * show table list database
    */
   public function index(){
    $data['type'] = DB::table('type')
    ->get(); 

    return view('admin.type.index',$data);
   }

   /*
   * Show view create
   */
   public function create(){
      
    return view('admin.type.create');
   }

   /**
    * Create data
    * StoreRequest $request
    */
   public function store(StoreRequest $request){
    $data = $request->except('_token');
    $data['created_at'] = new \DateTime();
    $data['slug'] = Str::slug($request->name_type);

    DB::table('type')->insert($data);
    
    return redirect()->route('admin.type.index')->with('sucsess', 'Create Type sucsess');
   }
   
   /**
    * show view edit
    * int $id
    */
   public function edit($id){
    $data['type'] = DB::table('type')
    ->where('id',$id)
    ->first(); 

    return view('admin.type.edit',$data);
   }

   /**
    * Update database
    * UpdateRequest $request 
    * int $id
    */
   public function update(UpdateRequest $request, $id){
    $data = $request->except('_token');
    $data['updated_at'] = new \DateTime();
    $data['slug'] = Str::slug($request->name_type);

    DB::table('type')->where('id',$id)->update($data);
    
    return redirect()->route('admin.type.index')->with('sucsess', 'Edit Type sucsess');
   }

   /**
    * Delete 
    * int $id
    */
   public function delete($id){
    try {
        // Thực hiện xóa một hàng từ bảng cha
        DB::table('type')->where('id', $id)->delete();
    } catch (\Illuminate\Database\QueryException $ex) {
        // Xử lý lỗi khóa ngoại
        if ($ex->errorInfo[1] == 1451) {
            return redirect()->route('admin.type.index')->with('erors', 'Không thể xóa kiểu phim do có phim liên quan');
        }
        // Xử lý các lỗi khác
        return redirect()->route('admin.type.index')->with('erors', 'Đã xảy ra lỗi khi xóa kiểu phim');
    }
    DB::table('type')->where('id',$id)->delete();
    
    return redirect()->route('admin.type.index')->with('sucsess', 'Delete Type sucsess');
   }
}
