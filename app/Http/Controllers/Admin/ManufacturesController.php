<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Manufactures\StoreRequest;
use App\Http\Requests\Admin\Manufactures\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ManufacturesController extends Controller
{
    public function index(){
       $data['manufactures'] = DB::table('manufactures')
       ->get();

        return view('admin.manufactures.index',$data);
    }

    public function create(){
        
        return view('admin.manufactures.create');
    }

    public function store(StoreRequest $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);

        DB::table('manufactures')->insert($data);

        return redirect()->route('admin.manufactures.index')->with('sucsess','Create Manufactures sucsess');
    }

    public function edit($id){
        $data['manufactures'] = DB::table('manufactures')
        ->where('id',$id)
        ->first();

        return view('admin.manufactures.edit',$data);
    }

    public function update(UpdateRequest $request ,$id){
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);

        DB::table('manufactures')->where('id',$id)->update($data);

        return redirect()->route('admin.manufactures.index')->with('sucsess','Update Manufactures sucsess');
    
    }

    public function delete($id){

        try {
            // Thực hiện xóa một hàng từ bảng cha
            DB::table('manufactures')->where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            // Xử lý lỗi khóa ngoại
            if ($ex->errorInfo[1] == 1451) {
                return redirect()->route('admin.manufactures.index')->with('erors', 'Không thể xóa hãng sản xuất do có phim liên quan');
            }
            // Xử lý các lỗi khác
            return redirect()->route('admin.manufactures.index')->with('erors', 'Đã xảy ra lỗi khi xóa hãng sản xuất');
        }
        DB::table('manufactures')->where('id',$id)->delete();

        return redirect()->route('admin.manufactures.index')->with('sucsess','Delete Manufactures sucsess');
    }
}
