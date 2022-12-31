<?php
use Illuminate\Routing\Router;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//WONT SHOW IN LIST EVEN THOUGH ITS THERE^^


//$router->delete('/posts/{id}', function (Comment $comment) {
//    $comment = Comment::findOrFail($comment);
//    $comment->delete();

//    return redirect()->route('posts.show', ['id'=>$comment->post_id])->with('message', 'Comment was deleted.');
//})->name('comments.destroy');



Route::delete('/posts/{id}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')->middleware(['auth']);

Route::get('/timeline', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
    ->name('posts.edit')->middleware(['auth']);

Route::get('/posts/{id}/{id2}', [CommentController::class, 'edit'])
    ->name('comments.edit')->middleware(['auth']);

Route::delete('/posts/{id}/delete', [PostController::class, 'destroy'])
    ->name('posts.destroy')->middleware(['auth']);

Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create')->middleware(['auth']);

Route::put('/posts/{id}', [PostController::class, 'update'])
    ->name('posts.update')->middleware(['auth']);

Route::put('/posts/{id}', [CommentController::class, 'update'])
    ->name('comments.update')->middleware(['auth']);

Route::post('/timeline', [PostController::class, 'store'])
    ->name('posts.store')->middleware(['auth']);

Route::post('/posts/{id}', [CommentController::class, 'store'])
    ->name('comments.store')->middleware(['auth']);

Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('posts.show');






Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
