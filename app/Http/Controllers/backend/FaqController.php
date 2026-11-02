<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('backend.faq.index', [
            'faqs' => $faqs
        ]);
    }
    
    public function create(){
        return view('backend.faq.add');
    }

    public function store(Request $request){
        $request->validate([
            'question'  => 'required',
            'answer'    => 'required',
        ]);
        Faq::newFaq($request);
        Alert::success('Success', 'FAQ added successfully');
        return back();
    }

    public function view($id){
        $faq = Faq::findOrFail($id);
        return view('backend.faq.view', [
            'faq' => $faq
        ]);
    }

    public function edit($id){
        $faq = Faq::findOrFail($id);
        return view('backend.faq.edit', [
            'faq' => $faq
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'question'  => 'required',
            'answer'    => 'required',
        ]);
        Faq::updateFaq($request, $id);
        Alert::success('Success', 'FAQ Updated successfully');
        return redirect()->route('admin.all-faq');
    }

    public function delete($id){
        Faq::deleteFaq($id);
        Alert::success('Success', 'FAQ Deleted successfully');
        return back();
    }
}
