<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CastController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\MoviesController;
use App\Http\Controllers\admin\RaitingController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\auth\LoginController;
use  App\Http\Controllers\admin\ChapterController;
use  App\Http\Controllers\admin\SeriesController;
use  App\Http\Controllers\admin\TypeController;
use  App\Http\Controllers\admin\ManufacturesController;
use App\Http\Controllers\admin\LessonController;
use App\Http\Controllers\client\FilmsController;
use App\Http\Controllers\client\loginController as ClientLoginController;
use App\Http\Controllers\client\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('master');
});


Route::controller(FilmsController::class)->name('client.')->group(function(){
    Route::get('category/{slug}.html','category')->name('category');
    Route::get('movieslesson/{slug}.html','movieslesson')->name('movieslesson');
    Route::get('/','home')->name('home');
    Route::get('singlemovies/{slug}.html','singlemovies')->name('singlemovies');
    Route::get('watch','watch')->name('watch');
    Route::get('master','master')->name('master');
    Route::get('moviestheaters', 'movietheaters')->name('movie.theaters');
    Route::get('phim-bo', 'seriesMoves')->name("series.movie");
    Route::get('tvshow', 'tvshow')->name("movie.tvshow");
    Route::get('download-video/{link}/{name}', 'downloadVideo')->name("movie.download.video");
    Route::get('registration','registration')->name('registration');
    Route::post('store','store')->name('store');


});

Route::prefix('client')->name('client.')->group(function(){
    Route::post('login',[ClientLoginController::class ,'login'])->name('login');
    Route::get('logout',[ClientLoginController::class ,'logout'])->name('logout');
});


Route::prefix("ajax")->name("ajax.")->group(function() {
    Route::post("/filter-movies-home-page", [FilmsController::class, "renderMovieFiltering"])->name("filter.home");
});
 
Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('login',[LoginController::class ,'showlogin'])->name('showlogin');
    Route::post('login',[LoginController::class ,'login'])->name('login');
    Route::get('logout',[LoginController::class ,'logout'])->name('logout');
});
Route::prefix('admin')->middleware('check-login-admin')->name('admin.')->group(function(){

    Route::prefix('categories')->controller(CategoriesController::class)->name('categories.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


    Route::prefix('type')->controller(TypeController::class)->name('type.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });

    Route::prefix('lesson')->controller(LessonController::class)->name('lesson.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });
    

    Route::prefix('series')->controller(SeriesController::class)->name('series.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


    Route::prefix('chapter')->controller(ChapterController::class)->name('chapter.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


    Route::prefix('blog')->controller(BlogController::class)->name('blog.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


    Route::prefix('users')->controller(UsersController::class)->name('users.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
        Route::get("/change/status/{id}", "changeStatusUser")->name("status.change");
    });

    Route::prefix('movies')->controller(MoviesController::class)->name('movies.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


    Route::prefix('cast')->controller(CastController::class)->name('cast.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });

    Route::prefix('manufactures')->controller(ManufacturesController::class)->name('manufactures.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });

    Route::prefix('comment')->controller(CommentController::class)->name('comment.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });

    Route::prefix('raiting')->controller(RaitingController::class)->name('raiting.')->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','delete')->name('delete');
    });


});