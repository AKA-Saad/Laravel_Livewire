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
    public $isVisible = false;

    public function toggleVisibility()
    {
        $this->isVisible = !$this->isVisible;
    }
    
    public function render()
    {
        $this->students = ModelsStudent::getStudents();
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

        ModelsStudent::create($validatedData);

        $this->resetInputFields();
    }

    public function edit($id)
    {

        $student = ModelsStudent::findOrFail($id);

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

        ModelsStudent::findOrFail($id)->update($validatedData);

        $this->resetInputFields();
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
