<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function home()
    {
        $services = Service::latest()->take(6)->get()->map(function ($s) {
            return [
                'id'         => $s->id,
                'title'      => $s->title,
                'short_desc' => $s->short_desc,
                'icon_image' => $s->icon_image ? url(Storage::url($s->icon_image)) : null,
            ];
        });

        $portfolios = Portfolio::with('images')->latest()->take(4)->get()->map(function ($p) {
            return [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'short_desc'     => $p->short_desc,
                'full_content'   => $p->full_content,
                'project_date'   => $p->project_date?->format('M Y'),
                'image'          => $p->main_image_url ? url(Storage::url($p->main_image_url)) : ($p->images->first() ? url(Storage::url($p->images->first()->image_path)) : null),
                'main_image_url' => $p->main_image_url,
                'gallery'        => $p->images->map(function ($img) {
                    return [
                        'url' => url(Storage::url($img->image_path)),
                        'caption' => $img->caption
                    ];
                }),
            ];
        });

        $aboutPage = Page::where('slug', 'tentang-sekolah-kami')->first() ?: Page::first();
        $visiMisiPage = Page::where('slug', 'visi-misi')->first();
        $termsPage = Page::where('slug', 'syarat-ketentuan')->first();
        $privacyPage = Page::where('slug', 'kebijakan-privasi')->first();
        $faqPage = Page::where('slug', 'faq')->first();

        $mainSlugs = ['tentang-sekolah-kami', 'visi-misi', 'syarat-ketentuan', 'kebijakan-privasi', 'faq'];

        $otherPages = Page::whereNotIn('slug', $mainSlugs)->get()->map(function ($p) {
            return [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'content'        => $p->content,
                'featured_image' => $p->featured_image ? url(Storage::url($p->featured_image)) : null,
            ];
        });

        return response()->json([
            'services'     => $services,
            'portfolios'   => $portfolios,
            'aboutPage'    => $aboutPage ? [
                'title'          => $aboutPage->title,
                'content'        => $aboutPage->content,
                'featured_image' => $aboutPage->featured_image ? url(Storage::url($aboutPage->featured_image)) : null,
            ] : null,
            'visiMisiPage' => $visiMisiPage ? [
                'title'          => $visiMisiPage->title,
                'content'        => $visiMisiPage->content,
                'featured_image' => $visiMisiPage->featured_image ? url(Storage::url($visiMisiPage->featured_image)) : null,
            ] : null,
            'termsPage' => $termsPage ? [
                'title'          => $termsPage->title,
                'content'        => $termsPage->content,
                'featured_image' => $termsPage->featured_image ? url(Storage::url($termsPage->featured_image)) : null,
            ] : null,
            'privacyPage' => $privacyPage ? [
                'title'          => $privacyPage->title,
                'content'        => $privacyPage->content,
                'featured_image' => $privacyPage->featured_image ? url(Storage::url($privacyPage->featured_image)) : null,
            ] : null,
            'faqPage' => $faqPage ? [
                'title'          => $faqPage->title,
                'content'        => $faqPage->content,
                'featured_image' => $faqPage->featured_image ? url(Storage::url($faqPage->featured_image)) : null,
            ] : null,
            'otherPages' => $otherPages,
        ]);
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            ContactMessage::create($validated);
            return response()->json(['message' => 'Pesan Anda telah terkirim!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan pesan ke database.'], 500);
        }
    }
}
