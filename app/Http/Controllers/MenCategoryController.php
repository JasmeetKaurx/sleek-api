<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use App\Models\MenCategory;

class MenCategoryController extends Controller
{
    public function get()
    {
        $data = new stdClass();
        $data->menCategories = MenCategory::all();

        return $this->success($data, 'All men categories have been fetched', 200);
    }
}
