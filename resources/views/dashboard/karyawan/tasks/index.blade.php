<x-dashboard-layout>

    <div class="">
        <div class="relative">
            <button id="projectDropdownButton" class="inline-flex justify-between items-center w-64 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                {{-- {{ $selectedProject->nama_proyek }} --}}
                Select Project
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            
            

            <div id="projectDropdown" class="hidden absolute left-0 mt-2 w-64 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                <div class="py-1 max-h-96 overflow-y-auto">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-700">Select Project</p>
                    </div>
                    <a href="/dashboard/task/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
                        <div class="flex justify-between items-center">
                            <span>All proyek</span>
                            {{-- @if($project->id == $selectedProject->id)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                Active
                            </span>
                            @endif --}}
                        </div>
                    </a>
                    @foreach ($proyeks as $project)
                    <a href="/dashboard/task/proyek/{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
                        <div class="flex justify-between items-center">
                            <span>{{ $project->nama_proyek }}</span>
                            {{-- @if($project->id == $selectedProject->id)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                Active
                            </span>
                            @endif --}}
                        </div>
                    </a>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <!-- Kanban Board Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Task Kanban</h1>
                
            </div>

            <!-- Kanban Columns -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- To Do Column -->
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Task To Do</h2>
                        <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium px-2.5 py-0.5 rounded-full">3</span>
                    </div>
                    
                    <!-- Task Cards -->
                    <div class="space-y-4">
                        <!-- Task 1 -->
                        @foreach ($tasks_todo as $todo )
                        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{$todo->nama_task}}</h3>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">To Do</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{$todo->proyek->nama_proyek}}</p>
                            <div class="mt-3">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500 dark:text-gray-400">Progress</span>
                                    <span class="font-medium text-gray-900 dark:text-white">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-600">
                                    <div class="bg-red-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        
                        
                    </div>
                </div>

                <!-- In Progress Column -->
                
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">In Progress</h2>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">6</span>
                    </div>
                    
                    <!-- Task Cards -->
                    <div class="space-y-4">
                        
                        @foreach ( $tasks_progress as $progress )
                        @php
                        $totalSubtasks = $progress->sub_task->count();
                        $completedSubtasks = $progress->sub_task->where('status_sub_task', 'completed')->count();
                        $percent_progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
                    @endphp
                        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <div class="flex justify-between items-start">
                                
                                <h3 class="font-medium text-gray-900 dark:text-white">{{$progress->nama_task}}</h3>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">In Progress</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{$progress->proyek->nama_proyek}}</p>
                            <div class="mt-3">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500 dark:text-gray-400">Progress</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{$percent_progress}}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-600">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{$percent_progress}}%"></div>
                                </div>
                            </div>
                        </div>

                        @endforeach  
                    </div>
                </div>

                <!-- Completed Column -->
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h2>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">1</span>
                    </div>
                    
                    <!-- Task Cards -->
                    <div class="space-y-4">
                        @foreach ($tasks_done as $done )
                        
                        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{$done->nama_task}}</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Completed</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{$done->proyek->nama_proyek}}</p>
                            <div class="mt-3">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500 dark:text-gray-400">Progress</span>
                                    <span class="font-medium text-gray-900 dark:text-white">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-600">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                            
                        @endforeach
                        <!-- Task 1 -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div id="taskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Tambah Task Baru</h3>
                <div class="mt-4">
                    <form>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Nama Task</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Deskripsi</label>
                            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" rows="3"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Status</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="todo">To Do</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" onclick="document.getElementById('taskModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle modal
        document.querySelector('button.bg-blue-600').addEventListener('click', function() {
            document.getElementById('taskModal').classList.remove('hidden');
        });
        document.getElementById('projectDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('projectDropdown');
            dropdown.classList.toggle('hidden');
        });


        // Drag and drop functionality would go here
        // You might want to use a library like SortableJS for this
    </script>
</x-dashboard-layout>