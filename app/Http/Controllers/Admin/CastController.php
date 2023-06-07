<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cast\StoreRequest;
use App\Http\Requests\Admin\Cast\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CastController extends Controller
{
     /**
     * show table list database
     */
    public function index(){
        $data['cast'] = DB::table('cast')
        ->get();

        return view('admin.cast.index',$data);
    }

    /*
    * Show view create
    */
    public function create(){
       $data['movies'] = DB::table('movies')
       ->get();

        return view('admin.cast.create',$data);
    }

    /**
     * Create data
     * StoreRequest $request
     */
    public function store(StoreRequest $request){
        $data = $request->except('_token','movie_id');
        $data['created_at'] = new \DateTime();
        $fileName = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $fileName);
        $data['image'] = $fileName;
        $data['slug'] = Str::slug($request->name);
        $cast = DB::table('cast')->insertGetId($data);
        $cast_movies = [];
        if (is_array($request->movie_id)) {
            foreach ($request->movie_id as $item) {
                if($item) {
                    $cast_movies[] = [
                        'movie_id' => $item,
                        'cast_id' => $cast,
                    ];
                }
            }
        }
        

        DB::table('cast_movies')->insert($cast_movies);

        return redirect()->route('admin.cast.index')->with('sucsess', 'Create Cast sucsess');
    }
    
    /**
     * show view edit
     * int $id
     */
    public function edit($id){
        $data['cast'] = DB::table('cast')
        ->where('id',$id)
        ->first();
        $data['movies'] = DB::table('movies')
        ->get();
        $data['movie_id'] = DB::table("cast_movies")->where("cast_id", $id)->pluck("movie_id")->toArray();
        return view('admin.cast.edit',$data);

    }

    /**
     * Update database
     * UpdateRequest $request 
     * int $id
     */
    public function update(UpdateRequest $request, $id){
        $data = $request->except('_token','movie_id');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name);
        if (!empty($request->image)) { 
            $fileName = time().'.'.$request->image->getClientOriginalName(); 
            $request->image->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }
         DB::table('cast')->where('id',$id)->update($data);

        DB::table('cast_movies')->where('cast_id',$id)->delete();
        DB::table('cast_movies')->where('movie_id',$id)->delete();
        $cast_movies = [];
        if (is_array($request->movie_id)) {
            foreach ($request->movie_id as $item) {
                if($item) {
                    $cast_movies[] = [
                        'movie_id' => $item,
                        'cast_id' => $id,
                    ];
                }
            }
        }

        DB::table('cast_movies')->insert($cast_movies);

        return redirect()->route('admin.cast.index')->with('sucsess', 'Edit Cast sucsess');
    }

    /**
     * Delete 
     * int $id
     */
    public function delete($id){
        $cast = DB::table('cast')->where('id', $id)->first();
        DB::table('cast_movies')->where('cast_id',$id)->delete();
        if (file_exists(public_path('uploads/'.$cast->image))) { 
            unlink(public_path('uploads/'. $cast->image));
        }
        DB::table('cast')->where('id',$id)->delete();
        
        return redirect()->route('admin.cast.index')->with('sucsess', 'Delete Cast sucsess');
    }
}
