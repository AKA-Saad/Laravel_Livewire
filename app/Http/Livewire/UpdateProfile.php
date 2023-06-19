<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $image;

    public $images = [];

    public function updateProfile(): void
    {

        // code to add here images

        session()->flash('notify', 'Form saved !');
    }

    public function render()
    {
        return view('livewire.update-profile');
    }
}
