<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::orderBy('created_at', 'desc')->get();
        return view('backend.plans.index', [
            'plans' => $plans
        ]);
    }

    public function create(){
        $services = Service::all();
        return view('backend.plans.add', [
            'services' => $services,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'service'               => 'required|exists:services,id',
            'planName'              => 'required|string|max:255',
            'planPrice'             => 'required|numeric|min:0|max:1000000',
            'planDuration'          => 'required|integer|min:7|max:90',
            'planFeatures'          => 'required|array|min:1',
            'planFeatures.*'        => 'required|string|max:255',
            'planDescription'       => 'nullable|string',
        ], [
            'service.required'          => 'Please select a service.',
            'planName.required'         => 'Plan name is required.',
            'planName.max'              => 'Plan name must be in 255 characters',
            'planPrice.required'        => 'Plan price is required.',
            'planPrice.numeric'         => 'Plan price must be a number.',
            'planPrice.min'             => 'Plan price can not be neagative value.',
            'planPrice.max'             => 'Plan price can not be greater than 1000000.',
            'planDuration.required'     => 'Plan duration is required.',
            'planDuration.max'          => 'Plan duration is maximum 90 days.',
            'planFeatures.required'     => 'At least one plan feature is required.',
            'planFeatures.*'            => 'Each plan feature is required.',
        ]);

        Plan::addPlan($request);
        Alert::success('Success', 'Plan added successfully');
        return back();
    }

    public function edit($id){
        $plan = Plan::findOrFail($id);
        $features = $plan->planFeatures ? json_decode($plan->planFeatures, true) : [''];
        $services = Service::all();
        return view('backend.plans.edit', [
            'plan' => $plan,
            'features' => $features,
            'services' => $services,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'service'               => 'required|exists:services,id',
            'planName'              => 'required|string|max:255',
            'planPrice'             => 'required|numeric|min:0|max:1000000',
            'planDuration'          => 'required|integer|min:7|max:90',
            'planFeatures'          => 'required|array|min:1',
            'planFeatures.*'        => 'required|string|max:255',
            'planDescription'       => 'nullable|string',
        ], [
            'service.required'          => 'Please select a service.',
            'planName.required'         => 'Plan name is required.',
            'planName.max'              => 'Plan name must be in 255 characters',
            'planPrice.required'        => 'Plan price is required.',
            'planPrice.numeric'         => 'Plan price must be a number.',
            'planPrice.min'             => 'Plan price can not be neagative value.',
            'planPrice.max'             => 'Plan price can not be greater than 1000000.',
            'planDuration.required'     => 'Plan duration is required.',
            'planDuration.max'          => 'Plan duration is maximum 90 days.',
            'planFeatures.required'     => 'At least one plan feature is required.',
            'planFeatures.*'            => 'Each plan feature is required.',
        ]);

        Plan::updatePlan($request, $id);
        Alert::success('Success', 'Plan updated successfully');
        return redirect()->route('admin.all-plans');
    }

    public function destroy($id){
        Plan::deletePlan($id);
        Alert::success('Success', 'Plan deleted successfully');
        return back();
    }

    public function view($id){
        $plan = Plan::findOrFail($id);
        return view('backend.plans.view', [
            'plan' => $plan,
        ]);
    }

    public function getPlansByService($service_id){
        $plans = Plan::where('service_id', $service_id)->get(['id', 'planName']);
        return response()->json($plans);
    }
}
