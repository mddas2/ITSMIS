<?php

namespace App\Http\Controllers;

use App\Models\Modulehascategory;
use Illuminate\Http\Request;

class ModulehascategoryController extends Controller
{
    public function ModuleHaveCategory(Request $request){
        return Modulehascategory::all();
    }
}
