<?php

namespace App\Http\Controllers\Frontend;


use App\Enums\Status;
use App\Models\Analytic;
use App\Models\ThemeSetting;
use App\Http\Controllers\Controller;

class RootController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $analytics    = Analytic::with('analyticSections')->where(['status' => Status::ACTIVE])->get();
        $themeFavicon = ThemeSetting::where(['key' => 'theme_favicon_logo'])->first();
        if ($themeFavicon && isset($themeFavicon->faviconLogo)) {
        $favIcon = $themeFavicon->faviconLogo;
    } else {
        // Provide a default value or handle the error
        $favIcon = 'default-favicon.png'; // Replace with your default favicon path
    }
        return view('master', ['analytics' => $analytics, 'favicon' => $favIcon]);
    }
}
