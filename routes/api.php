<?php

use Illuminate\Support\Facades\Route;
use Its\NovaBlogifyTool\Bootstrap\Blogify;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/
Route::get('/check-installation', function () {
    return response()->json(['installation_status' => Blogify::isInstalled()], 200);
});

Route::delete('/reset-content', 'Its\NovaBlogifyTool\Http\Controllers\ResetController@execute');
