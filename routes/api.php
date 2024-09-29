<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\{AllowanceController,
    BankAccountController,
    FollowerController,
    FollowerIdentityController,
    SalaryController,
    UserContractController,
    UserController,
    UserIdentityController,
    UserJobController,UserEmergencyController,UserDocumentController,UserFileController,UserNoteController};
use App\Http\Controllers\Shared\{CompanyController,
    BranchController,
    CountryController,
    CityController,
    CurrencyController};
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function () {

    // Route for registering a new admin
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

    // Route for logging in
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // Route for logging out
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:api');

});
   // Route users
    Route::group(['middleware' => 'auth:api'], function () {
        // user
        Route::apiResource('users', UserController::class);
        Route::get('users-level-one',[UserController::class,'levelOne']);
        Route::get('users-level-one-and-two',[UserController::class,'levelOneAndTwo']);
        Route::get('users/{user_id}/subordinates',[UserController::class,'subordinates']);
        Route::post('users/{user_id}/subordinates',[UserController::class,'addSubordinate']);
        Route::put('users/{user_id}/contacts',[UserController::class,'contacts']);
        Route::put('users/{user_id}/image',[UserController::class,'updateUserImage']);
        Route::apiResource('user-identities', UserIdentityController::class);
        Route::apiResource('user-jobs', UserJobController::class);
        Route::apiResource('user-contracts', UserContractController::class);
        Route::apiResource('user-emergencies', UserEmergencyController::class);
        Route::apiResource('user-documents', UserDocumentController::class);
        Route::apiResource('user-files', UserFileController::class);
        Route::apiResource('user-notes', UserNoteController::class);

        // company
        Route::apiResource('companies', CompanyController::class);
        // branch
        Route::apiResource('branches', BranchController::class);
        // country
        Route::apiResource('countries', CountryController::class);
        // city
        Route::apiResource('cities', CityController::class);
        // followers
        Route::apiResource('followers', FollowerController::class);
        // follower-identities
        Route::apiResource('follower-identities', FollowerIdentityController::class);
        // Currency
        Route::apiResource('currencies', CurrencyController::class);
        // Allowances
        Route::apiResource('allowances', AllowanceController::class);
        // salaries
        Route::apiResource('salaries', SalaryController::class);
        // bank-accounts
        Route::apiResource('bank-accounts', BankAccountController::class);

    });
