<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::prefix('/v1')->middleware(['cors', 'json'])->group(
    function () {
        Route::prefix('/auth')->namespace('\App\Http\Controllers\Api')->group(
            function () {
                Route::post('/getCode', 'AuthController@getCode')->name('get-code');
                Route::post('/getToken', 'AuthController@getToken')->name('get-token');
                Route::post('/refreshToken', 'AuthController@refreshToken')->name('refresh-token');
            }
        );
    }
);

Route::prefix('/v1')->middleware(['cors', 'auth:api', 'json'])->group(function () {
    Route::namespace('\App\Http\Controllers\Api')->group(function () {
        Route::patch('/user/updateRequest', 'AuthController@updateRequest')->name('user-update-request');
        Route::patch('/user/updateAccept', 'AuthController@updateAccept')->name('user-update-accept');

        Route::get('/setting', 'SettingController@getSetting')->name('get-setting');
        Route::patch('/setting', 'SettingController@updateSetting')->name('update-setting');

        Route::get('/enums', 'ProfileController@getEnums')->name('get-enums');
        Route::get('/profile', 'ProfileController@getProfile')->name('get-profile');
        Route::patch('/profile', 'ProfileController@updateProfile')->name('update-profile');

        Route::patch('/profile/image', 'ProfileController@attachProfileImage')->name('attach-profile');
        Route::delete('/profile/image', 'ProfileController@detachProfileImage')->name('detach_profile');

        Route::post('/experience', 'ExperienceController@create')->name('create-experience');
        Route::patch('/experience/{experienceId}', 'ExperienceController@update')->name('update-experience');
        Route::delete('/experience/{experienceId}', 'ExperienceController@delete')->name('delete-experience');

        Route::post('/licence', 'LicenceController@create')->name('create-licence');
        Route::patch('/licence/{experienceId}', 'LicenceController@update')->name('update-licence');
        Route::delete('/licence/{experienceId}', 'LicenceController@delete')->name('delete-licence');

        Route::get('/skill/search/{text}', 'SkillController@search')->name('search-skill');
        Route::get('/category/search/{text}', 'CategoryController@search')->name('search-category');
        Route::get('/company/search/{text}', 'CompanyController@search')->name('search-company');
        Route::get('/university/search/{text}', 'UniversityController@search')->name('search-university');

        Route::get('/wallet', 'WalletController@getStatistics')->name('get-wallet-statistics');
        Route::post('/transaction/cashIn', 'TransactionController@cashIn')->name('cash_in_transaction');
        Route::post('/transaction/cashOut', 'TransactionController@cashOut')->name('cash_in_transaction');
        Route::post('/transaction/cashOutApprove', 'TransactionController@cashOutApprove')->name('cash_in_transaction');

        Route::get('/quiz/{quizId}', 'QuizController@getQuiz')->name('get-quiz');
        Route::get('/quizzes', 'QuizController@getQuizzes')->name('get-quizzes');
        Route::post('/quiz', 'QuizController@createQuiz')->name('create-quiz');
        Route::get('/payQuiz/{quizId}', 'QuizController@payQuiz')->name('pay-quiz');

    });
});

Route::fallback('\App\Http\Controllers\Api\AuthController@apiNotFound');
Route::get('/test','\App\Http\Controllers\Api\TestController@test');
