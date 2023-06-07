<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Client\registrationRequest;

class FilmsController extends Controller
{
    public function home(){
        $data['movies'] = DB::table('movies')
        ->where('type_id', '=', 1)
        ->skip(0)->take(10)
        ->get();
        $data['moviesall'] = DB::table('movies')
        ->paginate(10);
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', 2)
        ->get();
        $data['type'] = DB::table('type')
        ->get();

        return view('client.pages.home',$data);
    }

    public function master(){
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        
      
        return view('client.master',$data);
    }
    public function category($slug){
        $movies = DB::table('movies')
        ->select('movies.*')
        ->join('categories_movies', 'movies.id', '=', 'categories_movies.movie_id')
        ->join('categories', 'categories.id', '=', 'categories_movies.categories_id')
        ->where('categories.slug', '=', $slug)
        ->paginate(10);
 
        $data['movies'] = $movies;
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        $data["breadcrumb"] = DB::table("categories")->where("slug", $slug)->value("name") ?? "";
      
        return view('client.pages.category',$data);
    }

    public function movieslesson($slug){

        $movies = DB::table('movies')->where('slug', $slug)->first();
        $session = request()->session ?? "";
        $lesson = request()->lesson ?? "";

        if ($session) {
            $data['chapter_select'] = DB::table('chapter')
                ->where("slug", "=", $session)
                ->first();
        }else{
            $data['chapter_select'] = DB::table('chapter')
                ->where('movie_id', $movies->id)
                ->orderBy("created_at", "ASC")
                ->first();
            $session = $data["chapter_select"]->slug;
        }
        
        if ($lesson) {
            $data["link"] = DB::table("lesson")->where("id", $lesson)->value("link") ?? "";
        } else {
            $data["link"] = DB::table("lesson")->where("chapter_id", $data["chapter_select"]->id)->value("link") ?? "";
        }
        $data['movies'] = DB::table('movies')
            ->where('slug', $slug)
            ->first();
    
        $data['chapter'] = DB::table('chapter')
            ->where('movie_id', $data['movies']->id)
            ->whereNotIn("slug", [$session])
            ->get();
        
        $data['lesson'] = DB::table('lesson')
            ->select("lesson.id", "lesson.name_lesson", "lesson.chapter_id")
            ->join('chapter', 'lesson.chapter_id', '=', 'chapter.id')
            ->join('movies', 'chapter.movie_id', '=', 'movies.id')
            ->where('movies.slug', $slug)
            ->where('chapter.slug', $session)
            ->get();

        $cast = DB::table('cast')
        ->join('cast_movies', 'cast.id', '=', 'cast_movies.cast_id')
        ->join('movies', 'cast_movies.movie_id', '=', 'movies.id')
        ->where('movies.slug', $slug)
        ->select('cast.*')
        ->get();
    
        $data['cast'] = $cast;
        $data['movies_like1'] = DB::table('movies')
        ->where('type_id', '=', '2')
        ->where('slug', '!=', $slug)
        ->skip(0)->take(10)
        ->get();
       $data['categories'] = DB::table('categories')
       ->where('parent_id', '=', '2')
       ->get();
     

        return view('client.pages.movieslesson',$data);
    }
    public function watch(){

        return view('client.pages.watch');
    }

    public function singlemovies($slug){
        $data['movies'] = DB::table('movies')
        ->where('slug','=',$slug)
        ->first();

        $cast = DB::table('cast')
        ->join('cast_movies', 'cast.id', '=', 'cast_movies.cast_id')
        ->join('movies', 'cast_movies.movie_id', '=', 'movies.id')
        ->where('movies.slug','=', $slug)
        ->select('cast.*')
        ->get();

        $data['cast'] = $cast;

        $data['movies_like'] = DB::table('movies')
        ->where('type_id', '=', '1')
        ->where('slug', '!=', $slug)
        ->skip(0)->take(10)
        ->get();
    

        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        
        $data['lesson'] = DB::table('lesson')
        ->where('movie_id', '=', $data['movies']->id)
        ->first();

        $data["link"] = $data['movies']->link;

      return view('client.pages.singlemovies',$data);
    }

    public function downloadVideo($link, $name)
    {
        $filePath = public_path('uploads/trailer/'.$link);
        $fileName = $name.'.mp4';
    
        $headers = [
            'Content-Type' => 'video/mp4',
        ];
    
        return response()->download($filePath, $fileName, $headers);
    }

    public function seriesMoves() {
        $data['movies'] = DB::table('movies')
        ->join('categories_movies', 'movies.id', '=', 'categories_movies.movie_id')
        ->where('categories_id',4)
        ->paginate(10);
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        $data["breadcrumb"] = DB::table("categories")->where("id", 4)->value("name") ?? "";

        return view('client.pages.category',$data);
    }

    public function movietheaters() {
        $data['movies'] = DB::table('movies')
        ->where('type_id',"=",1)
        ->paginate(10);
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        $data["breadcrumb"] = DB::table("categories")->where("id", 3)->value("name") ?? "";
        // $data['moviesall'] = DB::table('movies')
        // ->paginate(1);

        return view('client.pages.category',$data);
    }

    public function tvshow() {
        $data['movies'] = DB::table('movies')
        ->join('categories_movies', 'movies.id', '=', 'categories_movies.movie_id')
        ->where('categories_id',5)
        ->paginate(10);
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();
        $data["breadcrumb"] = DB::table("categories")->where("id", 5)->value("name") ?? "";
        
        return view('client.pages.category',$data);
    }

    public function renderMovieFiltering(Request $request) {
        $movies = DB::table('movies');
        $category = $request->category ?? "";
        $type = $request->type ?? "";
        $year = $request->year ?? "";
        $quality = $request->quality ?? "";
        if (is_array($category)) {
            $movies->join('categories_movies', 'movies.id', '=', 'categories_movies.movie_id')
            ->whereIn('categories_id',$category);
        }

        if (is_array($quality)) {
            $movies->whereIn('status',$quality);
        }

        if (is_array($type)) {
            $movies->whereIn('type_id',$type);
        }

        if (is_array($year)) {
            $movies->whereIn(DB::raw('YEAR(created_at)'), $year)            ;
        }
        $data['moviesallseach'] = $movies->paginate(10);
        $view = view("client.ajax.home-ajax", $data)->render();
        
        return $view;
    }

    //Đăng ký thành viên mới
    public function registration(){
        $data['categories'] = DB::table('categories')
        ->where('parent_id', '=', '2')
        ->get();

        return view('client.pages.registration',$data);
    }

    public function store(registrationRequest $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $data['password'] = bcrypt($request->password);
        $fileName = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $fileName);
        $data['image'] = $fileName;
        DB::table('users')->insert($data);
        
        return redirect()->route('client.home')->with('sucsess', 'Create Users sucsess');
    }
}
?>
