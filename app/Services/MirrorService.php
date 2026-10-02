<?php

namespace App\Services;

use App\Models\Mirror;
use App\Models\Quote;
use App\Models\User;
use App\Models\UserQuote;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Collection;

class MirrorService
{
    public function currentMirror(): Mirror
    {
        $season = match (true) {
            in_array(now()->month, [12, 1, 2]) => 'winter',
            in_array(now()->month, [3, 4, 5]) => 'spring',
            in_array(now()->month, [6, 7, 8]) => 'summer',
            default => 'fall',
        };

        return Mirror::where('type', 'seasonal')
            ->where('season', $season)
            ->firstOrFail();
    }

    public function today(User $user): string
    {
        return now($user->timezone)->toDateString();
    }

    public function todayFor(User $user): ?UserQuote
    {
        return $user->userQuotes()
            ->whereDate('seen_on', $this->today($user))
            ->with('quote')
            ->first();
    }

    public function reveal(User $user): UserQuote
    {
        if ($existing = $this->todayFor($user)) {
            return $existing;
        }

        $mirror = $this->currentMirror();
        $active = $mirror->quotes()->where('is_active', true);

        $seenIds = $user->userQuotes()->pluck('quote_id');
        $quotes = (clone $active)->whereNotIn('id', $seenIds)->get();

        // Seen everything: allow repeats so the mirror is never blank.
        if ($quotes->isEmpty()) {
            $quotes = $active->get();
        }

        abort_if($quotes->isEmpty(), 503, 'This mirror has no quotes yet.');

        try {
            return $user->userQuotes()->create([
                'quote_id' => $this->pick($quotes)->id,
                'seen_on' => $this->today($user),
            ]);
        } catch (UniqueConstraintViolationException) {
            // A double tap got there first.
            return $this->todayFor($user);
        }
    }

    private function pick(Collection $quotes): Quote
    {
        $roll = random_int(1, $quotes->sum('weight'));

        foreach ($quotes as $quote) {
            $roll -= $quote->weight;

            if ($roll <= 0) {
                return $quote;
            }
        }

        return $quotes->last();
    }
}
