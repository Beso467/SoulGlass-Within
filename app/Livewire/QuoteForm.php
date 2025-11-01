<?php

namespace App\Livewire;

use App\Models\Mirror;
use App\Models\Quote;
use Livewire\Attributes\On;
use Livewire\Component;

class QuoteForm extends Component
{
    public $mirrors = [];
    public $mirror_id = null;
    public $text = null;
    public $showModal = false;
    public $quoteId = null;

    protected $rules = [
        'mirror_id' => 'required',
        'text' => 'required',
    ];

    public function mount()
    {
        $this->mirrors = Mirror::all();
    }

    #[On('quoteCreate')]
    public function create()
    {
        $this->reset([
            'mirror_id', 'text'
        ]);
        $this->showModal = true;
    }

    #[On('quote-edit')]
    public function edit($quoteId)
    {
        $quote = Quote::findOrFail($quoteId);
        $this->quoteId = $quoteId;
        $this->mirror_id = $quote->mirror_id;
        $this->text = $quote->text;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $quote = Quote::updateOrCreate(
            ['id' => $this->quoteId],
            [
                'mirror_id' => $this->mirror_id,
                'text' => $this->text,
            ]
        );

        $this->showModal = false;

        // Dispatch an event after saving
        $this->dispatch('quote-saved', quoteId: $quote->id);
        $this->dispatch('quote-saved');
    }

    public function render()
    {
        return view('livewire.quote-form');
    }
}
