<?php

namespace App\Http\Controllers\Admin;

use App\Model\Section;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.sections.home' , ['title'=>trans('admin.sections')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.sections.create' , ['title'=>trans('admin.create_new_section')]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),[
            'section_name_ar' => 'required|unique:sections,section_name_ar',
            'section_name_en' => 'required|unique:sections,section_name_en',
            'icon_section' => 'sometimes|nullable|'.validate_image(),
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
            'parent' => 'sometimes|nullable',
        ],[],[
            'section_name_ar' => trans('admin.section_name_ar'),
            'section_name_en' => trans('admin.section_name_en'),
            'icon_section' => trans('admin.icon_section'),
            'description' => trans('admin.description'),
            'keyword' => trans('admin.keyword'),
            'parent' => trans('admin.parent'),
        ]);
        if (request()->hasFile('icon_section')){
            $data['icon_section'] = upload_file()->upload([
                'file' => 'icon_section',
                'path' => 'sections',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $data['section_name_en'] = ucwords($data['section_name_en']);
        Section::create($data);
        session()->flash('success',trans('admin.add_success'));
        return redirect(aurl('sections'));
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return void
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $section = Section::find($id);
        return view('admin.sections.edit',['section'=>$section,'title'=>trans('admin.edit_section')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),[
            'section_name_ar' => 'required|unique:sections,section_name_ar,'.$id,
            'section_name_en' => 'required|unique:sections,section_name_en,'.$id,
            'icon_section' => 'sometimes|nullable|'.validate_image(),
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
            'parent' => 'sometimes|nullable',
        ],[],[
            'section_name_ar' => trans('admin.section_name_ar'),
            'section_name_en' => trans('admin.section_name_en'),
            'icon_section' => trans('admin.icon_section'),
            'description' => trans('admin.description'),
            'keyword' => trans('admin.keyword'),
            'parent' => trans('admin.parent'),
        ]);
        if (request()->hasFile('icon_section')){
            $data['icon_section'] = upload_file()->upload([
                'file' => 'icon_section',
                'path' => 'sections',
                'upload_type' => 'single',
                'delete_file' => Section::find($id)->icon_section,
            ]);
        }
        $data['section_name_en'] = ucwords($data['section_name_en']);
        Section::where('id',$id)->update($data);
        session()->flash('success',trans('admin.update_success'));
        return redirect(aurl('sections'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public static function delete_parent($id){
        $sections = Section::where('parent',$id)->get();
        foreach ($sections as $sec){
            self::delete_parent($sec->id);
            if(!empty($sec->icon_section)){
                Storage::has($sec->icon_section)?Storage::delete($sec->icon_section):'';
            }
        }
        $section = Section::where('id',$id)->get();
        foreach ($section as $sec){
            Storage::has($sec->icon_section)?Storage::delete($sec->icon_section):'';
        }
        Section::find($id)->delete();
    }
    public function destroy($id)
    {
        self::delete_parent($id);
        session()->flash('success',trans('admin.section_delete_success'));
        return redirect(aurl('sections'));
        //delete($id);
//        Section::find($id)->delete();
//        session()->flash('success',trans('admin.section_delete_success'));
//        return redirect(aurl('sections'));

    }
}
