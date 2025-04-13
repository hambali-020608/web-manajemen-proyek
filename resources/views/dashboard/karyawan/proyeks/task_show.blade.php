<x-dashboard-layout>
  {{-- ALERTS --}}
  @if(session('success_update_status'))
  <div id="status-alert" class="mt-5 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400" role="alert">
      <span class="font-medium">{{ session('success_update_status') }}</span>
  </div>
  @endif

  @if(session('success_create_subtask'))
  <div id="status-alert" class="mt-5 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <span class="font-medium">{{ session('success_create_subtask') }}</span>
  </div>
  @endif

  @if(session('success_status_subtask'))
  <div id="status-alert" class="mt-5 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400" role="alert">
      <span class="font-medium">{{ session('success_status_subtask') }}</span>
  </div>
  @endif

  {{-- MODAL TAMBAH SUBTASK --}}
  <div id="subtask-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
          <div class="mt-3 text-center">
              <h3 class="text-lg font-medium text-gray-900">Tambah Subtask Baru</h3>
              <form method="POST" action="/create-subtask" class="mt-4 space-y-4">
                  @csrf
                  <input type="hidden" name="id_task" value="{{ $task->id }}">
                  <div>
                      <label for="nama_sub_task" class="block text-sm font-medium text-gray-700 mb-1">Nama Subtask</label>
                      <input type="text" name="nama_sub_task" id="nama_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                  </div>
                  <div>
                      <label for="id_tukang" class="block text-sm font-medium text-gray-700 mb-1">Ditugaskan ke</label>
                      <select name="id_tukang" id="id_tukang" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                          <option value="">Pilih Tukang</option>
                          @foreach($tukangs as $tukang)
                              <option value="{{ $tukang->id }}">{{ $tukang->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div>
                      <label for="deadline_sub_task" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                      <input type="date" name="deadline_sub_task" id="deadline_sub_task" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                  </div>
                  <div class="flex justify-end space-x-3 pt-4">
                      <button type="button" onclick="closeSubtaskModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</button>
                      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  {{-- DETAIL TASK --}}
  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
      <div class="bg-gradient-to-r bg-blue-600 px-6 py-5">
          <div class="flex justify-between items-center">
              <h1 class="text-2xl font-bold text-white">{{ $task->nama_task }}</h1>
              <div class="flex items-center space-x-4">
                  <form id="status-form" method="POST" action="/task/update-status">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="id_task" value="{{ $task->id }}">
                      <span id="status-text" onclick="toggleSelect('status-text','status-select')" class="px-3 py-1 bg-white bg-opacity-20 text-white text-sm rounded-full cursor-pointer">
                          {{ $task->status_task }}
                      </span>
                      <select name="status_task" id="status-select" class="hidden text-sm rounded px-2 py-1 bg-white text-black" onchange="submitStatusForm('status-form')">
                          <option value="todo" {{ $task->status_task == 'todo' ? 'selected' : '' }}>Todo</option>
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

      <div class="p-6 space-y-6">
          <div class="flex items-start space-x-4">
              <div class="w-1/4">
                  <p class="text-sm font-medium text-gray-500">Proyek</p>
              </div>
              <div class="flex-1">
                  <div class="flex items-center space-x-3">
                      <span class="ml-2 font-medium">{{ $task->proyek->nama_proyek }}</span>
                  </div>
              </div>
          </div>

          <div class="flex items-start space-x-4">
              <div class="w-1/4">
                  <p class="text-sm font-medium text-gray-500">Deadline Task</p>
              </div>
              <div class="flex-1">
                  <span class="ml-2 font-medium">{{ $task->deadline_task }}</span>
              </div>
          </div>

          {{-- SUBTASK TABLE --}}
          <div class="pt-4 border-t border-gray-200">
              <h3 class="text-lg font-medium text-gray-900 mb-4">Subtasks</h3>
              <div class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                          <tr>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Subtask</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deadline</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($task->sub_task as $subtask)
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subtask->nama_sub_task }}</td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <form method="POST" id="form-subtask" action="/subtask/update-status">
                                      @csrf
                                      <input type="hidden" name="id_subtask" value="{{ $subtask->id }}">
                                      <span onclick="toggleSelect('status-text-subtask-{{ $subtask->id }}','status-select-subtask-{{ $subtask->id }}')" id="status-text-subtask-{{ $subtask->id }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                          {{ $subtask->status_sub_task }}
                                      </span>
                                      <select name="status_subtask" id="status-select-subtask-{{ $subtask->id }}" class="hidden text-sm rounded px-2 py-1 bg-white text-black" onchange="submitStatusForm('form-subtask')">
                                          <option value="pending" {{ $subtask->status_sub_task == 'pending' ? 'selected' : '' }}>Pending</option>
                                          <option value="completed" {{ $subtask->status_sub_task == 'completed' ? 'selected' : '' }}>Completed</option>
                                      </select>
                                  </form>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subtask->deadline_sub_task }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              <button onclick="openSubtaskModal()" class="mt-4 flex items-center text-blue-600 hover:text-blue-800 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
                  Tambah Subtask
              </button>
          </div>
      </div>
  </div>

  {{-- SCRIPT --}}
  <script>
      function toggleSelect(statusTextId, selectId) {
          document.getElementById(statusTextId).style.display = 'none';
          document.getElementById(selectId).classList.remove('hidden');
          document.getElementById(selectId).focus();
      }

      function submitStatusForm(formId) {
        const form = document.getElementById(formId)
          form.submit();
      }

      function openSubtaskModal() {
          document.getElementById('subtask-modal').classList.remove('hidden');
      }

      function closeSubtaskModal() {
          document.getElementById('subtask-modal').classList.add('hidden');
      }

      document.addEventListener('DOMContentLoaded', function () {
          const alertBox = document.getElementById('status-alert');
          if (alertBox) {
              setTimeout(() => {
                  alertBox.style.transition = 'opacity 0.5s ease';
                  alertBox.style.opacity = '0';
                  setTimeout(() => alertBox.remove(), 500);
              }, 3000);
          }
      });
  </script>
</x-dashboard-layout>
