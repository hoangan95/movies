<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
     /**
     * show table list database
     */
    public function index(){
        $data['blog'] = DB::table('blog')
        ->get();

        return view('admin.blog.index',$data);
    }

    /*
    * Show view create
    */
    public function create(){
        $data['categories'] = DB::table('categories')
       ->get();
       
        return view('admin.blog.create',$data);
    }

    /**
     * Create data
     * StoreRequest $request
     */
    public function store(StoreRequest $request){
        $data = $request->except('_token','category');
        $data['created_at'] = new \DateTime();
        $fileName = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $fileName);
        $data['image'] = $fileName;
       
        $blog = DB::table('blog')->insertGetId($data);

        $blog_categories = [];
       
        foreach ($request->category as $item) {
            $blog_categories[] = [
                'categories_id' => $item,
                'blog_id' => $blog,
            ];
            
        }       
        DB::table('blog_categories')->insert($blog_categories);

        return redirect()->route('admin.blog.index')->with('sucsess', 'Create Blog sucsess');
    }
    
    /**
     * show view edit
     * int $id
     */
    public function edit($id){
        $data['blog'] = DB::table('blog')
        ->where('id',$id)
        ->first();
        $data['categories'] = DB::table('categories')
        ->get();
        $blog_categories = DB::table('blog_categories')
        ->where('blog_id',$id)
        ->get();

        $data_blog_categories = []; 

        foreach ($blog_categories as $item) {
            $data_blog_categories[] = $item->categories_id;
        }

        $data['blog_categories'] = $data_blog_categories;
        
        return view('admin.blog.edit',$data);
    }

    /**
     * Update database
     * UpdateRequest $request 
     * int $id
     */
    public function update(UpdateRequest $request, $id){
        $data = $request->except('_token','category');
        DB::table('blog_categories')->where('blog_id', $id)->delete();
        DB::table('blog_categories')->where('categories_id', $id)->delete();
        $data['updated_at'] = new \DateTime();
        if (!empty($request->image)) { 
            $fileName = time().'.'.$request->image->getClientOriginalName(); 
            $request->image->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }
        DB::table('blog')->where('id',$id)->update($data);
        
        $blog_categories = [];
        foreach ($request->category as $item) {
            $blog_categories[] = [
                'categories_id' => $item,
                'blog_id' => $id,
            ];
        }
        DB::table('blog_categories')->insert($blog_categories);

        return redirect()->route('admin.blog.index')->with('sucsess', 'Edit Blog sucsess');
    }

    /**
     * Delete 
     * int $id
     */
    public function delete($id){
        $blog = DB::table('blog')->where('id', $id)->first();

        if (file_exists(public_path('uploads/'.$blog->image))) { 
            unlink(public_path('uploads/'. $blog->image));
        }
        if (file_exists(public_path('uploads/trailer/'. $blog->image))) { 
            unlink(public_path('uploads/trailer/'. $blog->image));
        }
        DB::table('blog_categories')->where('blog_id', $id)->delete();
        DB::table('blog_categories')->where('categories_id', $id)->delete();
        DB::table('blog')->where('id',$id)->delete();

        return redirect()->route('admin.blog.index')->with('sucsess', 'Delete Blog sucsess');
    }
}