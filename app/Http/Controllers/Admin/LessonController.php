<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\Lesson\StoreRequest;
use App\Http\Requests\Admin\Lesson\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LessonController extends Controller
{
    public function index(){
        $data['lesson'] = DB::table('lesson')
        ->get();

        return view('admin.lesson.index',$data);
    }

    public function create(){
        $data['chapter'] = DB::table('chapter')
        ->get();
        $movies  = DB::table('movies')
        ->get();
        foreach($movies as $item){
       
            if($item->type_id == 2){
               $data['movies'][] = DB::table('movies')->where('id',$item->id)->first();
             }
         }

        return view('admin.lesson.create',$data);
    }

    public function store(StoreRequest $request ){
        $data = $request->except('_token',);
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name_lesson);
        DB::table('lesson')->insert($data);

        return redirect()->route('admin.lesson.index')->with('sucsess','Create Lesson sucsess');
    
    }

    public function edit($id){
        $data['lesson'] = DB::table('lesson')
        ->where('id',$id)
        ->first();
        $data['movies'] = DB::table('movies')
        ->get();
        $data['chapter'] = DB::table('chapter')
        ->get();

        return view('admin.lesson.edit',$data);
    }

    public function update(UpdateRequest $request, $id){
        $data = $request->except('_token',);
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->name_lesson);
      
        DB::table('lesson')->where('id',$id)->update($data);

        return redirect()->route('admin.lesson.index')->with('sucsess','Edit Lesson sucsess');
    
    }

    public function delete($id){
        DB::table('lesson')->where('id',$id)->delete();

        return redirect()->route('admin.lesson.index')->with('sucsess','Delete Lesson sucsess');
    }

}
