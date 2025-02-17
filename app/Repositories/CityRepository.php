<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;

class cityRepository implements CityRepositoryInterface
{
    public function getAllCities() 
    {
        return City::all();
    }

    public function getCityBySlug($slug)
    {
        return City::where('slug', $slug)->first();
    }
}