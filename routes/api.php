<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/vendor', [PageController::class, 'get_vendors']);
Route::get('/{link_alias}', [PageController::class, 'get_data_by_alias'])->where('link_alias', '.*');
