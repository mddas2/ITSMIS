<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingType;

class TrainingTypeController extends Controller
{
    private $_page = "pages.training_types.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage training Type';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = TrainingType::all();
        return view($this->_page . 'index', $this->_data);
    }

    public function create(Request $request)
    {
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');


        if (TrainingType::create($data)) {
            return redirect()->back()->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function edit($id)
    {

        $this->_data['training'] = TrainingType::findOrFail($id);
        return view($this->_page . 'edit', $this->_data);
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();

        $this->_data['training'] = TrainingType::findOrFail($id);

        if ($this->_data['training']->update($input)) {
            return redirect()->route('training_types.index')->with('success', 'Your Information Updated .');
        }

        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function destroy($id)
    {
        $data = TrainingType::findOrFail($id);
        if ($data->delete()){
            return redirect()->back()->with('success', "Category has been removed.");
        }
        return redirect()->back()->with('fail', "Category could not be deleted.");
    }
}
