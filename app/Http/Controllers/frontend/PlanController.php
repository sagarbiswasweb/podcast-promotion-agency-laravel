<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index($slug){
        // Fetch plan details with ratings and teams
        $planDetails = Plan::with(['ratings', 'teams', 'service'])->where('slug', $slug)->firstOrFail();

        // Average rating
        $averageRating = $planDetails->ratings->avg('planRating');

        // Team lead (position = 1)
        $teamLead = $planDetails->teams->firstWhere('position', 1);

        // Rating percentage breakdown
        $total = $planDetails->ratings->count();
        $starsCount = [];

        for ($i = 1; $i <= 5; $i++) {
            $starsCount[$i] = $planDetails->ratings->where('planRating', $i)->count();
        }

        $starsPercent = [];
        foreach ($starsCount as $star => $count) {
            $starsPercent[$star] = $total > 0 ? round(($count / $total) * 100) : 0;
        }

        return view('frontend.plans.index', [
            'planDetails'   => $planDetails,
            'teamLead'      => $teamLead,
            'averageRating' => $averageRating,
            'starsPercent'  => $starsPercent,
        ]);
    }

}
