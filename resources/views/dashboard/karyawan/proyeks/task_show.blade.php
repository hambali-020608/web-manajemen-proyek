<x-dashboard-layout>
    <div class="">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative inline-block text-left mb-6">
                <div>
                    <button type="button" id="projectDropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700" aria-expanded="true" aria-haspopup="true">
                        {{$proyek->nama_proyek}}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Dropdown panel -->
                <div id="projectDropdown" class="hidden origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 dark:ring-gray-600 z-50">
                    <div class="py-1 max-h-96 overflow-y-auto" role="menu" aria-orientation="vertical" aria-labelledby="projectDropdownButton">
                        <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Proyek Aktif</p>
                        </div>
                        @foreach ($proyeks as $project)
                        <a href="{{$project->id}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 {{ $project->id == $proyek->id ? 'bg-blue-50 dark:bg-gray-700' : '' }}" role="menuitem">
                            <div class="flex justify-between items-center">
                                <span>{{$project->nama_proyek}}</span>
                                @if($project->id == $proyek->id)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    Aktif
                                </span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>

            <!-- Project Header -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg dark:bg-gray-800">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{$proyek->nama_proyek}}</h1>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                            Active Project
                        </span>
                    </div>
                    <button id="addTaskBtn" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Task
                    </button>
                </div>
            </div>

            <!-- Task Progress Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @foreach ($proyek->task as $task )
                @php
                $totalSubtasks = $task->sub_task->count();
                $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                $progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
            @endphp
                <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{$task->nama_task}}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{$task->proyek->nama_proyek}}</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                            In Progress
                        </span>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500 dark:text-gray-400">Progress</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{$progress}}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$progress}}%"></div>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="detail-btn text-sm px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600" data-task="1">
                    Subtask
                        </button>
                        <button onclick="openEditModal()" class="detail-btn text-sm px-3 py-1 bg-blue-500 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600" >
                            Update Task 
                        </button>

                        
<!-- Edit Project Modal -->
<div id="editTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Project</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editTaskForm" method="POST" action="/task/update/{{$task->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editTaskName" class="block text-sm font-medium text-gray-700 mb-1 text-left">Task Name</label>
                        <input type="text" id="editTaskName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="nama_task"  value="{{old('nama_task',$task->nama_task)}}">
                    </div>
                    
<div class="mb-4">
    <label for="proyeks" class="blockx mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Project</label>
    <select id="proyeks" name="id_proyek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach ($proyeks as $proyek )
    <option value="{{ $proyek->id }}" {{ $proyek->id == $task->proyek->id ? 'selected' : '' }}>{{$proyek->nama_proyek}}</option>
  
    @endforeach
    </select>
