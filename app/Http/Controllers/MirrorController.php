<?php

namespace App\Http\Controllers;

use App\Models\UserQuote;
use App\Services\MirrorService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MirrorController extends Controller
{
    public function show(Request $request, MirrorService $mirrors)
    {
        $user = $request->user();
        $today = $mirrors->todayFor($user);

        return Inertia::render('mirror', [
            'mirror' => $mirrors->currentMirror()->only(
                'slug', 'name', 'title', 'season', 'accent_color',
            ),
            'dayCount' => $user->userQuotes()->count(),
            'today' => $today ? [
                'id' => $today->id,
                'text' => $today->quote->text,
                'date' => $today->seen_on->toDateString(),
                'favorited' => $today->favorited_at !== null,
            ] : null,
        ]);
    }

    public function reveal(Request $request, MirrorService $mirrors)
    {
        $data = $request->validate([
            'timezone' => ['nullable', 'timezone'],
        ]);

        if (! empty($data['timezone'])) {
            $request->user()->update(['timezone' => $data['timezone']]);
        }

        $mirrors->reveal($request->user());

        return back();
    }

    public function favorite(Request $request, UserQuote $userQuote)
    {
        abort_unless($userQuote->user_id === $request->user()->id, 403);

        $userQuote->update([
            'favorited_at' => $userQuote->favorited_at ? null : now(),
        ]);

        return back();
    }
}
