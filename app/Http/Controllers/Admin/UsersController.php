<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersDataTable $dataTable
     * @return Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.home',['title' => trans('admin.users_account')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.users.create' , ['title'=>trans('admin.create_new_users')]);
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
            'email' => 'required|email|unique:users',
            'level' => 'required|in:user,vendor,company',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[],[
            'name' => trans('admin.user_name'),
            'email' => trans('admin.email'),
            'level' => trans('admin.level'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        session()->flash('success',trans('admin.users_add_success'));
        return redirect(aurl('users'));
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
        $users = User::find($id);
        return view('admin.users.edit',['users'=>$users,'title'=>trans('admin.edit_users')]);
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
            'email' => 'required|email|unique:users,email,'.$id,
            'level' => 'required|in:user,vendor,company',
            'password' => 'sometimes|nullable|confirmed|min:6',
            'password_confirmation' => 'sometimes|nullable'
        ],[],[
            'name' => trans('admin.user_name'),
            'email' => trans('admin.email'),
            'level' => trans('admin.level'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
            User::where('id',$id)->update(['name'=>$data['name'],'email'=>$data['email'],'level'=>$data['level'],'password'=>$data['password']]);
        }else{
            User::where('id',$id)->update(['name'=>$data['name'],'email'=>$data['email'],'level'=>$data['level']]);
        }
        session()->flash('success',trans('admin.records_update_success'));
        return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success',trans('admin.user_delete_success'));
        return redirect(aurl('users'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            User::destroy(request('item'));
        }else{
            User::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.records_delete_success'));
        return redirect(aurl('users'));
    }
}
