<?php
namespace App\Validators;

use Illuminate\http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
Class LoginValidators implements ValidatorInterface{

    public static function validate(Request $request): Validator
    {
        return ValidatorFacade::make($request->getAll(),[],[],[]);
    }
}