<div>

    <div class="px-4 sm:px-6 lg:px-8 mx-12 mt-4">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Students</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the students in your account including their name, grade and department.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" wire:click="toggleVisibility" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Student</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Grade</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Department</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @if ($students->isEmpty())
                            <tr>No student found</tr>
                            @else
                            @foreach($students as $student)
                            <tr>
                                <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="flex items-center">
                                        <div class="h-11 w-11 flex-shrink-0">
                                            <img class="h-11 w-11 rounded-full" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $student->name }}</div>
                                            <div class="mt-1 text-gray-500">{{ $student->name }}@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    <div class="text-gray-900">{{ $student->grade }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                    {{ $student->department }}
                                </td>
                                <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <button type="button" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" wire:click="edit({{ $student->id }})">Edit</button>
                                    <button type="button" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" wire:click="delete({{ $student->id }})">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- model functionality here -->
    @if ($isVisible)
    <div>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75transition-opacity"></div>
        <form wire:submit.prevent="store">
            <div class="fixed inset-0  z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div>
                            <div class="mt-3 text-left sm:mt-5">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create Student</h3>
                                <div class="mb-4">
                                    <div class="mt-10 text-center grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-4">
                                            <div class="mt-2 ">
                                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300  focus-within:ring-indigo-100 sm:max-w-md">
                                                    <input type="text" wire:model="name" placeholder="Name" id="name" autocomplete="Name" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-inset focus:ring-indigo-100 sm:text-sm sm:leading-6">
                                                </div>
                                                @error('name') <span class=" text-left text-sm text-red-400">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="mt-2">
                                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input type="text" wire:model="grade" placeholder="Grade" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-inset focus:ring-indigo-100 sm:text-sm sm:leading-6">

                                                </div>
                                                @error('grade') <span class=" text-left text-sm text-red-400">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="mt-2">
                                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input type="text" wire:model="department" placeholder="Department" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-inset focus:ring-indigo-100 sm:text-sm sm:leading-6">

                                                </div>
                                                @error('department') <span class=" text-left text-sm text-red-400">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Save</button>
                                <button type="button" wire:click="toggleVisibility" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    @endif
    <!-- end here -->





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





    <!-- image uploader -->
    <livewire:student-image-uploader />
    <!-- End here -->

</div>