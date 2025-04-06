<x-dashboard-layout>
    @php
        $klien = auth('kliens')->user()->load('proyek');
        $proyeks = $klien->proyek;
    @endphp

<div class="relative inline-block">
    <button id="projectDropdownButton" class="flex items-center justify-between px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:text-white">
        <span class="truncate max-w-xs">{{ $selectedProject->nama_proyek }}</span>
        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50 dark:bg-gray-800 dark:ring-gray-600">
        <div class="py-1 max-h-96 overflow-y-auto">
            <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Proyek Aktif</p>
            </div>
            @foreach ($proyeks as $project)
            <a href="{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 {{ $selectedProject->id == $project->id ? 'bg-blue-50 dark:bg-gray-700' : '' }}">
                <div class="flex justify-between items-center">
                    <span>{{ $project->nama_proyek }}</span>
                    @if($selectedProject->id == $project->id)
                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    @endif
                </div>
            </a>
            @endforeach
            
            <div class="px-4 py-2 border-t border-gray-100 dark:border-gray-700">
                <a href="/dashboard/proyek/create" class="flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Buat Proyek Baru
                </a>
            </div>
        </div>
    </div>
</div>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <!-- Project Header -->
        
        
        <!-- Project Dropdown -->
        
        <div class="mb-6 p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{$selectedProject->nama_proyek}}</h1>
                </div>
                <div class="flex space-x-3">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $selectedProject->status_proyek ?? 'Active' }}
                    </span>
                    
                </div>
            </div>

            <!-- Project Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="p-4 bg-blue-50 rounded-lg dark:bg-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Total Tasks</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $selectedProject->task->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-green-50 rounded-lg dark:bg-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Completed</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $selectedProject->task->flatMap->sub_task->where('status_sub_task', 'completed')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-orange-50 rounded-lg dark:bg-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 text-orange-600 dark:bg-orange-800 dark:text-orange-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Deadline</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $selectedProject->deadline_proyek ? \Carbon\Carbon::parse($selectedProject->deadline_proyek)->format('d M Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Progress Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach ($selectedProject->task as $task)
            @php
                $totalSubtasks = $task->sub_task->count();
                $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
                $progress = $totalSubtasks > 0 ? round(($completedSubtasks / $totalSubtasks) * 100) : 0;
                $statusColor = $progress == 100 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                ($progress > 50 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300');
            @endphp
            
            <div class="relative p-6 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 dark:bg-gray-800 dark:border-gray-700">
                <!-- Progress Badge -->
                <div class="absolute top-4 right-4">
                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusColor }}">
                        {{ $progress }}%
                    </span>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $task->nama_task }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Deadline: {{ $task->deadline_task ? \Carbon\Carbon::parse($task->deadline_task)->format('d M Y') : 'No deadline' }}
                    </p>
                </div>
                
                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500 dark:text-gray-400">Progress</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $completedSubtasks }} of {{ $totalSubtasks }} tasks</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                        <div class="h-2 rounded-full {{ $progress == 100 ? 'bg-green-600' : ($progress > 50 ? 'bg-blue-600' : 'bg-yellow-500') }}" 
                             style="width: {{ $progress }}%"></div>
                    </div>
                </div>
                
                <!-- Subtask Preview -->
                <div class="space-y-2 mb-4">
                    @foreach($task->sub_task->take(3) as $subtask)
                    <div class="flex items-center">
                        
                        <span class="ml-2 text-sm {{ $subtask->status_sub_task == 'completed' ? 'line-through text-gray-400' : 'text-gray-700 dark:text-gray-300' }}">
                            {{ $subtask->nama_sub_task }}
                        </span>
                    </div>
                    @endforeach
                    
                    @if($task->sub_task->count() > 3)
                    <div class="text-sm text-blue-600 dark:text-blue-400">
                        +{{ $task->sub_task->count() - 3 }} more subtasks
                    </div>
                    @endif
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-between border-t border-gray-200 pt-4 dark:border-gray-700">
                    
                    <div class="flex space-x-2">
                        
                        <button class="text-sm px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg dark:bg-green-900/30 dark:hover:bg-green-900/50 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Complete
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Add Task Modal -->
    <script>
        // Dropdown toggle script
        document.getElementById('projectDropdownButton').addEventListener('click', function() {
            document.getElementById('projectDropdown').classList.toggle('hidden');
        });
    
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('projectDropdown');
            const button = document.getElementById('projectDropdownButton');
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</x-dashboard-layout>