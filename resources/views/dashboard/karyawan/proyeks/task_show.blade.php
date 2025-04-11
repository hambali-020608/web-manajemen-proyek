<x-dashboard-layout>
    @if(session('success_update_status'))

    <div id="status-alert" class="mt-5 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">{{session('success_update_status')}}</span>
      </div>    
        
    @endif
   
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r bg-blue-600 px-6 py-5">
            <div class="flex justify-between items-center">
              <h1 class="text-2xl font-bold text-white">{{$task->nama_task}}</h1>
              <div class="flex items-center space-x-4">
                <form id="status-form" method="POST" action="/task/update-status">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_task" value="{{$task->id}}">
                
                    <span id="status-text" 
                          onclick="toggleSelect()" 
                          class="px-3 py-1 bg-white bg-opacity-20 text-white text-sm rounded-full cursor-pointer">
                        {{ $task->status_task }}
                    </span>
                
                    <select name="status_task" id="status-select" class="hidden text-sm rounded px-2 py-1 bg-white text-black"
                            onchange="submitStatusForm()">
                        <option value="todo" {{ $task->status_task == 'Not Started' ? 'selected' : '' }}>Todo</option>
                        <option value="in_progress" {{ $task->status_task == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $task->status_task == 'done' ? 'selected' : '' }}>Completed</option>
                    </select>
                </form>
                
                <button onclick="history.back()" class="text-white hover:text-blue-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        
        <!-- Content -->
        <div class="p-6 space-y-6">
          <!-- Project Section -->
          <div class="flex items-start space-x-4">
            <div class="w-1/4">
              <p class="text-sm font-medium text-gray-500">Proyek</p>
            </div>
            <div class="flex-1">
              <div class="flex items-center space-x-3">
                <label class="inline-flex items-center">
                  <span class="ml-2 font-medium">{{$task->proyek->nama_proyek}}</span>
                </label>
              </div>
            </div>
          </div>
      
          <!-- Deadline Section -->
          <div class="flex items-start space-x-4">
            <div class="w-1/4">
              <p class="text-sm font-medium text-gray-500">Deadline Task</p>
            </div>
            <div class="flex-1">
              <div class="flex items-center space-x-3">
                <span class="ml-2 font-medium">{{$task->deadline_task}}</span>
              </div>
            </div>
          </div>
      
          <!-- Priority Section -->
          <div class="flex items-start space-x-4">
            <div class="w-1/4">
              <p class="text-sm font-medium text-gray-500">Prioritas</p>
            </div>
            <div class="flex-1">
              <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                Rendah
              </span>
            </div>
          </div>

          <!-- Subtask Table -->
          <div class="pt-4 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Subtasks</h3>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Subtask</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <!-- Contoh 1 row subtask -->
                  @foreach ($task->sub_task as $subtask )
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$subtask->nama_sub_task}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        {{$subtask->status_sub_task}}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$subtask->deadline_sub_task}}</td>
                  </tr>                      
                  @endforeach

                </tbody>
              </table>
            </div>
            <button class="mt-4 flex items-center text-blue-600 hover:text-blue-800 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Tambah Subtask
            </button>
          </div>
      
          <!-- Actions -->
          <div class="pt-4 flex justify-end space-x-3 border-t border-gray-200">

          </div>
        </div>
      </div>
      <script>
        function toggleSelect() {
          document.getElementById('status-text').style.display = 'none';
          document.getElementById('status-select').classList.remove('hidden');
          document.getElementById('status-select').focus();
        }
      
        function submitStatusForm() {
          document.getElementById('status-form').submit();
        }
        document.addEventListener('DOMContentLoaded', function () {
    const alertBox = document.getElementById('status-alert');
    if (alertBox) {
      // Hilangkan elemen setelah 3 detik (3000ms)
      setTimeout(() => {
        alertBox.style.transition = 'opacity 0.5s ease';
        alertBox.style.opacity = '0';
        setTimeout(() => alertBox.remove(), 500); // Hapus dari DOM setelah fade out
      }, 3000);
    }
  });
      </script>
</x-dashboard-layout>