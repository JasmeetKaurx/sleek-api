<?php

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

if (!function_exists('customValidate')) {
    function customValidate($validationData, $rules)
    {
        $validator = Validator::make($validationData, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return $validator->validated();
    }
}
