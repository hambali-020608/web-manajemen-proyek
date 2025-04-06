<x-dashboard-layout>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <!-- Project Dropdown and Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="relative inline-block text-left">
                <button type="button" id="projectDropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700">
                    All Projects
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="projectDropdown" class="hidden origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 dark:ring-gray-600 z-50">
                    <div class="py-1 max-h-96 overflow-y-auto">
                        @foreach ($proyeks as $project)
                        <a href="/dashboard/proyek/task/{{$project->id}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                            {{$project->nama_proyek}}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <button id="addTaskBtn" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Task
            </button>
        </div>

        <!-- Tasks Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow dark:bg-gray-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Task Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Project
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Progress
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Deadline
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Actions
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Subtask
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($tasks as $task)
                    @php
                        $totalSubtasks = $task->sub_task->count();
                        $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                        $progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{$task->nama_task}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{$task->proyek->nama_proyek}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$progress}}%"></div>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{round($progress)}}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $progress == 100 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                {{ $progress == 100 ? 'Completed' : 'In Progress' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        
                            <button onclick="openEditModal(
                                '{{$task->id}}', 
                                '{{ addslashes($task->nama_task) }}', 
                                '{{$task->proyek->id}}', 
                                '{{$task->deadline_task}}'
                            )" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Edit
                            </button>
                            <button onclick="openEditModal(
                                '{{$task->id}}', 
                                '{{ addslashes($task->nama_task) }}', 
                                '{{$task->proyek->id}}', 
                                '{{$task->deadline_task}}'
                            )" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                Delete
                            </button>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap justify-center">
                            <button onclick="toggleSubtask({{$task->id}})" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Open Subtasks
                            </button>
                        </td>
                    </tr>


                    <!-- Subtask Row -->
                    <tr id="subtask-{{$task->id}}" class="hidden bg-gray-50 dark:bg-gray-700">
                        <td colspan="6" class="px-6 py-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Subtasks</h4>
                                <button onclick="openAddSubtaskModal({{$task->id}})" class="flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Subtask
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-600">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 dark:text-gray-300">Name</th>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 dark:text-gray-300">Assigned To</th>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 dark:text-gray-300">Status</th>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 dark:text-gray-300">Deadline</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task->sub_task as $subtask)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{$subtask->nama_sub_task}}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                                @if($subtask->tukang)
                                                <div class="flex items-center">
                                                    <img class="w-6 h-6 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode($subtask->tukang->name) }}&background=random" alt="{{ $subtask->tukang->name }}">
                                                    {{ $subtask->tukang->name }}
                                                </div>
                                                @else
                                                Unassigned
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $subtask->status_sub_task == 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                                    {{ ucfirst($subtask->status_sub_task) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($subtask->deadline_sub_task)->format('M d, Y') }}
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add Task Modal -->
        <div id="addTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Add New Task</h3>
                    <div class="mt-2 px-7 py-3">
                        <form method="POST" action="/create-task">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Task Name</label>
                                <input type="text" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Project</label>
                                <select name="id_proyek" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach ($proyeks as $proyek)
                                    <option value="{{$proyek->id}}">{{$proyek->nama_proyek}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deadline</label>
                                <input type="datetime-local" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="flex justify-end space-x-3 mt-4">
                                <button type="button" onclick="document.getElementById('addTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:text-white">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div id="editTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Edit Task</h3>
                    <div class="mt-2 px-7 py-3">
                        <form id="editTaskForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Task Name</label>
                                <input type="text" id="editTaskName" name="nama_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Project</label>
                                <select id="editTaskProject" name="id_proyek" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach ($proyeks as $proyek)
                                    <option value="{{$proyek->id}}">{{$proyek->nama_proyek}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deadline</label>
                                <input type="date" id="editTaskDeadline" name="deadline_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="flex justify-end space-x-3 mt-4">
                                <button type="button" onclick="document.getElementById('editTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:text-white">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Subtask Modal -->
        <div id="addSubTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Add New Subtask</h3>
                    <div class="mt-2 px-7 py-3">
                        <form method="POST" action="/create-subtask">
                            @csrf
                            <input type="hidden" id="subtaskTaskId" name="id_task">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Subtask Name</label>
                                <input type="text" name="nama_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Assigned To</label>
                                <select name="id_tukang" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Unassigned</option>
                                    @foreach ($tukangs as $tukang)
                                    <option value="{{$tukang->id}}">{{$tukang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deadline</label>
                                <input type="date" name="deadline_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="flex justify-end space-x-3 mt-4">
                                <button type="button" onclick="document.getElementById('addSubTaskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:text-white">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Project Dropdown Toggle
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

            // Task Modal Toggle
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
            document.getElementById('editTaskDeadline').value = deadline.split(' ')[0];
            
            modal.classList.remove('hidden');
        }

        function openAddSubtaskModal(taskId) {
            const modal = document.getElementById('addSubTaskModal');
            document.getElementById('subtaskTaskId').value = taskId;
            modal.classList.remove('hidden');
        }
    </script>
</x-dashboard-layout>