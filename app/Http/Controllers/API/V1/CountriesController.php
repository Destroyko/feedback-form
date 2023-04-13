<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Countries;

class CountriesController extends Controller
{
    private Countries $countriesModel;

    public function __construct()
    {
        $this->countriesModel = new Countries();
    }

    public function show()
    {
       return $this->countriesModel::all()->pluck('name', 'id');
    }
}
