<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\Faq;
use App\Models\HomeBanner;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use App\Models\SocialMediaLink;

class CmsController extends Controller
{
    public function page($slug)
    {
        $page = CmsPage::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return response()->json($page);
    }

    public function faqs()
    {
        return response()->json(Faq::where('status', 'active')->orderBy('sort_order')->get());
    }

    public function homeBanners()
    {
        return response()->json(HomeBanner::where('status', 'active')->orderBy('sort_order')->get());
    }

    public function seo($page)
    {
        $seo = SeoSetting::where('page', $page)->first();
        if (!$seo) {
            return response()->json(['message' => 'SEO setting not found'], 404);
        }
        return response()->json($seo);
    }

    public function siteSettings()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return response()->json($settings);
    }

    public function socialMediaLinks()
    {
        return response()->json(SocialMediaLink::where('is_active', true)->first());
    }

    public function contactInfo()
    {
        return response()->json(SocialMediaLink::where('is_active', true)->first());
    }
}
