<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TradeMark;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\DataTables\TradeMarkDataTable;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TradeMarkDataTable $dataTable
     * @return Response
     */
    public function index(TradeMarkDataTable $dataTable)
    {
        return $dataTable->render('admin.trademarks.home', ['title' => trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.trademarks.create', ['title' => trans('admin.create_new_trademark')]);
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
            'trademark_name_ar' => 'required|unique:trademarks',
            'trademark_name_en' => 'required|unique:trademarks',
            'trademark_logo' => 'required|' . validate_image(),
        ], [], [
            'trademark_name_ar' => trans('admin.trademark_name_ar'),
            'trademark_name_en' => trans('admin.trademark_name_en'),
            'trademark_logo' => trans('admin.trademark_logo'),
        ]);
        if (request()->hasFile('trademark_logo')) {
            $data['trademark_logo'] = upload_file()->upload([
                'file' => 'trademark_logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $data['trademark_name_en'] = ucwords($data['trademark_name_en']);
        TradeMark::create($data);
        session()->flash('success', trans('admin.add_success'));
        return redirect(aurl('trademarks'));
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
        $trademark = TradeMark::find($id);
        return view('admin.trademarks.edit', ['trademark' => $trademark, 'title' => trans('admin.edit_trademark')]);
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
            'trademark_name_ar' => 'required|unique:trademarks,trademark_name_ar,' . $id,
            'trademark_name_en' => 'required|unique:trademarks,trademark_name_en,' . $id,
            'trademark_logo' => 'sometimes|nullable|' . validate_image(),
        ], [], [
            'trademark_name_ar' => trans('admin.trademark_name_ar'),
            'trademark_name_en' => trans('admin.trademark_name_en'),
            'trademark_logo' => trans('admin.trademark_logo'),
        ]);
        if (request()->hasFile('trademark_logo')) {
            $data['trademark_logo'] = upload_file()->upload([
                'file' => 'trademark_logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => TradeMark::find($id)->trademark_logo,
            ]);
        }
        $data['trademark_name_en'] = ucwords($data['trademark_name_en']);
        TradeMark::where('id', $id)->update($data);
        session()->flash('success', trans('admin.add_success'));
        return redirect(aurl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $trademark = TradeMark::find($id);
        Storage::delete($trademark->trademark_logo);
        $trademark->delete();
        session()->flash('success', trans('admin.trademark_delete_success'));
        return redirect(aurl('trademarks'));
    }

    protected function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $trademark = TradeMark::find($id);
                Storage::delete($trademark->trademark_logo);
                $trademark->delete();
            }
        } else {
            $trademark = TradeMark::find(request('item'));
            Storage::delete($trademark->trademark_logo);
            $trademark->delete();
        }
        session()->flash('success', trans('admin.records_delete_success'));
        return redirect(aurl('trademarks'));
    }
}

