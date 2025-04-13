<x-dashboard-layout>
    <!-- Flash Messages -->
    @php
    $statusClass = '';
    if (session('success_task') || session('success_create_subtask')) {
        $statusClass = 'text-green-800 bg-green-50';
    } elseif (session('success_update_status') || session('success_update_task')) {
        $statusClass = 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400';
    } elseif (session('success_delete_task')) {
        $statusClass = 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400';
    }
    elseif (session('success_status_subtask')) {
        $statusClass = 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400';
    }

    $statusMessage = session('success_task') ??
                     session('success_update_status') ??
                     session('success_update_task') ??
                     session('success_create_subtask') ??
                     session('success_status_subtask') ??
                     session('success_delete_task');
@endphp

@if($statusMessage)
    <div id="status-alert"
         class="p-4 mb-4 text-sm rounded-lg transition-opacity duration-500 ease-out {{ $statusClass }}"
         role="alert">
        <span class="font-medium">
            {{ $statusMessage }}
        </span>
    </div>
@endif
    @php
        $completedTasks = $project->task->where('status_task', 'done')->count();
        $totalTasks = $project->task->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        
        $tukangs = $project->task->flatMap(function($task) {
            return $task->sub_task->pluck('tukang');
        })->filter()->unique('id');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <!-- Project Header -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="px-6 py-5 bg-gradient-to-r bg-blue-500">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="min-w-0">
                        <h1 class="text-2xl font-bold text-white truncate">{{ $project->nama_proyek }}</h1>
                        <p class="mt-1 text-blue-100 text-sm line-clamp-1">{{ $project->deskripsi_proyek }}</p>
                    </div>
                    <div class="flex items-center space-x-3 flex-shrink-0">    
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
                            <p class="font-semibold text-gray-900 truncate">{{ $project->klien->name }}</p>
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
                        @forelse($project->task as $task)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex justify-between items-start">
                                <div class="flex-1 min-w-0">
                                    <a class="text-lg font-semibold text-blue-600 hover:text-blue-800 truncate" href="/dashboard/task/detail/{{$task->id}}">{{ $task->nama_task }}</a>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Deadline: {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                    </p>
                                </div>
                                <form id="status-form-{{$task->id}}" method="POST" action="/task/update-status" class="relative">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id_task" value="{{$task->id}}">
                                    <span id="status-text-{{$task->id}}" class="px-2 py-1 text-xs font-medium rounded-full whitespace-nowrap cursor-pointer
                                        {{ $task->status_task == 'done' ? 'bg-green-100 text-green-800' : 
                                          ($task->status_task == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}"
                                        onclick="toggleSelect('{{$task->id}}')">
                                        {{ ucfirst(str_replace('_', ' ', $task->status_task)) }}
                                    </span>
                                    <select name="status_task" id="status-select-{{$task->id}}" class="hidden absolute right-0 mt-1 text-sm rounded px-2 py-1 bg-white border border-gray-300 shadow-lg z-10"
                                        onchange="document.getElementById('status-form-{{$task->id}}').submit()">
                                        <option value="todo" {{ $task->status_task == 'todo' ? 'selected' : '' }}>Todo</option>
                                        <option value="in_progress" {{ $task->status_task == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="done" {{ $task->status_task == 'done' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
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
                                <button onclick="toggleSubtask('{{$task->id}}')" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View Subtasks
                                </button>
                            </div>
                            
                            <!-- Subtask Section -->
                            <div id="subtask-{{$task->id}}" class="hidden mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="text-sm font-medium text-gray-700">Subtasks</h4>
                                    <button onclick="openAddSubtaskModal('{{$task->id}}')" class="flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Subtask
                                    </button>
                                </div>
                                
                                <div class="space-y-3">
                                    @forelse ($task->sub_task as $subtask)
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex-shrink-0 pt-1">
                                           
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
                                        <form id="status-form-subtask-{{$subtask->id}}" method="POST" action="/subtask/update-status" class="relative">
                                            @csrf
                                            <input type="hidden" name="id_subtask" value="{{$subtask->id}}">
                                            <span id="status-text-subtask-{{$subtask->id}}" class="px-2 py-0.5 text-xs font-medium rounded-full cursor-pointer
                                                {{ $subtask->status_sub_task == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}"
                                                onclick="toggleSelect('subtask-{{$subtask->id}}')">
                                                {{ ucfirst($subtask->status_sub_task) }}
                                            </span>
                                            <select name="status_subtask" id="status-select-subtask-{{$subtask->id}}" class="hidden absolute right-0 mt-1 text-sm rounded px-2 py-1 bg-white border border-gray-300 shadow-lg z-10"
                                                onchange="document.getElementById('status-form-subtask-{{$subtask->id}}').submit()">
                                                <option value="pending" {{ $subtask->status_sub_task == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $subtask->status_sub_task == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>
                                    </div>
                                    @empty
                                    <div class="text-center py-4 text-gray-500">
                                        No subtasks yet. Add one to get started.
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-6 text-center text-gray-500">
                            No tasks yet. Add one to get started.
                        </div>
                        @endforelse
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
                                @forelse ($project->task as $task)
                                @php
                                    $totalSubtasks = $task->sub_task->count();
                                    $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                                    $progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/dashboard/task/detail/{{$task->id}}" class="text-sm font-medium text-blue-600 hover:text-blue-800">{{$task->nama_task}}</a>
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
                                            {{ $task->status_task == 'done' ? 'bg-green-100 text-green-800' : 
                                              ($task->status_task == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status_task)) }}
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
                                        <button onclick="confirmDelete('{{$task->id}}', '{{ addslashes($task->nama_task) }}')" 
                                                class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No tasks found for this project.
                                    </td>
                                </tr>
                                @endforelse
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
                        @forelse($tukangs as $member)
                        <div class="px-6 py-4 flex items-center">
                            <img class="h-10 w-10 rounded-full mr-4" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                 alt="{{ $member->name }}">
                            <div class="min-w-0">
                                <p class="font-medium text-gray-900 truncate">{{ $member->name }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ $member->role ?? 'Team Member' }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-4 text-center text-gray-500">
                            No team members assigned yet.
                        </div>
                        @endforelse
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
                    <button onclick="closeModal('addTaskModal')" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-4">
                    <form method="POST" action="/create-task" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id_proyek" value="{{$project->id}}">
                        <div>
                            <label for="task-name" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                            <input type="text" id="task-name" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="task-deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="datetime-local" id="task-deadline" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="closeModal('addTaskModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
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
                    <button onclick="closeModal('editTaskModal')" class="text-gray-400 hover:text-gray-500">
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
                            <label for="edit-task-name" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                            <input type="text" id="edit-task-name" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-task-deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="datetime-local" id="edit-task-deadline" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="closeModal('editTaskModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
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
                    <button onclick="closeModal('addSubTaskModal')" class="text-gray-400 hover:text-gray-500">
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
                            <label for="subtask-name" class="block text-sm font-medium text-gray-700 mb-1">Subtask Name</label>
                            <input type="text" id="subtask-name" name="nama_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subtask-assignee" class="block text-sm font-medium text-gray-700 mb-1">Assigned To</label>
                            <select id="subtask-assignee" name="id_tukang" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Unassigned</option>
                                @foreach ($tukangs as $tukang)
                                <option value="{{$tukang->id}}">{{$tukang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="subtask-deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                            <input type="date" id="subtask-deadline" name="deadline_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="closeModal('addSubTaskModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
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
        // Flash message auto-hide
        setTimeout(() => {
            const alert = document.getElementById('status-alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        // Status dropdown functions
        function toggleSelect(taskId) {
            document.getElementById(`status-text-${taskId}`).style.display = 'none';
            const select = document.getElementById(`status-select-${taskId}`);
            select.classList.remove('hidden');
            select.focus();
        }

        // Close any modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Toggle subtask visibility
        function toggleSubtask(taskId) {
            const subtaskRow = document.getElementById(`subtask-${taskId}`);
            subtaskRow.classList.toggle('hidden');
        }

        // Open edit task modal
        function openEditModal(taskId, taskName, projectId, deadline) {
            const modal = document.getElementById('editTaskModal');
            const form = document.getElementById('editTaskForm');
            
            // Update form action
            form.action = `/task/update/${taskId}`;
            
            // Fill form fields
            document.getElementById('edit-task-name').value = taskName;
            
            // Format deadline for datetime-local input
            const deadlineDate = new Date(deadline);
            const formattedDeadline = deadlineDate.toISOString().slice(0, 16);
            document.getElementById('edit-task-deadline').value = formattedDeadline;
            
            modal.classList.remove('hidden');
        }

        // Open add subtask modal
        function openAddSubtaskModal(taskId) {
            const modal = document.getElementById('addSubTaskModal');
            document.getElementById('subtaskTaskId').value = taskId;
            modal.classList.remove('hidden');
        }

        // Confirm task deletion
        function confirmDelete(taskId, taskName) {
            if (confirm(`Are you sure you want to delete task "${taskName}"?`)) {
                document.getElementById(`DeleteTaskForm-${taskId}`).submit();
            }
        }

        // Initialize modals
        document.addEventListener('DOMContentLoaded', function() {
            // Add Task Modal Toggle
            const addTaskBtn = document.getElementById('addTaskBtn');
            if (addTaskBtn) {
                addTaskBtn.addEventListener('click', function() {
                    document.getElementById('addTaskModal').classList.remove('hidden');
                });
            }

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                ['addTaskModal', 'editTaskModal', 'addSubTaskModal'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && event.target === modal) {
                        closeModal(modalId);
                    }
                });
            });
        });
    </script>
</x-dashboard-layout>