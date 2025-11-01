<?php

namespace App\Livewire;

use App\Models\Quote as ModelsQuote;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Component;

class Quote extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->quotes = ModelsQuote::paginate(10);
    }

    #[On('quote-saved')]
    public function refreshTable()
    {
        $this->resetPage(); // optional but nice
    }

    public function render()
    {
        return view('livewire.quote', [
            'quotes' => ModelsQuote::paginate(10),
        ]);
    }
}
