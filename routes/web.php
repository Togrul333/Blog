<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Back\AuthController::class, 'login'])->name('login');
    Route::post('login', [\App\Http\Controllers\Back\AuthController::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', [\App\Http\Controllers\Back\DashboardController::class, 'index'])->name('dashboard');
    // makaleler статьи
    Route::get('articles/trashed',[\App\Http\Controllers\Back\ArticleController::class,'trashed'])->name('trashed.article');
    Route::get('articles/HardDelete/{id}',[\App\Http\Controllers\Back\ArticleController::class,'hardDelete'])->name('hard.delete.article');
    Route::get('recoverarticle/{id}',[\App\Http\Controllers\Back\ArticleController::class,'recover'])->name('recover.article');
    Route::resource('articles',\App\Http\Controllers\Back\ArticleController::class);

    // Kategoriler
    Route::get('categories',[\App\Http\Controllers\Back\CategoryController::class,'index'])->name('categories');
    Route::post('category/create',[\App\Http\Controllers\Back\CategoryController::class,'create'])->name('category.create');
    Route::get('category/getData',[\App\Http\Controllers\Back\CategoryController::class,'getData'])->name('category.getData');


    //Page's
    Route::get('/pages',[\App\Http\Controllers\Back\PageController::class,'index'])->name('page.index');
    Route::get('/pages/create',[\App\Http\Controllers\Back\PageController::class,'create'])->name('page.create');
    Route::post('/pages/create',[\App\Http\Controllers\Back\PageController::class,'post'])->name('page.create.post');
    Route::get('/pages/update/{id}',[\App\Http\Controllers\Back\PageController::class,'update'])->name('page.update');
    Route::post('/pages/update/{id}',[\App\Http\Controllers\Back\PageController::class,'updatePost'])->name('page.update.post');
    Route::get('/pages/delete/{id}',[\App\Http\Controllers\Back\PageController::class,'delete'])->name('page.delete');
    Route::get('/pages/siralama',[\App\Http\Controllers\Back\PageController::class,'orders'])->name('page.orders');



    Route::get('logout', [\App\Http\Controllers\Back\AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [\App\Http\Controllers\Front\HomepageController::class, 'index'])->name('homepage');
Route::get('/category/{category}', [\App\Http\Controllers\Front\HomepageController::class, 'category'])->name('category');
Route::get('/contact', [\App\Http\Controllers\Front\HomepageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\Front\HomepageController::class, 'contactpost'])->name('contact.post');
Route::get('/{category}/{slug}', [\App\Http\Controllers\Front\HomepageController::class, 'single'])->name('single');
Route::get('/{page}', [\App\Http\Controllers\Front\HomepageController::class, 'page'])->name('page');


