<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Service;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function index(){
        $services = Service::all();
        $ratings = Rating::orderBy('created_at', 'desc')->get();
        return view('backend.ratings.index', [
            'ratings' => $ratings,
            'services' => $services,
        ]);
    }

    public function create(){
        $services = Service::all();
        return view('backend.ratings.add', [
            'services' => $services,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'service'       => 'required|exists:services,id',
            'plan'          => 'required|exists:plans,id',
            'clientName'    => 'required|string|max:255',
            'planRating'    => 'required|integer|min:1|max:5',
            'clientReview'  => 'required|string|max:1000',
        ], [
            'service.required'      => 'Please select a service.',
            'plan.required'         => 'Please select a plan.',
            'clientName.required'   => 'Client name is required.',
            'clientName.max'        => 'Client name should be in 255 characters.',
            'planRating.required'   => 'Please select a rating.',
            'clientReview.required' => 'Client review is required.',
            'clientReview.string'   => 'Client review must be a string.',
            'clietnReview.max'      => 'Client review should be in 1000 characters.',
        ]);
        Rating::addRating($request);
        Alert::success('Success', 'Rating added successfully');
        return back();
    }

    public function edit($id){
        $rating = Rating::findOrFail($id);
        $services = Service::all();
        return view('backend.ratings.edit', [
            'rating' => $rating,
            'services' => $services,
        ]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'service'       => 'required|exists:services,id',
            'plan'          => 'required|exists:plans,id',
            'clientName'    => 'required|string|max:255',
            'planRating'    => 'required|integer|min:1|max:5',
            'clientReview'  => 'required|string|max:1000',
        ], [
            'service.required'      => 'Please select a service.',
            'plan.required'         => 'Please select a plan.',
            'clientName.required'   => 'Client name is required.',
            'clientName.max'        => 'Client name should be in 255 characters.',
            'planRating.required'   => 'Please select a rating.',
            'clientReview.required' => 'Client review is required.',
            'clientReview.string'   => 'Client review must be a string.',
            'clietnReview.max'      => 'Client review should be in 1000 characters.',
        ]);
        Rating::updateRating($request, $id);
        Alert::success('Success', 'Rating updated successfully');
        return redirect()->route('admin.all-ratings');
    }

    public function destroy($id){
        Rating::deleteRating($id);
        Alert::success('Success', 'Rating deleted successfully');
        return redirect()->route('admin.all-ratings');
    }

    public function view($id){
        $rating = Rating::findOrFail($id);
        return view('backend.ratings.view', [
            'rating' => $rating,
        ]);
    }
}
