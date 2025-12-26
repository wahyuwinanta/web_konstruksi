<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppoinmentRequest;
use App\Models\Appointment;
use App\Models\CompanyAbout;
use App\Models\CompanyStatistic;
use App\Models\HeroSection;
use App\Models\OurPrinciple;
use App\Models\OurTeam;
use App\Models\Product;
use App\Models\ProjectClient;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $hero_section = HeroSection::orderByDesc('id')->take(1)->get();
        $statistics = CompanyStatistic::take(4)->get();
        $principles = OurPrinciple::take(4)->get();
        $products = Product::take(4)->get();
        $teams = OurTeam::take(7)->get();
        $testimonials = Testimonial::take(5)->get();
        $clients = ProjectClient::take(10)->get();
        return view('front.index', compact('hero_section', 'statistics', 'principles', 'products', 'teams', 'testimonials', 'clients'));
    }

    public function team()
    {
        $teams = OurTeam::take(27)->get();
        $statistics = CompanyStatistic::take(4)->get();
        return view('front.team', compact('statistics', 'teams'));
    }

    public function about()
    {
        $products = Product::take(3)->get();
        $clients = ProjectClient::take(4)->get();
        $statistics = CompanyStatistic::take(4)->get();
        $abouts = CompanyAbout::take(4)->get();
        return view('front.about', compact('products', 'clients', 'statistics', 'abouts'));
    }

    public function appointment()
    {
        $statistics = CompanyStatistic::take(4)->get();
        $testimonials = Testimonial::take(4)->get();
        $clients = ProjectClient::take(4)->get();
        $products = Product::take(3)->get();

        return view('front.appointment', compact('testimonials', 'clients', 'statistics', 'products'));
    }

    public function appointment_store(StoreAppoinmentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            Appointment::create($validated);
        });

        return redirect()
            ->route('front.appointment')
            ->with('success', 'Janji temu berhasil dikirim. Kami akan segera menghubungi Anda.');
    }

}
