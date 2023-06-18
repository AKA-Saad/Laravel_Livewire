<?php

namespace App\Http\Livewire;

use App\Models\Student as ModelsStudent;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Student extends Component
{

    public $students;
    public $name;
    public $grade;
    public $department;

    public function render()
    {
        $this->students = ModelsStudent::all();
        return view('livewire.student', [
            'students' => $this->students,
        ]);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'grade' => 'required|numeric',
            'department' => 'required',
        ]);

        Student::create($validatedData);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $this->name = $student->name;
        $this->grade = $student->grade;
        $this->department = $student->department;
    }

    public function update($id)
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'grade' => 'required|numeric',
            'department' => 'required',
        ]);

        Student::findOrFail($id)->update($validatedData);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->grade = '';
        $this->department = '';
    }

    public function upload($field, $file, $load, $error, $progress)
    {
        // Validate the uploaded file
        $this->validate([
            $field => 'image|max:1024', // Example validation rules
        ]);

        // Store the uploaded file and get the file path
        $filePath = $file->store('student-images', 'public');

        // Perform additional processing if needed (e.g., resizing, cropping, etc.)

        // Update the image property with the file path
        $this->image = $filePath;

        // Signal FilePond that the file upload is complete
        $load($filePath);
    }

    public function removeUpload($field, $filename, $load)
    {
        // Delete the file from storage
        Storage::disk('public')->delete($filename);

        // Clear the image property
        $this->image = null;

        // Signal FilePond that the file removal is complete
        $load();
    }
}
