<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class SubcategoryController extends Controller
{
    public function get(Request $request)
    {
        $categoryType = ucfirst($request->categoryType);
        $isClassExists = class_exists('App\Models\\' . $categoryType);
        $categoryModel = "App\Models\\" . $categoryType;

        $validationData = customValidate($request->all(), [
            'categoryType' => ['required', 'string', function ($attribute, $value, $fail) use ($isClassExists) {
                if (!$isClassExists) {
                    return $fail("$attribute is invalid");
                }
            }],
            'categoryId' => ['required', 'integer', function ($attribute, $value, $fail) use ($isClassExists, $categoryModel) {
                if ($isClassExists) {
                    $category = $categoryModel::find($value);
                    if (is_null($category)) {
                        return $fail("$attribute is invalid");
                    }
                }
            }]
        ]);

        $category = $categoryModel::find($validationData['categoryId']);
        $data = new stdClass();
        $data->subcategories = $category->subcategories;

        return $this->success($data, 'All subcategories have been fetched', 200);
    }
}
