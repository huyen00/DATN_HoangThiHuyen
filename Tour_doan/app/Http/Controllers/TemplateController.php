<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use App\Models\Tour;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
class TemplateController extends Controller
{
    use FileUploadTrait;

    public function index(){
        $templates = Template::get();
        return Inertia::render('Template/Index',compact('templates'));
        
    }

    public function edit($id){
        $template = Template::findOrFail($id);
        return Inertia::render('Template/Edit',compact('template'));
        
    }


    public function store(TemplateRequest $request){


        $destinationpath= 'Template/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }
        $template= Template::create([
            'name' => $request->name,
            'link_code' => $request->link_code,
            'image' => $request->hasFile('image')? $this->image($request->file('image'), $destinationpath):null,

        ]);

        $template_path = $destinationpath.$template->id;
        if (!file_exists($template_path)) {
            mkdir($template_path, 0777, true);
        }
        $css_template = $template_path.'/css';
     
        if (!file_exists($css_template)) {
            mkdir($css_template, 0777, true);
        }
        $responsive_template = $css_template.'/responsive.css';
    
        $js_template = $template_path.'/js';
        if (!file_exists($js_template)) {
            mkdir($js_template, 0777, true);
        }
        $template->link_css = $css_template.'/style.css';
        $template->link_js = $js_template.'/main.js';
        $template->responsive = $css_template.'/responsive.css';
        $template->save();
        if (!file_exists($template->link_js)) {
            File::put(public_path($template->link_js), file_get_contents(public_path('assets/js/main.js')));
        }
        if (!file_exists($template->link_css)) {
            File::put(public_path($template->link_css), file_get_contents(public_path('assets/css/style.css')));
        }
        if (!file_exists($template->responsive)) {
            File::put(public_path($template->responsive), file_get_contents(public_path('assets/css/responsive.css')));
        }
        return back()->with('success', 'Create successfully');
    }


    public function update(Request $request,$id){

        $template= Template::findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required|unique:templates,name,' . $template->id,
                'image' => 'nullable|mimes:png,jpg',
                'link_code' => 'required',

            ]
        );
        $destinationpath= 'Template/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }
        $name= time();
        $template->update([
            'name' => $request->name,
            'link_code' => $request->link_code,
            'image' => $request->hasFile('image')? $this->update_image($request->file('image'),$name,  $destinationpath, $template->image):$template->image,

        ]);
        
        $template_path = $destinationpath.$template->id;
        if (!file_exists($template_path)) {
            mkdir($template_path, 0777, true);
        }
        $css_template = $template_path.'/css';
     
        if (!file_exists($css_template)) {
            mkdir($css_template, 0777, true);
        }
        $js_template = $template_path.'/js';
        if (!file_exists($js_template)) {
            mkdir($js_template, 0777, true);
        }
        $template->link_css = $css_template.'/style.css';
        $template->link_js = $js_template.'/main.js';
        $template->responsive = $css_template.'/responsive.css';
        $template->save();
        if (!file_exists($template->link_js)) {
            File::put(public_path($template->link_js), file_get_contents(public_path('assets/js/main.js')));
        }
        if (!file_exists($template->link_css)) {
            File::put(public_path($template->link_css), file_get_contents(public_path('assets/css/style.css')));
        }
        if (!file_exists($template->responsive)) {
            File::put(public_path($template->responsive), file_get_contents(public_path('assets/css/responsive.css')));
        }
        $template->link_css = $css_template.'/style.css';
        $template->link_js = $js_template.'/main.js';
        $template->responsive = $css_template.'/responsive.css';
        $template->save();
        return back()->with('success', 'Update successfully');

    }

    public function delete($id){
        $template= Template::findOrFail($id);
        $template->delete();
        return back()->with('success', 'Delete successfully');
    }

    public function TemplateTour($id){
        $tour= Tour::with('template')->findOrFail($id);
        $templates = Template::get();
     

        return Inertia::render('Tour/Template/Index', compact('templates', 'tour'));
    }
    public function storeTemplate(Request $request, $id){
     
        $tour= Tour::findOrFail($id);
        $tour->update([
            'template_id' => $request->template_id
        ]);
        return back()->with('success', ' Successfully');
    }
}
