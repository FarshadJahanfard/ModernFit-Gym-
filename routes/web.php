<?php

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\WorkoutAssignmentController;
use App\Http\Controllers\WorkoutLogController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Middleware\CheckAssignmentAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Route to nutrition page
use App\Http\Controllers\NutritionController;

Route::get('/nutrition', [NutritionController::class, 'show']);

// Still trying to get food creation to work
use App\Http\Controllers\ExampleController;

Route::get('/example', [ExampleController::class, 'index']);

// Food Contoller
use App\Http\Controllers\FoodController;

Route::get('/food/form', [FoodController::class, 'showForm']);
Route::post('/food/process', [FoodController::class, 'processForm']);

// Food Creation Route
Route::get('/create-food', [FoodController::class, 'create']);

// Homepage Route
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {
    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);

    // Route for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);

    // Route for buying day passes.
    Route::get('/daypass', 'App\Http\Controllers\DayPassController@create')->name('daypass.create');
    Route::post('/daypass', 'App\Http\Controllers\DayPassController@store')->name('daypass.store');
    // Route to show day pass details.
    Route::get('/daypass/{passId}', 'App\Http\Controllers\DayPassController@show')->name('daypass.show');

    Route::get('/memberships', 'App\Http\Controllers\MembershipController@show')->name('memberships.info');

    // Route to classes
    Route::get('/classes', 'App\Http\Controllers\ClassesController@show')->name('classes');

    // Route to nutrition
    Route::get('/nutritional', 'App\Http\Controllers\NutritionalController@show')->name('nutritional');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {
    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', [
        'as'   => 'public.home',
        'uses' => 'App\Http\Controllers\UserController@index',
        'name' => 'home',
    ]);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])
        ->name('activation-required');

    Route::get('/workout_progress', [WorkoutLogController::class, 'index'])->name('workout_progress.index');
    Route::get('/workout_progress/create/{assignmentId}', [WorkoutLogController::class, 'create'])->name('workout_progress.create');
    Route::post('/workout_progress/store/{assignmentId}', [WorkoutLogController::class, 'store'])->name('workout_progress.store');
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity']], function () {
    // User Profile and Account Routes
    Route::resource(
        'profile',
        \App\Http\Controllers\ProfilesController::class,
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );

    // User memberships
    Route::get('profile/{username}/memberships', [
        'as'   => 'profile.memberships',
        'uses' => 'App\Http\Controllers\ProfilesController@memberships',
    ]);

    Route::put('profile/{username}/updateUserAccount', [
        'as'   => 'profile.updateUserAccount',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => 'profile.updateUserPassword',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => 'profile.deleteUserAccount',
        'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);

    // Route to buy memberships
    Route::post('/memberships/purchase/{membership}', [MembershipController::class, 'purchase'])->name('memberships.purchase');

    // Route to show user plans
    Route::get('/profile/{username}/assignments', [WorkoutAssignmentController::class, 'userAssignments'])->name('workout_assignments');

    Route::delete('/workout_logs/{id}', [WorkoutLogController::class, 'delete'])->name('workout_logs.destroy');
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin']], function () {
    Route::resource('/users/deleted', \App\Http\Controllers\SoftDeletesController::class, [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'App\Http\Controllers\UsersManagementController@search')->name('search-users');

    Route::resource('branches', \App\Http\Controllers\BranchController::class, [
        'names' => [
            'index' => 'branches',
            'edit' => 'branches.edit',
            'destroy' => 'branch.destroy',
        ],
    ]);
    Route::get('branches/{id}', 'BranchController@show')->name('branches.show');

    Route::resource('admin/memberships', \App\Http\Controllers\MembershipController::class, [
        'names' => [
            'index' => 'memberships',
            'edit' => 'memberships.edit',
            'destroy' => 'memberships.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
});

// Registered, activated, and is trainer routes.
Route::group(['middleware' => ['auth', 'activated', 'role:trainer']], function () {
    Route::get('/profile/{username}/plans', [WorkoutPlanController::class, 'index'])->name('workout_plans');

    Route::get('/workout_plans/create', [WorkoutPlanController::class, 'create'])->name('workout_plans.create');
    Route::post('/workout_plans/store', [WorkoutPlanController::class, 'store'])->name('workout_plans.store');
    Route::get('/workout_plans/{id}', [WorkoutPlanController::class, 'show'])->name('workout_plans.show');
    Route::get('/workout_plans/{id}/edit', [WorkoutPlanController::class, 'edit'])->name('workout_plans.edit');
    Route::put('/workout_plans/{id}', [WorkoutPlanController::class, 'update'])->name('workout_plans.update');
    Route::delete('/workout_plans/{id}', [WorkoutPlanController::class, 'delete'])->name('workout_plans.destroy');

    Route::get('/workout_assignments/create/{planId}', [WorkoutAssignmentController::class, 'create'])->name('workout_assignments.create');
    Route::post('/workout_assignments/store', [WorkoutAssignmentController::class, 'store'])->name('workout_assignments.store');
});

Route::group(['middleware' => ['auth', 'activated', 'assignmentAccess']], function () {
    Route::get('/progress/{assignmentId}', [WorkoutAssignmentController::class, 'progress'])->name('workout_assignments.progress');
    Route::post('/store-workout-log/{assignmentId}', [WorkoutLogController::class, 'store'])->name('workout_logs.store');
});

Route::redirect('/php', '/phpinfo', 301);
