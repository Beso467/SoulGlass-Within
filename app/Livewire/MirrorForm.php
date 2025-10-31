<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mirror;

class MirrorForm extends Component
{
    public $mirrorId = null;
    public $name = null;
    public $description = null;
    public $season = null;
    public $slug = null;
    public $is_active = null;
    public $starts_at = null;
    public $ends_at = null;
    public $showModal = false;
    protected $listeners = [
        'create' => 'create',
        'edit' => 'edit',
    ];

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'season' => 'required',
        'slug' => 'required',
    ];

    public function create()
    {
        $this->reset([
            'mirrorId','name','slug','season'
            ,'description','is_active',
            'starts_at','ends_at'
        ]);
        $this->showModal = true;
    }

    public function edit(Mirror $mirror)
    {
        $this->mirrorId = $mirror->id;
        $this->name = $mirror->name;
        $this->slug = $mirror->slug;
        $this->season = $mirror->season;
        $this->description = $mirror->description;
        $this->is_active = $mirror->is_active;
        $this->starts_at = $mirror->starts_at?->format('Y-m-d\TH:i');
        $this->ends_at = $mirror->ends_at?->format('Y-m-d\TH:i');
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.mirror-form');
    }

    public function save()
    {
        $this->validate();

        Mirror::updateOrCreate(
            ['id' => $this->mirrorId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'season' => $this->season,
                'description' => $this->description,
                'is_active' => $this->is_active ?? true,
                'starts_at' => $this->starts_at,
                'ends_at' => $this->ends_at,
            ]
        );

        $this->showModal = false;
        $this->emit('mirrorSaved');
    }

}
