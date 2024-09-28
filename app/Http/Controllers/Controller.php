<?php

namespace App\Http\Controllers;

use App\Helpers\UploadImage;
use App\Helpers\ApiResponseHelper;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests , ApiResponseHelper , UploadImage;


}
