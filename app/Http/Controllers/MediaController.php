<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 30/06/2016
 * Time: 10:47 PM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function profile(Request $request, $name, $id)
    {
        try {
            $user = User::findOrFail($id);
            if (!is_null($user->info) && !is_null($user->info->profile_pic)) {
                $imageStr = base64_decode($user->info->profile_pic);
                return response($imageStr)
                    ->header('Content-Type', "image/jpeg")
                    ->header('Content-Disposition', 'inline; filename=profile')
                    ->header('Content-Length', strlen($imageStr));
            }else{
                
            }
        } catch (ModelNotFoundException $e) {

        }
    }
}