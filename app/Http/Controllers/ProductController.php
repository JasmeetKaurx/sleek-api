<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use stdClass;

class ProductController extends Controller
{
    public function getProductsBySubcategory(Request $request)
    {
        $validationData = customValidate($request->all(), [
            'subcategoryId' => 'required|integer|exists:subcategories,id'
        ]);

        $subcategory = Subcategory::find($validationData['subcategoryId']);

        $data = new stdClass();
        $data->products = $subcategory->products;

        return $this->success($data, 'All products of subcategory have been fetched', 200);
    }

    public function getProductsByCategory(Request $request)
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
        $categoryProducts = [];
        $subcategories = $category->subcategories;

        foreach ($subcategories as $subcategory) {
            $products = $subcategory->products;
            foreach ($products as $product) {
                array_push($categoryProducts, $product);
            }
        }

        $data->products = $categoryProducts;

        return $this->success($data, 'All products of category have been fetched', 200);
    }
}
