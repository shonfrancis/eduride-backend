<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\EducationLevel;
use App\Models\Location;
use App\Models\Subject;

class TaxonomyController extends Controller
{
    public function categories()
    {
        return response()->json(Category::where('is_active', true)->orderBy('sort_order')->get());
    }

    public function subjects()
    {
        return response()->json(Subject::where('is_active', true)->orderBy('sort_order')->get());
    }

    public function educationLevels()
    {
        return response()->json(EducationLevel::where('is_active', true)->orderBy('sort_order')->get());
    }

    public function locations()
    {
        return response()->json(Location::where('is_active', true)->get());
    }
}
