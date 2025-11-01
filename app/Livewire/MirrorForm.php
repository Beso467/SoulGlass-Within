<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mirror;
use Livewire\Attributes\On;

class MirrorForm extends Component
{
    public $mirrorId, $name, $description, $season, $slug, $is_active, $starts_at, $ends_at;
    public $showModal = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'season' => 'required',
        'slug' => 'required',
    ];

    // Listen for the create event from Blade
    #[On('mirrorCreate')]
    public function create()
    {
        $this->reset([
            'mirrorId','name','slug','season','description','is_active','starts_at','ends_at'
        ]);

        $this->showModal = true;
    }

    // Listen for edit events
    #[On('mirror-edit')]
    public function edit($mirrorId)
    {
        $mirror = Mirror::findOrFail($mirrorId);
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

    public function save()
    {
        $this->validate();

        $mirror = Mirror::updateOrCreate(
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

        // Dispatch an event after saving
        $this->dispatch('mirror-saved', mirrorId: $mirror->id);
        $this->dispatch('mirror-saved');
    }

    public function render()
    {
        return view('livewire.mirror-form');
    }
}
