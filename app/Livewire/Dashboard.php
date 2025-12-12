<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quote;
use App\Models\UserQuote;
use App\Models\UserScrollQuote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $quote = null;
    public $mirrorName = null;
    public $isReveal = false;
    public $addedToScroll = false;
    public $mirrorIcon = null;

    public function mount()
    {
        $user = Auth::user();
        if (!$user->last_seen_quote || Carbon::parse($user->last_seen_quote)->toDateString() != now()->toDateString())
        {
            $this->isReveal = false;
        } else {
            $this->isReveal = true;
            $this->quote = $user->seenQuotes->sortBy('created_at', false)->first()->quote->text;
            $this->mirrorName = $user->seenQuotes->sortBy('created_at', false)->first()->quote->mirror->name;
            $this->mirrorIcon = $user->seenQuotes->sortBy('created_at', false)->first()->quote->mirror->icon;
        }
        if(in_array($user->lastSeenQuote()->id, $user->scroll->pluck('quote_id')->toArray())) $this->addedToScroll = true;
    }

    public function generateQuote()
    {
        $user = Auth::user();
        if (!$user->last_seen_quote || Carbon::parse($user->last_seen_quote)->toDateString() != now()->toDateString()) {
            // Determine season
            $season = $this->getSeason();

            // Get the mirror for that season
            $mirror = \App\Models\Mirror::where('season', $season)->first();

            if (!$mirror) {
                $this->quote = "No quotes available for this season.";
                $this->mirrorName = "Unknown";
                return;
            }

            $this->mirrorName = $mirror->name;

            // Get IDs of quotes this user has already seen
            $seenQuoteIds = UserQuote::where('user_id', $user->id)
                ->pluck('quote_id')
                ->toArray();

            // Get an unseen quote from this mirror
            $quote = Quote::where('mirror_id', $mirror->id)
                ->whereNotIn('id', $seenQuoteIds)
                ->inRandomOrder()
                ->first();

            if (!$quote) {
                // If all quotes seen, pick any random quote
                $quote = Quote::where('mirror_id', $mirror->id)
                    ->inRandomOrder()
                    ->first();
            }

            $this->quote = $quote ? $quote : "No quotes available.";

            // Record it as seen
            if ($quote) {
                UserQuote::updateOrCreate([
                    'user_id' => $user->id,
                    'quote_id' => $quote->id,
                    'liked' => 0,
                ]);
                $user->update([
                    'last_seen_quote' => now(),
                    'current_streak' => $user->increment('current_streak'),
                    'last_saved_quote_at' => null,
                    'save_streak' => 0,
                    'no_save_streak' => 0,
                ]);
                if($user->current_streak >= $user->highest_streak){
                    $user->update([
                        'highest_streak' => $user->current_streak,
                    ]);
                }
            }
            $this->isReveal = true;
        }
    }

    protected function getSeason()
    {
        $month = now()->month;

        return match (true) {
            $month >= 3 && $month <= 5 => 'Spring',
            $month >= 6 && $month <= 8 => 'Summer',
            $month >= 9 && $month <= 11 => 'Fall',
            default => 'Winter',
        };
    }

    public function addToScroll()
    {
        $user = Auth::user();
        $actualQuote = $user->lastSeenQuote();
        UserScrollQuote::create([
            'user_id' => $user->id,
            'quote_id' => $actualQuote->id,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

