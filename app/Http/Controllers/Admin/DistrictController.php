<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\DistrictDataTable;
use Illuminate\Http\Response;
use App\Model\District;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Form;
use App\Model\City;

class DistrictController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param DistrictDataTable $dataTable
     * @return Response
     */
    public function index(DistrictDataTable $dataTable)
    {
        return $dataTable->render('admin.districts.home', ['title' => trans('admin.districts')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|string
     */
    public function create()
    {
        if (request()->ajax()){
            if (request()->has('country_id')){
                $select = request()->has('select')?request('select'):'';
                return Form::label('city_id',trans('admin.city_id'))."".
                    Form::select('city_id',City::where('country_id',request('country_id'))
                        ->pluck('city_name_'.lang(),'id'),$select,['class'=>'form-control ','placeholder'=>trans('admin.please_select_city')])
                ;
            }
        }
        return view('admin.districts.create', ['title' => trans('admin.create_new_district')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store()
    {
        $data = $this->validate(request(), [
            'district_name_ar' => 'required|unique:districts',
            'district_name_en' => 'required|unique:districts',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
        ], [], [
            'district_name_ar' => trans('admin.district_name_ar'),
            'district_name_en' => trans('admin.district_name_en'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
        ]);
        $data['district_name_en'] = ucwords($data['district_name_en']);
        District::create($data);
        session()->flash('success', trans('admin.add_success'));
        return redirect(aurl('districts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $district = District::find($id);
        return view('admin.districts.edit', ['district' => $district, 'title' => trans('admin.edit_district')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'district_name_ar' => 'required|unique:districts,district_name_ar,' . $id,
            'district_name_en' => 'required|unique:districts,district_name_en,' . $id,
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
        ], [], [
            'district_name_ar' => trans('admin.district_name_ar'),
            'district_name_en' => trans('admin.district_name_en'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
        ]);
        $data['district_name_en'] = ucwords($data['district_name_en']);
        District::where('id', $id)->update($data);
        session()->flash('success', trans('admin.update_success'));
        return redirect(aurl('districts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        District::find($id)->delete();
        session()->flash('success', trans('admin.district_delete_success'));
        return redirect(aurl('districts'));
    }

    protected function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                District::find($id)->delete();
            }
        } else {
            District::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.records_delete_success'));
        return redirect(aurl('districts'));
    }
}

