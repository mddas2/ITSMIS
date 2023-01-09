<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\AccessLevel;
use App\Models\Hierarchy;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $officeId = auth()->user()->office_id;
        $hierarchyId = !empty(auth()->user()->hierarchy)?auth()->user()->hierarchy->hierarchy_id:0;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $hierarchyTitle[0] = "";
        $hierarchyTitle[1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {                    
                    if ($key != count($parentHierarchy)-1) {
                        $hierarchyTitle[0] .= $parent['name'];
                        $hierarchyTitle[0] .= ($key != count($parentHierarchy) - 2) ?', ':'';
                    } else {
                        $hierarchyTitle[1] = $parent['name'];
                    }
                    
                }
            }
        }

        $accessLevel = AccessLevel::all();
        $moduleLevel = [];
        foreach ($accessLevel as $key=>$level) {
            if (!empty($officeId) && !empty($level->office_id)) {
                $office = unserialize($level->office_id);
                if (in_array($officeId, $office)) {
                    $modules = unserialize($level->module_id);
                    array_push($moduleLevel,$modules);
                }
            } else if (!empty($hierarchyId) &&  !empty($level->hierarchy_id)) {
                if ($level->hierarchy_id == $hierarchyId) {
                    $modules = unserialize($level->module_id);
                    array_push($moduleLevel,$modules);
                }
            }
        }


        $level = [];
        foreach ($moduleLevel as $module) {
            foreach ($module as $data) {
                array_push($level,$data);
            }
        }
        return view('components.header',['moduleLevel' => $level,'hierarchyTitle' => $hierarchyTitle]);
    }
}
