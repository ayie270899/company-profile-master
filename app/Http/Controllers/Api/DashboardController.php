<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $recentMessages = ContactMessage::latest()->take(3)->get()->map(function ($msg) {
            return [
                'id'         => $msg->id,
                'name'       => $msg->name,
                'subject'    => $msg->subject,
                'created_at' => $msg->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'stats' => [
                ['label' => 'Total Halaman',   'count' => Page::count(),           'key' => 'pages'],
                ['label' => 'Total Layanan',   'count' => Service::count(),        'key' => 'services'],
                ['label' => 'Total Portfolio', 'count' => Portfolio::count(),      'key' => 'portfolios'],
                ['label' => 'Pesan Masuk',     'count' => ContactMessage::count(), 'key' => 'contact-messages'],
            ],
            'recentMessages' => $recentMessages,
            'user'           => [
                'name' => $request->user()->name,
            ],
        ]);
    }
}
