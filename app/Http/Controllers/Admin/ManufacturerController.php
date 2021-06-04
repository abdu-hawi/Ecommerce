<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManufacturerDataTable;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Manufacturer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Form;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ManufacturerDataTable $dataTable
     * @return Response
     */
    public function index(ManufacturerDataTable $dataTable)
    {
        return $dataTable->render('admin.manufacturers.home',['title' => trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(){
        if (request()->ajax()){
            if (request()->has('country_id')){
                $select = request()->has('select')?request('select'):'';
                return Form::label('city_id',trans('admin.city_id'))."".
                    Form::select('city_id',City::where('country_id',request('country_id'))
                        ->pluck('city_name_'.lang(),'id'),$select,['class'=>'form-control ','placeholder'=>trans('admin.please_select_city')])
                    ;
            }
        }
        return view('admin.manufacturers.create' , ['title'=>trans('admin.create_new_manufacturer')]);
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
            'manufacturer_name_ar' => 'required|unique:manufacturers',
            'manufacturer_name_en' => 'required|unique:manufacturers',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'manufacturer_logo' => 'sometimes|nullable|'.validate_image(),
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable',
            'address' => 'sometimes|nullable',
            'lat' => 'sometimes|nullable|numeric',
            'long' => 'sometimes|nullable|numeric',
            'site' => 'sometimes|nullable|url',
        ],[],[
            'manufacturer_name_ar' => trans('admin.manufacturer_name_ar'),
            'manufacturer_name_en' => trans('admin.manufacturer_name_en'),
            'manufacturer_logo' => trans('admin.manufacturer_logo'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
            'email' => trans('admin.email'),
            'phone' => trans('admin.phone'),
            'address' => trans('admin.address'),
            'lat' => trans('admin.lat'),
            'long' => trans('admin.long'),
            'site' => trans('admin.site'),
        ]);
        if (request()->hasFile('manufacturer_logo')){
            $data['manufacturer_logo'] = upload_file()->upload([
                'file' => 'manufacturer_logo',
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $data['manufacturer_name_en'] = ucwords($data['manufacturer_name_en']);
        Manufacturer::create($data);
        session()->flash('success',trans('admin.add_success'));
        return redirect(aurl('manufacturers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);
        if (lang() == 'ar')
            return view('admin.manufacturers.show',['manufacturer'=>$manufacturer,'title'=>trans('admin.show_manufacturer'),'factory'=>$manufacturer->manufacturer_name_ar]);
        else
            return view('admin.manufacturers.show',['manufacturer'=>$manufacturer,'title'=>trans('admin.show_manufacturer'),'factory'=>$manufacturer->manufacturer_name_en]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $manufacturer = Manufacturer::find($id);
        return view('admin.manufacturers.edit',['manufacturer'=>$manufacturer,'title'=>trans('admin.edit_manufacturer')]);
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
            'manufacturer_name_ar' => 'required|unique:manufacturers,manufacturer_name_ar,'.$id,
            'manufacturer_name_en' => 'required|unique:manufacturers,manufacturer_name_en,'.$id,
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'manufacturer_logo' => 'sometimes|nullable|'.validate_image(),
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable',
            'address' => 'sometimes|nullable',
            'lat' => 'sometimes|nullable|numeric',
            'long' => 'sometimes|nullable|numeric',
            'site' => 'sometimes|nullable|url',
        ],[],[
            'manufacturer_name_ar' => trans('admin.manufacturer_name_ar'),
            'manufacturer_name_en' => trans('admin.manufacturer_name_en'),
            'manufacturer_logo' => trans('admin.manufacturer_logo'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
            'email' => trans('admin.email'),
            'phone' => trans('admin.phone'),
            'address' => trans('admin.address'),
            'lat' => trans('admin.lat'),
            'long' => trans('admin.long'),
            'site' => trans('admin.site'),
        ]);
        if (request()->hasFile('manufacturer_logo')){
            $data['manufacturer_logo'] = upload_file()->upload([
                'file' => 'manufacturer_logo',
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => Manufacturer::find($id)->manufacturer_logo,
            ]);
        }
        $data['manufacturer_name_en'] = ucwords($data['manufacturer_name_en']);
        Manufacturer::where('id',$id)->update($data);
        session()->flash('success',trans('admin.update_success'));
        return redirect(aurl('manufacturers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        Storage::delete($manufacturer->manufacturer_logo);
        $manufacturer->delete();
        session()->flash('success',trans('admin.manufacturer_delete_success'));
        return redirect(aurl('manufacturers'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            foreach (request('item') as $id){
                $manufacturer = Manufacturer::find($id);
                Storage::delete($manufacturer->manufacturer_logo);
                $manufacturer->delete();
            }
        }else{
            $manufacturer = Manufacturer::find(request('item'));
            Storage::delete($manufacturer->manufacturer_logo);
            $manufacturer->delete();
        }
        session()->flash('success',trans('admin.records_delete_success'));
        return redirect(aurl('manufacturers'));
    }
}