</div>
                    <div class="mb-4">
                        <label for="editTaskDeadline" class="block text-sm font-medium text-gray-700 mb-1 text-left">Deadline</label>
                        <input type="date" id="editTaskDeadline" name="deadline_task" value="{{old('deadline_task',$task->deadline_task)}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" id="cancelEditTaskBtn" onclick="this.closest('[id^=editTaskModal]').classList.add('hidden')"  class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- edit project modal selesai --}}
                        
                        
                    </div>
                    
                    <!-- Subtask Container (Hidden by default) -->
                    <div id="subtask-1" class="hidden mt-4 border-t pt-4">
                        <h4 class="text-md font-medium mb-2 dark:text-white">Subtask:</h4>
                        <ul class="space-y-2">
                            @foreach ($task->sub_task as $subtask)
                            <li class="flex items-center">
                                <span class="ml-2 text-sm dark:text-gray-300">{{$subtask->nama_sub_task}}</span>
                            </li>
                            @endforeach
                            
                            
                        </ul>
                        <div class="mt-3 flex">
                           {{-- subtask button --}}
                           <button id="addSubTaskBtn" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah SubTask
                        </button>
                        </div>
                    </div>
                </div>


                
            <!-- Add Subtask Modal -->
            <div id="addSubTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Tambah SubTask Baru</h3>

                        <div class="mt-2 px-7 py-3">
                            <form method="POST" action="/create-subtask">
                                @csrf
                             
                                    <h3 class="font-bold mb-3">{{$task->nama_task}}</h3>
                                    <input type="hidden" id="taskName" value="{{$task->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="id_task" readonly>
                                <div class="mb-4">
                                    <label for="taskName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Nama SubTask</label>
                                    <input type="text" id="taskName"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="nama_sub_task" required>
                                </div>
                                <div class="mb-4">
                                

    <label for="tukangs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Tukang</label>
    <select id="tukangs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="id_tukang">
        <option value="NULL" selected>Pilih Tukang</option>
        @foreach ($tukangs as $tukang )
        <option value="{{$tukang->id}}">{{$tukang->name}}</option>
            
        @endforeach    
    </select> 
              </div>
        
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                   
                                    <div>
                                        <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deadline SubTask</label>
                                        <input type="date" id="endDate" name="deadline_sub_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3 mt-4">
                                    <button type="button" id="cancelSubTaskBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- SubTask modal done --}}

                
                @endforeach
               
            </div>

            <!-- Add Task Modal -->
            <div id="addTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Tambah Task Baru</h3>
                        <p class="mt-3 font-bold">{{$proyek->nama_proyek}}</p>

                        <div class="mt-2 px-7 py-3">
                            <form method="POST" action="/create-task">
                                @csrf
                                <div class="mb-4">
                                    <label for="taskName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Nama Task</label>
                                    <input type="text" id="taskName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="nama_task" required>
                                </div>
                                

                                    <input type="hidden" id="proyek" value="{{$proyek->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="id_proyek" required> 
        
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                   
                                    <div>
                                        <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deadline Task</label>
                                        <input type="datetime-local" id="endDate" name="deadline_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3 mt-4">
                                    <button type="button" id="cancelTaskBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Task modal done --}}


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Task Modal Toggle
            const addTaskBtn = document.getElementById('addTaskBtn');
            const addTaskModal = document.getElementById('addTaskModal');
            const cancelTaskBtn = document.getElementById('cancelTaskBtn');
            
            const addSubTaskBtn = document.getElementById('addSubTaskBtn');
            const addSubTaskModal = document.getElementById('addSubTaskModal');
            const cancelSubTaskBtn = document.getElementById('cancelSubTaskBtn');
            const projectDropdownButton = document.getElementById('projectDropdownButton');
                    const projectDropdown = document.getElementById('projectDropdown');
                    
                    projectDropdownButton.addEventListener('click', function() {
                        projectDropdown.classList.toggle('hidden');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!projectDropdownButton.contains(event.target) && !projectDropdown.contains(event.target)) {
                            projectDropdown.classList.add('hidden');
                        }
                    });

            addTaskBtn.addEventListener('click', function() {
                addTaskModal.classList.remove('hidden');
            });
            
            cancelTaskBtn.addEventListener('click', function() {
                addTaskModal.classList.add('hidden');
            });
            addSubTaskBtn.addEventListener('click', function() {
                addSubTaskModal.classList.remove('hidden');
            });
            
            cancelSubTaskBtn.addEventListener('click', function() {
                addSubTaskModal.classList.add('hidden');
            });

            // Subtask Toggle
            const detailButtons = document.querySelectorAll('.detail-btn');
            
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const taskId = this.getAttribute('data-task');
                    const subtaskContainer = document.getElementById(`subtask-${taskId}`);
                    
                    // Toggle visibility
                    subtaskContainer.classList.toggle('hidden');
                    
                    // Change button text
                    if (subtaskContainer.classList.contains('hidden')) {
                        this.textContent = 'Subtask';
                    } else {
                        this.textContent = 'Sembunyikan';
                    }
                });
            });
        });
        function openEditModal() {
    const modal = document.getElementById('editTaskModal');
    const form = document.getElementById('editTaskForm');
    
    // Set form action
    // form.action = `/projects/${id}`;
    
    // // Fill form fields
    // document.getElementById('editProjectName').value = name;
    // document.getElementById('editProjectClient').value = clientId;
    // document.getElementById('editProjectDeadline').value = deadline.split(' ')[0]; // Format date properly
    
    // Show modal
    modal.classList.remove('hidden');
}

    </script>
</x-dashboard-layout>