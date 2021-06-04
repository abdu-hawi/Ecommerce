<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\CountryDataTable;
use Illuminate\Http\Response;
use App\Model\Country;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class CountryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param CountryDataTable $dataTable
     * @return Response
     */
    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render('admin.countries.home',['title' => trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.countries.create' , ['title'=>trans('admin.create_new_country')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'country_name_ar' => 'required|unique:countries',
            'country_name_en' => 'required|unique:countries',
            'code' => 'required|max:3|unique:countries',
            'flag' => 'required|'.validate_image(),
            'ext' => 'required|numeric|unique:countries',
        ],[],[
            'country_name_ar' => trans('admin.country_name_ar'),
            'country_name_en' => trans('admin.country_name_en'),
            'code' => trans('admin.code'),
            'flag' => trans('admin.flag'),
            'ext' => trans('admin.ext'),
        ]);
        if (request()->hasFile('flag')){
            $data['flag'] = upload_file()->upload([
                'file' => 'flag',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $data['code'] = strtoupper($data['code']);
        $data['country_name_en'] = ucwords($data['country_name_en']);
        Country::create($data);
        session()->flash('success',trans('admin.add_success'));
        return redirect(aurl('countries'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.countries.edit',['country'=>$country,'title'=>trans('admin.edit_country')]);
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
        $data = $this->validate(request(),[
            'country_name_ar' => 'required|unique:countries,country_name_ar,'.$id,
            'country_name_en' => 'required|unique:countries,country_name_en,'.$id,
            'code' => 'required|max:3|unique:countries,code,'.$id,
            'flag' => 'sometimes|nullable|'.validate_image(),
            'ext' => 'required|numeric|unique:countries,ext,'.$id,
        ],[],[
            'country_name_ar' => trans('admin.country_name_ar'),
            'country_name_en' => trans('admin.country_name_en'),
            'code' => trans('admin.code'),
            'flag' => trans('admin.flag'),
            'ext' => trans('admin.ext'),
        ]);
        if (request()->hasFile('flag')){
            $data['flag'] = upload_file()->upload([
                'file' => 'flag',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => Country::find($id)->flag,
            ]);
        }
        $data['code'] = strtoupper($data['code']);
        $data['country_name_en'] = ucwords($data['country_name_en']);
        Country::where('id',$id)->update($data);
        session()->flash('success',trans('admin.add_success'));
        return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        Storage::delete($country->flag);
        $country->delete();
        session()->flash('success',trans('admin.country_delete_success'));
        return redirect(aurl('countries'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            foreach (request('item') as $id){
                $country = Country::find($id);
                Storage::delete($country->flag);
                $country->delete();
            }
        }else{
            $country = Country::find(request('item'));
            Storage::delete($country->flag);
            $country->delete();
        }
        session()->flash('success',trans('admin.records_delete_success'));
        return redirect(aurl('countries'));
    }
}
