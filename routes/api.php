<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteFileUploadController;

Route::middleware(['api', 'throttle:api'])->group(function () {
    // This route now matches the URL in quotation.js and uses the correct controller
    Route::post('/submit-simplified-quote', [QuoteFileUploadController::class, 'store']);
});
