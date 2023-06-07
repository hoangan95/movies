<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Movies\StoreRequest;
use App\Http\Requests\Admin\Movies\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MoviesController extends Controller

{
     /**
     * show table list database
     */
    public function index(){
        $data['movies'] = DB::table('movies')
        ->get();

        return view('admin.movies.index',$data);
    }

    /*
    * Show view create
    */
    public function create(){
       $data['type'] = DB::table('type')
       ->get();
       $data['categories'] = DB::table('categories')
       ->get();
       $data['manufactures'] = DB::table('manufactures')
       ->get();

        return view('admin.movies.create',$data);
    }

    /**
     * Create data
     * StoreRequest $request
     */
    public function store(StoreRequest $request){
        $data = $request->except('_token','category');
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth::user()->id; 
        if (!empty($request->image)) {
            $fileName = time().'.'.$request->image->getClientOriginalName();  
            $request->image->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }

        if (!empty($request->trailer)) { 
            $fileNamevideo = time().'.'.$request->trailer->getClientOriginalName();  
            $request->trailer->move(public_path('uploads/trailer'), $fileNamevideo);
            $data['trailer'] = $fileNamevideo;
        }
        
        $movies = DB::table('movies')->insertGetId($data);

        $categories_movies = [];
        foreach ($request->category as $item) {
            $categories_movies[] = [
                'categories_id' =>$item,
                'movie_id' => $movies,
            ];
        }
        DB::table('categories_movies')->insert($categories_movies);

        return redirect()->route('admin.movies.index')->with('sucsess', 'Create Movies sucsess');
    }
    
    /**
     * show view edit
     * int $id
     */
    public function edit($id){
        $data['categories'] = DB::table('categories')
        ->get();
        $data['categories_movies'] = DB::table('categories_movies')
        ->where('movie_id',$id)
        ->pluck('categories_id')->toArray();

        $data['type'] = DB::table('type')
        ->get();
        $data['movies'] = DB::table('movies')
        ->where('id',$id)
        ->first();
        $data['manufactures'] = DB::table('manufactures')
        ->get();

        return view('admin.movies.edit',$data);
    }

    /**
     * Update database
     * UpdateRequest $request 
     * int $id
     */
    public function update(UpdateRequest $request, $id){
        $data = $request->except('_token','category');
        $data['slug'] = Str::slug($request->name);
        DB::table('categories_movies')->where('categories_id',$id)->delete();
        DB::table('categories_movies')->where('movie_id',$id)->delete();

        $data['updated_at'] = new \DateTime();
        $data['user_id'] = Auth::user()->id; 

        if (!empty($request->image)) { 
            $fileName = time().'.'.$request->image->getClientOriginalName(); 
            $request->image->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }
        if (!empty($request->trailer)) {
            $fileNamevideo = time().'.'.$request->trailer->getClientOriginalName();  
            $request->trailer->move(public_path('uploads/trailer'), $fileNamevideo);
            $data['trailer'] = $fileNamevideo;
        }
        DB::table('movies')->where('id',$id)->update($data);

        $categories_movies = [];
        foreach ($request->category as $item) {
            $categories_movies[] = [
                'categories_id' => $item,
                'movie_id' => $id,
            ];
        }
        DB::table('categories_movies')->insert($categories_movies);

        return redirect()->route('admin.movies.index')->with('sucsess', 'Edit Movies sucsess');
    }

    /**
     * Delete 
     * int $id
     */
    // public function delete($id){
    //     $movies = DB::table('movies')->where('id', $id)->first();
        
    //     try {
    //         DB::table('lesson')->where('movie_id', "=", $id)->delete();
    //         DB::table('chapter')->where('movie_id', "=", $id)->delete();
    //         DB::table("cast_movies")->where("movie_id", $id)->delete();
    //         DB::table('categories_movies')->where('movie_id', $id)->delete();
    //         DB::table('movies')->where('id', $id)->delete();
    //     } catch (\Illuminate\Database\QueryException $ex) {
    //         dd($ex->getMessage());
    //         // Xử lý lỗi khóa ngoại
    //         if ($ex->errorInfo[1] == 1451) {
    //             return redirect()->route('admin.movies.index')->with('erors', 'Không thể xóa phim do có các tập phim liên quan');
    //         }
    //         // Xử lý các lỗi khác
    //         return redirect()->route('admin.movies.index')->with('erors', 'Đã xảy ra lỗi khi xóa phim');    
    //     }

    
    //     return redirect()->route('admin.movies.index')->with('sucsess', 'Delete Movies sucsess');
    // }
    public function delete($id){
        $movies = DB::table('movies')->where('id', $id)->first();
        
        try {
            DB::table('lesson')->where('movie_id', "=", $id)->delete();
            DB::table('chapter')->where('movie_id', "=", $id)->delete();
            DB::table("cast_movies")->where("movie_id", $id)->delete();
            DB::table('categories_movies')->where('movie_id', $id)->delete();
            DB::table('movies')->where('id', $id)->update(['status' => 'Inactive']);
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
            // Xử lý các lỗi
            return redirect()->route('admin.movies.index')->with('errors', 'Đã xảy ra lỗi khi ẩn bộ phim');    
        }
    
        return redirect()->route('admin.movies.index')->with('success', 'Hide Movies success');
    }
    
}
