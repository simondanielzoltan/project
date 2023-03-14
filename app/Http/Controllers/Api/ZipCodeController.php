<?php

namespace App\Http\Controllers\Api;

use App\Models\ZipCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZipCodeResource;

class ZipCodeController extends Controller
{
    public function getByZipCode(string $zipCode) {
        $zipCode = ZipCode::where('zip_code', $zipCode)->firstOrFail();
        return new ZipCodeResource($zipCode);
    }
}
