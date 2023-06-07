<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Chapter\StoreRequest;
use App\Http\Requests\Admin\Chapter\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    /**
    * show table list database
    */
   public function index(){
    $data['chapter'] = DB::table('chapter')
    ->get();

    return view('admin.chapter.index',$data);
   }

   /*
   * Show view create
   */
   public function create(){
      $data['movies'] = [];
      $movies = DB::table('movies')
      ->get();
   
      foreach($movies as $item){
       
         if($item->type_id == 2){
            $data['movies'][] = DB::table('movies')->where('id',$item->id)->first();
          }
      }

      return view('admin.chapter.create',$data);
   }

   /**
    * Create data
    * StoreRequest $request
    */
   public function store(StoreRequest $request){
        $data = $request->except('_token',);
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name_chapter);
        DB::table('chapter')->insert($data);

        return redirect()->route('admin.chapter.index')->with('sucsess','Create Chapter sucsess');
   }
   
   /**
    * show view edit
    * int $id
    */
   public function edit($id){
        $data['movies'] = DB::table('movies')
        ->get();
        $data['chapter'] = DB::table('chapter')
        ->where('id',$id)
        // ->where('movie_id',$id)
        ->first();

        $data['movies'] = [];
          $movies = DB::table('movies')
          ->get();
          foreach($movies as $item){
            if($item->type_id == 2){
                $data['movies'][] = DB::table('movies')->where('id',$item->id)->first();
            }
          }

       return view('admin.chapter.edit',$data);
   }

   /**
    * Update database
    * UpdateRequest $request 
    * int $id
    */
   public function update(UpdateRequest $request, $id){
    $data = $request->except('_token',);
    $data['updated_at'] = new \DateTime();
    $data['slug'] = Str::slug($request->name_chapter);

    DB::table('chapter')->where('id',$id)->update($data);

    return redirect()->route('admin.chapter.index')->with('sucsess','Edit Chapter sucsess');

   }

   /**
    * Delete 
    * int $id
    */
   public function delete($id){

    try {
      // Thực hiện xóa một hàng từ bảng cha
      DB::table('chapter')->where('id', $id)->delete();
  } catch (\Illuminate\Database\QueryException $ex) {
      // Xử lý lỗi khóa ngoại
      if ($ex->errorInfo[1] == 1451) {
          return redirect()->route('admin.chapter.index')->with('erors', 'Không thể xóa phần phim do có tập phim liên quan');
      }
      // Xử lý các lỗi khác
      return redirect()->route('admin.chapter.index')->with('erors', 'Đã xảy ra lỗi khi xóa phần phim');
  }
    DB::table('chapter')->where('id',$id)->delete();

    return redirect()->route('admin.chapter.index')->with('sucsess','Delete Chapter sucsess');
   }
}
