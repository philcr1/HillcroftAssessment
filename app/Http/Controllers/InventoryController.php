<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class InventoryController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function loadInventory(Request $request)//: RedirectResponse
    {
       echo "HELLO HELLO";
        //return response()->json(['error' => 'XML file not found.']);

       /*return back()
        ->with('success','You have successfully upload file.');*/
            
    }
}
