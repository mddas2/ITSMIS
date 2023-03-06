<?php

namespace App\Http\Controllers;

use App\Models\Modulehascategory;
use App\Models\ItemCategory;
use App\Models\AccessLevel;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ModulehascategoryController extends Controller
{    
    public function ModuleHaveCategory(Request $request)
    {
        $categories =  ItemCategory::pluck('name_np', 'id')->toArray();
        $this->_data['categories'] = $categories;
        // $list = [];
        // $this->_data['list'] = $list;
        // $nodes = Hierarchy::get()->toTree();
        // $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
        //     foreach ($categories as $category) {
        //         $lang = Session::get('applocale');
        //         if($lang == 'np'){
        //             $list[$category->id] =  $prefix . ' ' . $category->name_ne;
        //         }else{
        //             $list[$category->id] =  $prefix . ' ' . $category->name;
        //         }
        //         $this->_data['list'] = $list;
        //         $traverse($category->children, $prefix . '-');
        //     }
        // };
        // $traverse($nodes);


        $lang = Session::get('applocale');

        if($lang == 'np'){
            $this->_data['modules'] = [
                '1' => 'भन्सार विभाग',
                '2' => 'वाणिज्य, आपूर्ति र उपभोक्ता अधिकार संरक्षण विभाग',
                '3' => 'उद्योग विभाग',
                '4' => 'नेपाल आयल निगम',
                '5' => 'खाद्य व्यवस्थापन र व्यापार कम्पनी',
                '6' => 'साल्ट ट्रेडिङ लिमिटेड',
                '7' => 'स्थानीय तह',
                '8' => 'जिल्ला प्रशासन कार्यालय',
                '9' => 'प्रदेश स्तर - घर तथा साना उद्योग कार्यालय',
                '10' => 'प्रदेश स्तर - उद्योग, वाणिज्य तथा उपभोक्ता संरक्षण निर्देशनालय',
                '11' => 'गृह उद्योग प्रवर्द्धन केन्द्र',
                '12' => 'उद्योग र निजी क्षेत्र',
                '13' => 'कम्पनी रजिष्‍ट्रारको कार्यालय',
            ];
        }else{
            $this->_data['modules'] = [
                '1' => 'Department Of Custom',
                '2' => 'Deparment Of Commerce, Supply and Consumer Right Protection',
                '3' => 'Department Of Industry',
                '4' => 'Nepal Oil Corporation',
                '5' => 'Food Management and Trading Company',
                '6' => 'Salt Trading Limited',
                '7' => 'Local Level',
                '8' => 'District Administration Office',
                '9' => 'Province Level - Home And Small Industrial Office',
                '10' => 'Province Level - Directorate of Industry, Commerce and Consumer Protection',
                '11' => 'Home Industry Promotion Center',
                '12' => 'Industry And Private Sector',
                '13' => 'Office of The Company Registrar',
            ];
        }

        return view('pages.hierarchies.modules_have_category', $this->_data);
    }

    public function getModuleHasCategory(Request $request)
    {
        $query = Modulehascategory::query();
        if ($request->has('module_id')) {
            $query->where('module_id',$request->module_id);
        }

        $data = $query->where('module_id',$request->module_id)->pluck('category_id')->toArray();
        return $data;      
       
    }
    public function getModuleHasCategoryList(Request $request)
    {
        $query = Modulehascategory::query();
        if ($request->has('module_id')) {
            $query->where('module_id',$request->module_id);
        }

        $data = $query->where('module_id',$request->module_id)->pluck('category_id')->toArray();
        return $data;      
       
    }

}
