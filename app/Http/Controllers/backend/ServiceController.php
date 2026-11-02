<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('backend.services.index', [
            'services' => $services
        ]);
    }

    public function create(){
        return view('backend.services.add');
    }

    public function store(Request $request){
        $request->validate([
            'serviceName'    => 'required|string|max:255',
            'serviceImage'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'serviceDetails' => 'nullable|string',
        ], [
            'serviceName.required'  => 'Service name is required.',
            'serviceImage.image'    => 'The file must be an image.',
            'serviceImage.mimes'    => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'serviceImage.max'      => 'The image size must not exceed 2MB.',
            'serviceDetails.string' => 'Service details must be a string.',
        ]);
        Service::addService($request);
        Alert::success('Success', 'Service added successfully');
        return back();
    }

    public function edit($id){
        $service = Service::findOrFail($id);
        return view('backend.services.edit', [
            'service' => $service
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'serviceName'    => 'required|string|max:255',
            'serviceImage'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'serviceDetails' => 'nullable|string',
        ], [
            'serviceName.required'  => 'Service name is required.',
            'serviceImage.image'    => 'The file must be an image.',
            'serviceImage.mimes'    => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'serviceImage.max'      => 'The image size must not exceed 2MB.',
            'serviceDetails.string' => 'Service details must be a string.',
        ]);
        Service::updateService($request, $id);
        Alert::success('Success', 'Service updated successfully');
        return redirect()->route('admin.all-services');
    }

    public function view($id){
        $service = Service::findOrFail($id);
        return view('backend.services.view', [
            'service' => $service
        ]);
    }

    public function destroy($id){
        Service::deleteService($id);
        Alert::success('Success', 'Service deleted successfully');
        return back();
    }
}
