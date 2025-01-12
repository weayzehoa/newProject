<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponser;
use App\Traits\UniversalFunctionTrait;

class Controller extends BaseController
{
    use AuthorizesRequests,  DispatchesJobs, ValidatesRequests, ApiResponser, UniversalFunctionTrait;
}
