<x-dashboard-layout>
    @php
      $completedTasks = $project->task->where('status', 'completed')->count();
    $totalTasks = $project->task->count();
    
   $progress = $completedTasks > 0 ? round(($completedTasks / $totalTasks) * 100):0;
    @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Project Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 bg-gradient-to-r bg-blue-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $project->nama_proyek }}</h1>
                        {{-- <p class="mt-1 text-blue-100">{{ $project->deskripsi_proyek }}</p> --}}
                    </div>
                    <div class="flex space-x-3">    
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ \Carbon\Carbon::parse($project->deadline_proyek)->diffForHumans() }}
                        </span>
                        <a href="/dashboard/proyek/overview/{{$project->id}}" class="text-blue-100 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Start Date</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Deadline</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($project->deadline_proyek)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Client</p>
                        <div class="flex items-center mt-1">
                            <img class="h-6 w-6 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode($project->klien->name) }}&background=random" alt="{{ $project->klien->name }}">
                            <p class="font-medium">{{ $project->klien->name }}</p>
                        </div>
                    </div>
                    <div>
                        
                        <p class="text-sm text-gray-500">Progress</p>
                        <div class="flex items-center mt-1">
                            <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <span class="text-sm font-medium">{{ $progress }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Task List -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Project Tasks</h2>
                        {{-- <a href="/dashboard/proyek/{{ $project->id }}/task/create" class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            + Add Task
                        </a> --}}
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($project->task as $task)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $task->nama_task }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Deadline: {{ \Carbon\Carbon::parse($task->deadline_task)->format('M d, Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $task->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                            
                            {{-- <div class="mt-4"> --}}
                                {{-- <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-500">Progress</span>
                                    <span class="font-medium text-gray-900">{{ $task->progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $task->progress }}%"></div>
                                </div>
                            </div>
                             --}}
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    {{-- @foreach($task->assignedMembers as $member)
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" 
                                         alt="{{ $member->name }}"
                                         title="{{ $member->name }}">
                                    @endforeach --}}
                                </div>
                                {{--  --}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Project Info Sidebar -->
            <div>

                @php
                    $tukangs = $project->task->flatMap(function($task) {
        return $task->sub_task->pluck('tukang');
    })->filter()->unique('id');
                @endphp
                <!-- Team Members -->
                <div class="bg-white  shadow rounded-lg overflow-hidden mb-6">
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
                                {{-- <p class="text-sm text-gray-500">{{ $member->role }}</p> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Project Timeline -->
                {{-- <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Project Timeline</h2>
                    </div>
                    <div class="px-6 py-4">
                        {{-- <div class="space-y-4">
                            @foreach($project->milestones as $milestone)
                            <div class="flex">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
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
                            @endforeach
                        </div> --}}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-dashboard-layout>