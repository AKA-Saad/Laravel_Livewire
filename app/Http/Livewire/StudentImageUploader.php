<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;

class StudentImageUploader extends Component
{
    use WithFileUploads;

    public $image;

    public function render()
    {
        return view('livewire.student-image-uploader');
    }

    public function save()
    {
        $this->validate([
            'image' => 'required|image|max:1024', // Adjust the max file size as needed
        ]);

        $path = $this->image->store('public/images');

        // Save the path to the student's image in the database or perform any other necessary actions

        session()->flash('message', 'Image uploaded successfully.');
    }
}
