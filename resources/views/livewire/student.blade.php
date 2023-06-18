<div>
    <form wire:submit.prevent="store">
        <input type="text" wire:model="name" placeholder="Name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <input type="text" wire:model="grade" placeholder="Grade">
        @error('grade') <span class="error">{{ $message }}</span> @enderror

        <input type="text" wire:model="department" placeholder="Department">
        @error('department') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save</button>
    </form>

    @if ($students->isEmpty())
        <p>No student found</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->grade }}</td>
                        <td>{{ $student->department }}</td>
                        <td>
                            <button wire:click="edit({{ $student->id }})">Edit</button>
                            <button wire:click="delete({{ $student->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
