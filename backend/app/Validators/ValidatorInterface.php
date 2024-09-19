<?php

namespace App\Validators;
use Illuminate\Validation\Validator;
use Illuminate\http\Request;
interface ValidatorInterface{

    public static function validate(Request $request):validator;
}