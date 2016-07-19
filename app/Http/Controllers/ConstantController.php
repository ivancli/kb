<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2016
 * Time: 5:29 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ConstantController extends Controller
{
    function __construct()
    {
    }

    public function countries(Request $request)
    {
        $countries = Config::get('constants.countries');
        if ($request->ajax()) {
            if ($request->wantsJson()) {
                return new JsonResponse($countries);
            } else {
                return $countries;
            }
        } else {
            return $countries;
        }
    }
}