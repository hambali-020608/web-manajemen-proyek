<x-dashboard-layout>
    <div class="">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <!-- Project Header -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg dark:bg-gray-800">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Cover Building dan Huruf Timbul</h1>
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
                <!-- Task Card 1 with Subtask -->
                <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pekerjaan Cover Building</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Structural work</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                            In Progress
                        </span>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500 dark:text-gray-400">Progress</span>
                            <span class="font-medium text-gray-900 dark:text-white">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="detail-btn text-sm px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600" data-task="1">
                            Details
                        </button>
                        <button class="text-sm px-3 py-1 bg-blue-100 hover:bg-blue-200 rounded-lg dark:bg-blue-900 dark:hover:bg-blue-800">
                            Update
                        </button>
                    </div>
                    
                    <!-- Subtask Container (Hidden by default) -->
                    <div id="subtask-1" class="hidden mt-4 border-t pt-4">
                        <h4 class="text-md font-medium mb-2 dark:text-white">Subtask:</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm dark:text-gray-300">Pemasangan rangka besi</span>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                <span class="ml-2 text-sm dark:text-gray-300">Pengecatan dasar</span>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm dark:text-gray-300">Pemasangan cover panel</span>
                            </li>
                        </ul>
                        <div class="mt-3 flex">
                            <input type="text" class="flex-grow text-sm p-2 border rounded-l-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Tambah subtask...">
                            <button class="px-3 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">+</button>
                        </div>
                    </div>
                </div>

                <!-- Task Card 2 with Subtask -->
                <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pekerjaan Huruf Timbul Aktifik</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Signage installation</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                            In Progress
                        </span>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500 dark:text-gray-400">Progress</span>
                            <span class="font-medium text-gray-900 dark:text-white">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="detail-btn text-sm px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600" data-task="2">
                            Details
                        </button>
                        <button class="text-sm px-3 py-1 bg-blue-100 hover:bg-blue-200 rounded-lg dark:bg-blue-900 dark:hover:bg-blue-800">
                            Update
                        </button>
                    </div>
                    
                    <!-- Subtask Container (Hidden by default) -->
                    <div id="subtask-2" class="hidden mt-4 border-t pt-4">
                        <h4 class="text-md font-medium mb-2 dark:text-white">Subtask:</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                <span class="ml-2 text-sm dark:text-gray-300">Desain huruf timbul</span>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm dark:text-gray-300">Pembuatan huruf</span>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm dark:text-gray-300">Pengecatan finishing</span>
                            </li>
                            <li class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm dark:text-gray-300">Pemasangan di lokasi</span>
                            </li>
                        </ul>
                        <div class="mt-3 flex">
                            <input type="text" class="flex-grow text-sm p-2 border rounded-l-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Tambah subtask...">
                            <button class="px-3 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Task Modal -->
            <div id="addTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Tambah Task Baru</h3>
                        <div class="mt-2 px-7 py-3">
                            <form method="POST" action="/create-task">
                                @csrf
                                <div class="mb-4">
                                    <label for="taskName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 text-left">Nama Task</label>
                                    <input type="text" id="taskName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" name="nama_task" required>
                                </div>
                                <div class="mb-4">
                                

    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Proyek</label>
    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="id_proyek">
        @foreach ($proyeks as $proyek )
        <option value="{{$proyek->id}}">{{$proyek->nama_proyek}}</option>
            
        @endforeach
      
    </select>
  
  
                                </div>
        
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Task Modal Toggle
            const addTaskBtn = document.getElementById('addTaskBtn');
            const addTaskModal = document.getElementById('addTaskModal');
            const cancelTaskBtn = document.getElementById('cancelTaskBtn');
            
            addTaskBtn.addEventListener('click', function() {
                addTaskModal.classList.remove('hidden');
            });
            
            cancelTaskBtn.addEventListener('click', function() {
                addTaskModal.classList.add('hidden');
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
        });
    </script>
</x-dashboard-layout>