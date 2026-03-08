<?php

use App\Http\Controllers\DiscussionQuestionController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonPlanController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PodcastLessonController;
use App\Http\Controllers\RadioProgramController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
 

Auth::routes();

Route::get('/', [FrontController::class, 'welcome']);
Route::get('radioprograms/{id}', [RadioProgramController::class,'show']);
Route::get('listen/podcasts', [PodcastController::class,'frontend'])
    ->name('podcasts.frontend');
Route::get('podcasts/{id}', [PodcastController::class,'show']);

Route::group(['middleware' => 'auth',], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('radio-programs', RadioProgramController::class);
    Route::resource('lesson-plans', LessonPlanController::class);
    Route::resource('podcasts', PodcastController::class);

    Route::resource('podcast_lessons', PodcastLessonController::class);

    Route::prefix('lessons/{lesson_id}')->group(function () {
        Route::resource('discussion_questions', DiscussionQuestionController::class);
    });

    Route::resource('user_progress', UserProgressController::class)->only(['index']);
    Route::post('user_progress/{id}/complete', [UserProgressController::class,'markComplete'])->name('user_progress.complete');

});
