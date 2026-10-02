<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ScrollController extends Controller
{
    public function show(Request $request)
    {
        $quotes = $request->user()->userQuotes()->whereNotNull('favorited_at')
        ->with('quote.mirror')->latest('seen_on')->get()
        ->map(fn ($row) => [
            'id' => $row->id,
            'text' => $row->quote->text,
            'date' => $row->seen_on->toDateString(),
            'mirror' => $row->quote->mirror->only('name', 'title', 'accent_color'),
        ]);

        return Inertia::render('scroll', [
            'quotes' => $quotes,
        ]);
    }
}
