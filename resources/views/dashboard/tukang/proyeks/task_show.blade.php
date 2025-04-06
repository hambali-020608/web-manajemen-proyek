<x-dashboard-layout>
    @php
        $tukang = auth('tukangs')->user()->load('subTask');
    @endphp
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
                </div>
            </div>

            <!-- Task Progress Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @foreach ($proyek->task as $task)
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
                            <span class="font-medium text-gray-900 dark:text-white">{{round($progress)}}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$progress}}%"></div>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="detail-btn text-sm px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600" data-task="{{$task->id}}">
                            Details
                        </button>
                    </div>

                    @php
                        $subtasks = $task->sub_task->where('id_tukang', auth('tukangs')->user()->id);
                    @endphp

                    <!-- Subtask Container (Hidden by default) -->
                    <div id="subtask-{{$task->id}}" class="hidden mt-4 border-t pt-4">
                        <h4 class="text-md font-medium mb-2 dark:text-white">Subtask:</h4>
                        <ul class="space-y-2">
                            @foreach ($subtasks as $subtask)
                            <li class="flex items-center">
                                <form method="POST" action="/subtask/update-status" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="id_subtask" value="{{$subtask->id}}">
                                    <input type="checkbox" 
                                           onchange="this.form.submit()"
                                           name="is_checked"
                                           class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" 
                                           {{ $subtask->status_sub_task == 'completed' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm dark:text-gray-300">{{$subtask->nama_sub_task}}</span>
                                </form>
                            </li>
                            @endforeach
                    
                        </ul>
                    </div>
                </div>
                @endforeach
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
                        this.textContent = 'Details';
                    } else {
                        this.textContent = 'Sembunyikan';
                    }
                });
            });

            // Handle checkbox changes
            
        });
    </script>
</x-dashboard-layout>