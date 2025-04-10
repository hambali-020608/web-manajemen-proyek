<x-dashboard-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header and Project Selection -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">All Projects Management</h1>
            <div class="relative">
                <button id="projectDropdownButton" class="inline-flex justify-between items-center w-64 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                    All Projects
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-64 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1 max-h-96 overflow-y-auto">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-700">Select Project</p>
                        </div>
                        @foreach ($proyeks as $project)
                        
                        <a href="/dashboard/proyek/overview/{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <div class="flex justify-between items-center">
                                <span>{{ $project->nama_proyek }}</span>
                            </div>
                        </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards for All Projects -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Projects</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $proyeks->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                        <p class="text-2xl font-semibold text-gray-800">
                            @php
                                $totalTasks = 0;
                                foreach($proyeks as $project) {
                                    $totalTasks += $project->task->count();
                                }
                                echo $totalTasks;
                            @endphp
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Active Projects</p>
                        <p class="text-2xl font-semibold text-gray-800">
                            @php
                                $activeProjects = $proyeks->filter(function($project) {
                                    return $project->status_proyek === 'in_progress';
                                })->count();
                                echo $activeProjects;
                                @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- all proyek --}}
        <div class="bg-white shadow rounded-lg overflow-hidden mb-5">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">All Proyek Overview</h2>
                <div class="flex space-x-3">
                    
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($proyeks as $project)
                        @php
                        // Calculate project progress based on tasks
                        $totalTasks = $project->task->count();
                        $completedTasks = $project->task->where('status_task', 'completed')->count();
                        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                        
                        // Get unique team members across all tasks in this project
                        $teamMembers = collect();
                        foreach($project->task as $task) {
                            foreach($task->sub_task as $subtask) {
                                if ($subtask->tukang) {
                                    $teamMembers->push($subtask->tukang);
                                }
                            }
                        }
                        $teamMembers = $teamMembers->unique('id');
                        
                        // Find nearest deadline among all tasks
                        $nearestDeadline = $project->task->sortBy('deadline_task')->first();
                    @endphp
    
                        
                            <tr>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <a href="/dashboard/proyek/overview/{{ $project->id }}" class="text-blue-600 hover:text-blue-800">{{ $project->nama_proyek }}</a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $progress }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 flex">
                                    
                            <img class="h-6 w-6 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode($project->klien->name) }}&background=random" alt="{{ $project->klien->name }}">
                            <p class="font-medium">{{ $project->klien->name }}</p>
                        
                                        
                                        {{-- {{ $completedSubtasks }} of {{ $totalSubtasks }} completed --}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex -space-x-2">
                                        @foreach($teamMembers as $member)
                                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" 
                                             src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                             alt="{{ $member->name }}"
                                             title="{{ $member->name }}">
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($project->deadline_proyek)->format('M d, Y') }}
                                        @if(\Carbon\Carbon::parse($project->deadline_proyek)->isPast() && $progress < 100)
                                        <span class="ml-1 text-xs text-red-500">Overdue</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex">
                                    <button onclick="openEditModal('{{ $project->id }}', '{{ $project->nama_proyek }}', '{{ $project->klien->id }}', '{{ $project->deadline_proyek }}')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 rounded-full">
                                        Edit
                                    </button>
                                    
                                    <form id="DeleteProjectForm" method="POST" action="/proyek/delete/{{$project->id}}">
                                        @csrf
                                        @method('DELETE')
                                        
                                    </form>
                                    <button type="button" onclick="confirmDelete()" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete
                                    </button>
                                </td>
                            </tr>


<!-- Edit Project Modal -->
<div id="editProjectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Project</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editProjectForm" method="POST" action="/proyek/update/{{$project->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editProjectName" class="block text-sm font-medium text-gray-700 mb-1 text-left">Project Name</label>
                        <input type="text" id="editProjectName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="nama_proyek"  value="{{old('nama_proyek',$project->nama_proyek)}}">
                    </div>
                    
<div class="mb-4">
    <label for="kliens" class="blockx mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Klien</label>
    <select id="kliens" name="id_klien" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach ($kliens as $klien )
    <option value="{{ $klien->id }}" {{ $klien->id == $project->id_klien ? 'selected' : '' }}>{{$klien->name}}</option>
  
    @endforeach
    </select>
</div>
                    <div class="mb-4">
                        <label for="editProjectDeadline" class="block text-sm font-medium text-gray-700 mb-1 text-left">Deadline</label>
                        <input type="date" id="editProjectDeadline" name="deadline_proyek" value="{{old('deadline_proyek',$project->deadline_proyek)}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" id="cancelEditProjectBtn" onclick="this.closest('[id^=editProjectModal]').classList.add('hidden')"  class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- edit project modal selesai --}}
                            
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <!-- All Projects Task Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">All Tasks Overview</h2>
                
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtasks</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($proyeks as $project)
                            @foreach($project->task as $task)
                            @php
                                $totalSubtasks = $task->sub_task->count();
                                $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                                $progress = $totalSubtasks > 0 ? round(($completedSubtasks / $totalSubtasks) * 100) : 0;
                                
                                // Get unique team members for this task
                                $teamMembers = collect();
                                foreach($task->sub_task as $subtask) {
                                    if ($subtask->tukang) {
                                        $teamMembers->push($subtask->tukang);
                                    }
                                }
                                $teamMembers = $teamMembers->unique('id');
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $task->nama_task }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <a href="/dashboard/proyek/detail/{{ $project->id }}" class="text-blue-600 hover:text-blue-800">{{ $project->nama_proyek }}</a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $progress }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $completedSubtasks }} of {{ $totalSubtasks }} completed
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex -space-x-2">
                                        @foreach($teamMembers as $member)
                                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" 
                                             src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                             alt="{{ $member->name }}"
                                             title="{{ $member->name }}">
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                        @if(\Carbon\Carbon::parse($task->deadline_task)->isPast() && $progress < 100)
                                        <span class="ml-1 text-xs text-red-500">Overdue</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Project dropdown toggle
        document.getElementById('projectDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('projectDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('projectDropdown');
            const button = document.getElementById('projectDropdownButton');
            
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });


        // Task modal toggle
        const addTaskBtn = document.getElementById('addTaskBtn');
        const addTaskModal = document.getElementById('addTaskModal');
        const cancelTaskBtn = document.getElementById('cancelTaskBtn');
        
        addTaskBtn.addEventListener('click', function() {
            addTaskModal.classList.remove('hidden');
        });
        
        // cancelTaskBtn.addEventListener('click', function() {
        //     addTaskModal.classList.add('hidden');
        // });

function cancelModal(proyekId){
    alert(proyekId)
}
        
        // Edit Project Modal Functions
function openEditModal(id, name, clientId, deadline) {
    const modal = document.getElementById('editProjectModal');
    const form = document.getElementById('editProjectForm');
    
    // Set form action
    // form.action = `/projects/${id}`;
    
    // // Fill form fields
    // document.getElementById('editProjectName').value = name;
    // document.getElementById('editProjectClient').value = clientId;
    // document.getElementById('editProjectDeadline').value = deadline.split(' ')[0]; // Format date properly
    
    // Show modal
    modal.classList.remove('hidden');
}

// Close Edit Modal

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('editProjectModal');
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
});

function confirmDelete() {
                    if (confirm("Apakah Anda yakin ingin Delete Project ini?")) {
                        document.getElementById("DeleteProjectForm").submit();
                    }
                }
    </script>
</x-dashboard-layout>