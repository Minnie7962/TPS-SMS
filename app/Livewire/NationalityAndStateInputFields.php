<?php

namespace App\Livewire;

use Livewire\Component;
use Nnjeim\World\World;
use Illuminate\Support\Collection;

class NationalityAndStateInputFields extends Component
{
    public $nationalities;

    public $nationality;

    public $states;

    public $state;

    protected $rules = [
        'nationality' => 'nullable|string|max:255',
        'state'       => 'nullable|string|max:255',
    ];

    public function mount()
    {
        // Default nationalities with Cambodia as default
        $this->nationalities = collect(['Khmer', 'Other']);
        $this->nationality = 'Khmer';
        
        // Load complete list of Cambodian provinces with standardized naming
        $this->states = collect([
            ['name' => 'Banteay Meanchey', 'code' => 'BM'],
            ['name' => 'Battambang', 'code' => 'BB'],
            ['name' => 'Kampong Cham', 'code' => 'KC'],
            ['name' => 'Kampong Chhnang', 'code' => 'KG'],
            ['name' => 'Kampong Speu', 'code' => 'KS'],
            ['name' => 'Kampong Thom', 'code' => 'KT'],
            ['name' => 'Kampot', 'code' => 'KP'],
            ['name' => 'Kandal', 'code' => 'KL'],
            ['name' => 'Kep', 'code' => 'KE'],
            ['name' => 'Koh Kong', 'code' => 'KK'],
            ['name' => 'Kratie', 'code' => 'KR'],
            ['name' => 'Mondulkiri', 'code' => 'MK'],
            ['name' => 'Oddar Meanchey', 'code' => 'OM'],
            ['name' => 'Pailin', 'code' => 'PL'],
            ['name' => 'Phnom Penh', 'code' => 'PP'],
            ['name' => 'Preah Sihanouk', 'code' => 'SV'],
            ['name' => 'Preah Vihear', 'code' => 'PV'],
            ['name' => 'Prey Veng', 'code' => 'PG'],
            ['name' => 'Pursat', 'code' => 'PS'],
            ['name' => 'Ratanakiri', 'code' => 'RK'],
            ['name' => 'Siem Reap', 'code' => 'SR'],
            ['name' => 'Stung Treng', 'code' => 'ST'],
            ['name' => 'Svay Rieng', 'code' => 'SG'],
            ['name' => 'Takeo', 'code' => 'TK'],
            ['name' => 'Tbong Khmum', 'code' => 'TM'],
        ]);

        $this->state = $this->states[0]['name'];
    }

    public function updatedNationality()
    {
        $this->loadStatesForNationality();
        $this->dispatch('nationality-updated', ['nationality' => $this->nationality]);
        $this->dispatch('state-updated', ['state' => $this->state]);
    }

    public function loadStatesForNationality()
    {
        if (empty($this->nationality)) {
            $this->states = collect();
            $this->state = null;
            return;
        }

        // Special handling for Cambodia (both "Khmer" and "Cambodian")
        if ($this->nationality === 'Khmer' || $this->nationality === 'Cambodian') {
            $this->states = collect([
                ['name' => 'Banteay Meanchey', 'code' => 'BM'],
                ['name' => 'Battambang', 'code' => 'BB'],
                ['name' => 'Kampong Cham', 'code' => 'KC'],
                ['name' => 'Kampong Chhnang', 'code' => 'KG'],
                ['name' => 'Kampong Speu', 'code' => 'KS'],
                ['name' => 'Kampong Thom', 'code' => 'KT'],
                ['name' => 'Kampot', 'code' => 'KP'],
                ['name' => 'Kandal', 'code' => 'KL'],
                ['name' => 'Kep', 'code' => 'KE'],
                ['name' => 'Koh Kong', 'code' => 'KK'],
                ['name' => 'Kratie', 'code' => 'KR'],
                ['name' => 'Mondulkiri', 'code' => 'MK'],
                ['name' => 'Oddar Meanchey', 'code' => 'OM'],
                ['name' => 'Pailin', 'code' => 'PL'],
                ['name' => 'Phnom Penh', 'code' => 'PP'],
                ['name' => 'Preah Sihanouk', 'code' => 'SV'],
                ['name' => 'Preah Vihear', 'code' => 'PV'],
                ['name' => 'Prey Veng', 'code' => 'PG'],
                ['name' => 'Pursat', 'code' => 'PS'],
                ['name' => 'Ratanakiri', 'code' => 'RK'],
                ['name' => 'Siem Reap', 'code' => 'SR'],
                ['name' => 'Stung Treng', 'code' => 'ST'],
                ['name' => 'Svay Rieng', 'code' => 'SG'],
                ['name' => 'Takeo', 'code' => 'TK'],
                ['name' => 'Tbong Khmum', 'code' => 'TM'],
            ]);
            $this->state = $this->states->first()['name'] ?? null;
            return;
        }

        try {
            $result = World::countries([
                'fields'  => 'states',
                'filters' => ['name' => $this->nationality],
            ])->data;

            $states = collect($result->pluck('states')->first() ?? []);

            // If no states are returned, use the nationality itself as a default "state"
            $this->states = $states->isNotEmpty() ? $states : collect([['name' => $this->nationality]]);
        } catch (\Exception $e) {
            // Handle errors gracefully by falling back to an empty list
            $this->states = collect();
        }

        $this->state = $this->states->first()['name'] ?? null;
    }

    public function updatedState()
    {
        $this->dispatch('state-updated', ['state' => $this->state]);
    }

    public function loadInitialStates()
    {
        $this->loadStatesForNationality();
    }

    public function render()
    {
        return view('livewire.nationality-and-state-input-fields');
    }
}