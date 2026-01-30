<div class="mirror-box">
    <span class="streak-counter">Current Streak: {{ Auth::user()->current_streak }}</span>
    <div class="quote-wrapper">
        @if($isReveal)
            <h2 class="font-yarndings mirror-icon">
                {{ $mirrorIcon }}
            </h2>

            <p class="quote-text">
                “{{ $quote }}”
            </p>
        @else
        <h2 class="uppercase">
            Unlock Your Within
        </h2>

        <p>
            “What will the mirror reveal today?”
        </p>
        @endif

        @if(!$isReveal)
        <button wire:click="generateQuote"
            class="primary-btn">
            Reveal
        </button>
        @else
        <div class="d-flex align-content-center">
            @if(!$addedToScroll)
            <button wire:click="addToScroll('{{ $quote }}')"
            class="primary-btn">
                Add To Scroll
            </button>
            @endif
            <button class="primary-btn">
                Come back tomorrow
            </button>
        </div>
        @endif
    </div>
</div>
