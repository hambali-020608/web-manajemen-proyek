<x-dashboard-layout>
   <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1>
      {{-- {{dd($done_proyeks)}} --}}
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

          <!-- Task Selesai -->
          <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
              <div class="flex justify-between items-center">
                  <div>
                      <p class="text-gray-500">Task Selesai</p>
                      <h3 class="text-2xl font-bold text-gray-800">{{$done_tasks}}</h3>
                  </div>
                  <div class="bg-primary bg-opacity-10 p-3 rounded-full">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                  </div>
              </div>
          </div>
          
          <!-- Task Baru -->
          <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-warning">
              <div class="flex justify-between items-center">
                  <div>
                      <p class="text-gray-500">Task Baru</p>
                      <h3 class="text-2xl font-bold text-gray-800">{{$new_tasks_count}}</h3>
                  </div>
                  <div class="bg-warning bg-opacity-10 p-3 rounded-full">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                      </svg>
                  </div>
              </div>
          </div>
          
          <!-- Proyek Selesai -->
          <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-success">
              <div class="flex justify-between items-center">
                  <div>
                      <p class="text-gray-500">Proyek Selesai</p>
                      <h3 class="text-2xl font-bold text-gray-800">{{$done_proyeks}}</h3>
                  </div>
                  <div class="bg-success bg-opacity-10 p-3 rounded-full">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                      </svg>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Task Baru Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
          <div class="flex justify-between items-center mb-6">
              <h2 class="text-xl font-bold text-gray-800">Task Baru</h2>
              <span class="bg-primary text-white text-xs font-medium px-2.5 py-0.5 rounded-full">{{$new_tasks_count}}</span>
          </div>
          
          <!-- Task List -->
          <div class="space-y-4">
              <!-- Task 1 -->
              @foreach ($tasks as $task )
              @php
    $totalSubtasks = $task->sub_task->count();
    $completedSubtasks = $task->sub_task->where('status_sub_task', 'completed')->count();
    $progress = $totalSubtasks > 0 ? ($completedSubtasks / $totalSubtasks) * 100 : 0;
@endphp

              <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition-shadow">
               <div class="flex justify-between items-start mb-2">
                  <h3 class="font-medium text-gray-800">{{$task->nama_task}}</h3>
                  <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">Proses</span>
              </div> 
              
              <p class="text-sm text-gray-500 mb-3">{{$task->proyek->nama_proyek}}</p>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
               </div>

               <div class="flex justify-between items-center mt-1">
                  <span class="text-xs text-gray-500">{{$progress}}% selesai</span>
                  {{-- <span class="text-xs text-gray-500"></span> --}}
               </div>
            </div>
            @endforeach

          </div>
      </div>
  </div>
     
</x-dashboard-layout>