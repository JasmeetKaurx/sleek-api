<?php

namespace App\Http\Controllers;

use App\Models\WomenCategory;
use stdClass;

class WomenCategoryController extends Controller
{
    public function get()
    {
        $data = new stdClass();
        $data->womenCategories = WomenCategory::all();

        return $this->success($data, 'All women categories have been fetched', 200);
    }
}
