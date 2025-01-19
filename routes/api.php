<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthMiddleware::class])->controller(OrganizationController::class)->group(function () {
    Route::get('/organizations/building/{buildingId}', 'building');
    Route::get('/organizations/activity/{activityId}', 'activity');
    Route::get('/organizations/radius', 'radius');
    Route::get('/organizations/boundingBox', 'boundingBox');
    Route::get('/organizations/search', 'search');
    Route::get('/organizations/{organizationId}', 'show');
});