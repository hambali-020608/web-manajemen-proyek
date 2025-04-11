<x-dashboard-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success_edit'))
        <div id="status-alert-edit" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500 ease-out" role="alert">
            <span class="font-medium">{{session('success_edit')}}</span>
        </div>    
        @endif
            @if(session('success_delete'))
        <div id="status-alert-delete" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500 ease-out" role="alert">
            <span class="font-medium">{{session('success_delete')}}</span>
        </div>    
        @endif
            @if(session('success'))
        <div id="status-alert-delete" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500 ease-out" role="alert">
            <span class="font-medium">{{session('success')}}</span>
        </div>    
        @endif
        <!-- Project Selection Dropdown -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{$selectedProject->nama_proyek}}</h1>
            <div class="relative">
                {{-- {{dd($selectedProject->anggota)}} --}}
                <button id="projectDropdownButton" class="inline-flex justify-between items-center w-64 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                    {{ $selectedProject->nama_proyek }}
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-64 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1 max-h-96 overflow-y-auto">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-700">Select Project</p>
                        </div>
                        <a href="/dashboard/proyek/overview" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
                            <div class="flex justify-between items-center">
                                <span>All Projects</span>
                                    
                                
                            </div>
                        </a>
                        @foreach ($projects as $project)
                        <a href="{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $project->id == $selectedProject->id ? 'bg-blue-50' : '' }}">
                            <div class="flex justify-between items-center">
                                <span>{{ $project->nama_proyek }}</span>
                                @if($project->id == $selectedProject->id)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    Active
                                </span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $selectedProject->task->count() }}</p>
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
                        <p class="text-sm font-medium text-gray-500">Completed Tasks</p>
                        <p class="text-2xl font-semibold text-gray-800">
                            @php
                                $completed = 0;
                                foreach($selectedProject->task as $task) {
                                    $completed += $task->where('status_task', 'done')->count();
                                }
                                echo $completed;
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
                        <p class="text-sm font-medium text-gray-500">Project Deadline</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ \Carbon\Carbon::parse($selectedProject->deadline_proyek)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Project Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                
                <h2 class="text-lg font-semibold text-gray-800">Task Proyek Overview</h2>
                <div class="flex space-x-3">
                    <a href="/dashboard/proyek/detail/{{ $selectedProject->id }}" 
                        class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-2 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 rounded-full">
                         
                         View Project Details
                     </a>

                    <button onclick="openEditModal('{{ $selectedProject->id }}', '{{ $selectedProject->nama_proyek }}', '{{ $selectedProject->klien->id }}', '{{ $selectedProject->deadline_proyek }}')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 rounded-full">
                        Edit Project
                    </button>
                    
                    <form id="DeleteProjectForm" method="POST" action="/proyek/delete/{{$selectedProject->id}}">
                        @csrf
                        @method('DELETE')
                        
                    </form>
                    <button type="button" onclick="confirmDelete()" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Delete Project
                    </button>
                    
                </div>
            
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtasks</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team Members</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($selectedProject->task as $task)
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
                                <a href="/dashboard/proyek/detail/{{$task->proyek->id}}" class="text-sm font-medium text-gray-900">{{ $task->nama_task }}</a>
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
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" alt="{{ $member->name }}">
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- jika ingin edit project --}}
                                {{-- <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
<!-- Edit Project Modal -->
<div id="editProjectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Project</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editProjectForm" method="POST" action="/proyek/update/{{$selectedProject->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editProjectName" class="block text-sm font-medium text-gray-700 mb-1 text-left">Project Name</label>
                        <input type="text" id="editProjectName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="nama_proyek"  value="{{old('nama_proyek',$selectedProject->nama_proyek)}}">
                    </div>
                    
<div class="mb-4">
    <label for="kliens" class="blockx mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Klien</label>
    <select id="kliens" name="id_klien" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach ($kliens as $klien )
    
    <option value="{{ $klien->id }}" {{ $klien->id == $selectedProject->id_klien ? 'selected' : '' }}>{{$klien->name}}</option>
  

  
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
            
        </div>
    </div>

    <script>
        function confirmDelete() {
                    if (confirm("Apakah Anda yakin ingin Delete Project ini?")) {
                        document.getElementById("DeleteProjectForm").submit();
                    }
                }
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

        // Toggle subtask details (optional functionality)
        document.querySelectorAll('[data-toggle-subtasks]').forEach(button => {
            button.addEventListener('click', function() {
                const taskId = this.getAttribute('data-task-id');
                const subtaskDetails = document.getElementById(`subtask-details-${taskId}`);
                subtaskDetails.classList.toggle('hidden');
            });
        });

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

    </script>
</x-dashboard-layout>