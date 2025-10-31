<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mirror as MirrorModel;

class Mirror extends Component
{
    public $mirrors = [];
    public $mirror = [];
    public $layout = 'layouts.app';

    public function mount()
    {
        // Pull all mirrors from the DB
        $this->mirrors = MirrorModel::all();
    }

    public function render()
    {
        return view('livewire.mirror')->layout('layouts.app');
    }
}
