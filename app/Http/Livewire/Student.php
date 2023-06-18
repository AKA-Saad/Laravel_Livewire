<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Student as ModelsStudent;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Student extends Component
{

    use WithFileUploads;

    public $currentStudent = null;
    public  $uploadImageFlag = false;
    public $students;
    public $name;
    public $grade;
    public $department;
    public $isEdit = false;
    public $isVisible = false;
    public $image;

    public function toggleVisibility()
    {
        $this->isEdit = false;
        $this->isVisible = !$this->isVisible;
    }

    public function toggleUpload()
    {
        $this->uploadImageFlag = !$this->uploadImageFlag;
    }


    public function render()
    {
        $this->students = ModelsStudent::getStudents();
        return view('livewire.student', [
            'students' => $this->students,
        ]);
    }

    public function upload($id)
    {
        $this->currentStudent = $id;
        $this->uploadImageFlag = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'grade' => 'required|numeric',
            'department' => 'required',
        ]);

        ModelsStudent::create($validatedData);

        $this->resetInputFields();
        $this->isVisible = !$this->isVisible;
    }

    public function imageUploaded()
    {
        $this->validate([
            'image' => 'required|image|max:1024', // Adjust the max file size as needed
        ]);

        $path = $this->image->store('public/images');
        $student = ModelsStudent::findOrFail($this->currentStudent);
        $student->image_path = $path;
        $student->save();
        // Save the path to the student's image in the database or perform any other necessary actions

        session()->flash('message', 'Image uploaded successfully.');
    }

    public function edit($id)
    {

        $student = ModelsStudent::findOrFail($id);

        $this->name = $student->name;
        $this->grade = $student->grade;
        $this->department = $student->department;
        $this->isVisible = !$this->isVisible;
        $this->isEdit = true;
        $this->currentStudent = $id;
    }

    public function update($id)
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'grade' => 'required|numeric',
            'department' => 'required',
        ]);

        ModelsStudent::findOrFail($id)->update($validatedData);

        $this->resetInputFields();
        $this->isVisible = !$this->isVisible;
    }

    public function delete($id)
    {
        ModelsStudent::findOrFail($id)->delete();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->grade = '';
        $this->department = '';
    }
}
