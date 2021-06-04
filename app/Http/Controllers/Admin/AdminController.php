<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use Illuminate\Http\Response;
use App\Admin;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDataTable $dataTable
     * @return Response
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.admins.home',['title' => trans('admin.admin_account')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.admins.create' , ['title'=>trans('admin.create_new_admin')]);
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
            'name' => 'required|min:6',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[],[
            'name' => trans('admin.admin_name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        $data['password'] = bcrypt(request('password'));
        Admin::create($data);
        session()->flash('success',trans('admin.admin_add_success'));
        return redirect(aurl('admin'));
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
        $admin = Admin::find($id);
        return view('admin.admins.edit',['admin'=>$admin,'title'=>trans('admin.edit_admin')]);
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
            'name' => 'required|min:6',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'sometimes|nullable|confirmed|min:6',
            'password_confirmation' => 'sometimes|nullable'
        ],[],[
            'name' => trans('admin.admin_name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
            Admin::where('id',$id)->update(['name'=>$data['name'],'email'=>$data['email'],'password'=>$data['password']]);
        }else{
            Admin::where('id',$id)->update(['name'=>$data['name'],'email'=>$data['email']]);
        }
        session()->flash('success',trans('admin.records_update_success'));
        return redirect(aurl('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        session()->flash('success',trans('admin.admin_delete_success'));
        return redirect(aurl('admin'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            Admin::destroy(request('item'));
        }else{
            Admin::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.records_delete_success'));
        return redirect(aurl('admin'));
    }
}
