<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Mirror as MirrorModel;

class Mirror extends Component
{
    public $mirrors = [];
    public $layout = 'layouts.app';

    public function mount()
    {
        // Pull all mirrors from the DB
        $this->mirrors = MirrorModel::all();
    }

    #[On('mirror-saved')]
    public function refreshTable()
    {
        $this->mirrors = MirrorModel::all();
    }

    public function render()
    {
        return view('livewire.mirror')->layout('layouts.app');
    }
}
