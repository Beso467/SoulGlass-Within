<div class="py-20 flex justify-center items-center min-h-screen bg-gradient-to-b from-gray-900 to-gray-950">
    <div class="relative w-full max-w-lg aspect-[4/3] border-2 border-dotted border-gray-500/50 rounded-2xl flex flex-col items-center justify-center text-center p-8 shadow-[0_0_30px_rgba(255,255,255,0.05)] hover:shadow-[0_0_50px_rgba(255,255,255,0.1)] transition duration-500">
        <span>Current Streak: {{ Auth::user()->current_streak }}</span>
        @if($isReveal)
        <h1 class="text-5xl font-yarndings tracking-widest text-gray-200 mb-1 uppercase">
            {{ $mirrorIcon }}
        </h1>
        <h1 class="text-2xl font-bold tracking-widest text-gray-200 mb-3 uppercase">
            {{ $mirrorName }}
        </h1>

        <p class="text-gray-400 text-sm max-w-xs italic mb-6">
            “{{ $quote }}”
        </p>
        @else
        <h1 class="text-2xl font-bold tracking-widest text-gray-200 mb-3 uppercase">
            Unlock Your Within
        </h1>

        <p class="text-gray-400 text-sm max-w-xs italic mb-6">
            “What will the mirror reveal today?”
        </p>
        @endif

        @if(!$isReveal)
        <button wire:click="generateQuote"
            class="px-6 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-200 font-semibold tracking-wide transition duration-300">
            Reveal
        </button>
        @else
        <div class="d-flex align-content-center">
            @if(!$addedToScroll)
            <button wire:click="addToScroll('{{ $quote }}')"
            class="px-6 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-200 font-yarndings tracking-wide transition duration-300">
                y
            </button>
            @endif
            <button
                class="px-6 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-200 font-semibold tracking-wide transition duration-300">
                Come back tomorrow
            </button>
        </div>
        @endif

        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gray-950 px-4 text-gray-500 text-xs uppercase tracking-wider">
            SoulGlass
        </div>
    </div>
</div>
