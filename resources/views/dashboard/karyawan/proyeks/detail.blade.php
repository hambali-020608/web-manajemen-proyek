<x-dashboard-layout>
    @php
        $completedTasks = $project->task->where('status', 'completed')->count();
        $totalTasks = $project->task->count();
        $progress = $completedTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        
        $tukangs = $project->task->flatMap(function($task) {
            return $task->sub_task->pluck('tukang');
        })->filter()->unique('id');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <!-- Project Header -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="px-6 py-5  bg-blue-500">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $project->nama_proyek }}</h1>
                        <p class="mt-1 text-blue-100 text-sm line-clamp-1">{{ $project->deskripsi_proyek }}</p>
                    </div>
                    <div class="flex items-center space-x-3">    
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ \Carbon\Carbon::parse($project->deadline_proyek)->diffForHumans() }}
                        </span>
                        <a href="/dashboard/proyek/overview/{{$project->id}}" class="text-blue-100 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="space-y-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('M d, Y') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($project->deadline_proyek)->format('M d, Y') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Client</p>
                        <div class="flex items-center">
                            <img class="h-6 w-6 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode($project->klien->name) }}&background=random" alt="{{ $project->klien->name }}">
                            <p class="font-semibold text-gray-900">{{ $project->klien->name }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</p>
                        <div class="flex items-center space-x-2">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $progress }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Task List -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Task Cards Section -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Project Tasks</h2>
                        <button id="addTaskBtn" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Task
                        </button>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($project->task as $task)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex justify-between items-start">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $task->nama_task }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Deadline: {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full whitespace-nowrap
                                    {{ $task->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    @foreach($task->sub_task->take(3)->pluck('tukang')->filter() as $member)
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                         alt="{{ $member->name }}"
                                         title="{{ $member->name }}">
                                    @endforeach
                                    @if($task->sub_task->pluck('tukang')->filter()->count() > 3)
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-xs font-medium text-gray-600 ring-2 ring-white">
                                        +{{ $task->sub_task->pluck('tukang')->filter()->count() - 3 }}
                                    </span>
                                    @endif
                                </div>
                                <button onclick="toggleSubtask({{$task->id}})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View Subtasks
                                </button>
                            </div>
                            
                            <!-- Subtask Section -->
                            <div id="subtask-{{$task->id}}" class="hidden mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="text-sm font-medium text-gray-700">Subtasks</h4>
                                    <button onclick="openAddSubtaskModal({{$task->id}})" class="flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Subtask
                                    </button>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach ($task->sub_task as $subtask)
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 pt-1">
                                            <input type="checkbox" {{ $subtask->status_sub_task == 'completed' ? 'checked' : '' }} 
                                                   class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">{{$subtask->nama_sub_task}}</p>
                                            <div class="flex items-center mt-1">
                                                @if($subtask->tukang)
                                                <img class="h-5 w-5 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode($subtask->tukang->name) }}&background=random" alt="{{ $subtask->tukang->name }}">
                                                <span class="text-xs text-gray-500">{{ $subtask->tukang->name }}</span>
                                                @else
                                                <span class="text-xs text-gray-500">Unassigned</span>
                                                @endif
                                                <span class="mx-2 text-gray-300">•</span>
                                                <span class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($subtask->deadline_sub_task)->format('M d, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full 
                                            {{ $subtask->status_sub_task == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($subtask->status_sub_task) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Task Table Section -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Task Overview</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Task Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Progress
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deadline
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($project->task as $task)
                                @php
                                    $totalSubtasks = $task->sub_task->count();
                                    $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                                    $progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{$task->nama_task}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$progress}}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-500">{{round($progress)}}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $progress == 100 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $progress == 100 ? 'Completed' : 'In Progress' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <form id="DeleteTaskForm-{{$task->id}}" action="/task/delete/{{$task->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button onclick="openEditModal(
                                            '{{$task->id}}', 
                                            '{{ addslashes($task->nama_task) }}', 
                                            '{{$task->proyek->id}}', 
                                            '{{$task->deadline_task}}'
                                        )" class="text-blue-600 hover:text-blue-900">
                                            Edit
                                        </button>
                                        <button onclick="if(confirm('Are you sure you want to delete this task?')) document.getElementById('DeleteTaskForm-{{$task->id}}').submit()" 
                                                class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Team Members -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Team Members</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($tukangs as $member)
                        <div class="px-6 py-4 flex items-center">
                            <img class="h-10 w-10 rounded-full mr-4" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                 alt="{{ $member->name }}">
                            <div>
                                <p class="font-medium text-gray-900">{{ $member->name }}</p>
                                <p class="text-sm text-gray-500">{{ $member->role ?? 'Team Member' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Project Timeline -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Project Timeline</h2>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Project Kickoff</h4>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('M d, Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Project Deadline</h4>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($project->deadline_proyek)->format('M d, Y') }}</p>
                                </div>
                            </div>
{{--                             
                            @foreach($project->milestones ?? [] as $milestone)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full {{ $milestone->completed ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $milestone->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($milestone->date)->format('M d, Y') }}</p>
                                    @if($milestone->completed)
                                    <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Task Modal -->
    <div id="addTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 transition-opacity">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Add New Task</h3>
                    <button onclick="document.getElementById('addTaskModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-4">
                    <form method="POST" action="/create-task" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                            <input type="text" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                            <select name="id_proyek" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                @foreach ($proyeks as $proyek)
                                <option value="{{$proyek->id}}">{{$proyek->nama_proyek}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="datetime-local" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="document.getElementById('addTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Save Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 transition-opacity">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Edit Task</h3>
                    <button onclick="document.getElementById('editTaskModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-4">
                    <form id="editTaskForm" method="POST" action="" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                            <input type="text" id="editTaskName" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                            <select id="editTaskProject" name="id_proyek" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                @foreach ($proyeks as $proyek)
                                <option value="{{$proyek->id}}">{{$proyek->nama_proyek}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="datetime-local" id="editTaskDeadline" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="document.getElementById('editTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Subtask Modal -->
    <div id="addSubTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 transition-opacity">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Add New Subtask</h3>
                    <button onclick="document.getElementById('addSubTaskModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-4">
                    <form method="POST" action="/create-subtask" class="space-y-4">
                        @csrf
                        <input type="hidden" id="subtaskTaskId" name="id_task">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subtask Name</label>
                            <input type="text" name="nama_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assigned To</label>
                            <select name="id_tukang" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Unassigned</option>
                                @foreach ($tukangs as $tukang)
                                <option value="{{$tukang->id}}">{{$tukang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="date" name="deadline_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="document.getElementById('addSubTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Save Subtask
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add Task Modal Toggle
            const addTaskBtn = document.getElementById('addTaskBtn');
            const addTaskModal = document.getElementById('addTaskModal');
            
            addTaskBtn.addEventListener('click', function() {
                addTaskModal.classList.remove('hidden');
            });
        });

        function toggleSubtask(taskId) {
            const subtaskRow = document.getElementById(`subtask-${taskId}`);
            subtaskRow.classList.toggle('hidden');
        }

        function openEditModal(taskId, taskName, projectId, deadline) {
            const modal = document.getElementById('editTaskModal');
            const form = document.getElementById('editTaskForm');
            
            // Update form action
            form.action = `/task/update/${taskId}`;
            
            // Fill form fields
            document.getElementById('editTaskName').value = taskName;
            document.getElementById('editTaskProject').value = projectId;
            
            // Format deadline for datetime-local input
            const deadlineDate = new Date(deadline);
            const formattedDeadline = deadlineDate.toISOString().slice(0, 16);
            document.getElementById('editTaskDeadline').value = formattedDeadline;
            
            modal.classList.remove('hidden');
        }

        function openAddSubtaskModal(taskId) {
            const modal = document.getElementById('addSubTaskModal');
            document.getElementById('subtaskTaskId').value = taskId;
            modal.classList.remove('hidden');
        }
    </script>
</x-dashboard-layout>