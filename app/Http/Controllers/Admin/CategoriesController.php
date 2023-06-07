<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
     /**
     * show table list database
     */
    public function index(){
        $data['categories'] = DB::table('categories')->get();

        return view('admin.categories.index',$data);
    }

    /*
    * Show view create
    */
    public function create(){
        $data['categories'] = DB::table('categories')->get();

        return view('admin.categories.create',$data);
    }

    /**
     * Create data
     * StoreRequest $request
     */
    public function store(StoreRequest $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth::user()->id; 
        
           
        DB::table('categories')->insert($data);
        
        return redirect()->route('admin.categories.index')->with('sucsess' , 'Create Categories sucsess');
    }
    
    /**
     * Show view edit
     * int $id
     */
    public function edit($id){
        $data['categories'] = DB::table('categories')->where('id', $id)->first();
        $data['all'] = DB::table('categories')->get();

        return view('admin.categories.edit', $data);
    }

    /**
     * Update database
     * UpdateRequest $request
     * int $id
     */
    public function update(UpdateRequest $request, $id) {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);
        DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('admin.categories.index')->with('sucsess', 'Edit Categories sucsess');
    }

    /**
     * delete to database
     * int $id
     */
    public function delete($id){
        try {
            // Thực hiện xóa một hàng từ bảng cha
            // $category = DB::table('categories')->where('id', $id)->pluck('id')->toArray();
            $category_child = DB::table("categories")->where("parent_id", $id)->pluck('id')->toArray();
            $category_child[] = (int)$id;

            $movies = DB::table("categories_movies")->whereIn("categories_id", $category_child)->pluck('movie_id')->toArray();
            
            foreach(array_unique($movies) as $movie_id) {
                DB::table('lesson')->where('movie_id', "=", $movie_id)->delete();
                DB::table('chapter')->where('movie_id', "=", $movie_id)->delete();
                DB::table("cast_movies")->where("movie_id", $movie_id)->delete();
                DB::table('categories_movies')->where('movie_id', $movie_id)->delete();
                DB::table('movies')->where('id', $movie_id)->delete();
            }
            DB::table('categories')->whereIn('id', $category_child)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            // Xử lý lỗi khóa ngoại
            if ($ex->errorInfo[1] == 1451) {
                return redirect()->route('admin.categories.index')->with('erors', 'Không thể xóa thể loại do có phim liên quan');
            }
            // Xử lý các lỗi khác
            return redirect()->route('admin.categories.index')->with('erors', 'Đã xảy ra lỗi khi xóa thể loại');
        }
        
        return redirect()->route('admin.categories.index')->with('sucsess', 'Delete Categories sucsess');
    }
}
