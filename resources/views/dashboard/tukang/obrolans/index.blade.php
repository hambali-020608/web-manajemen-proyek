<x-dashboard-layout>
    @php
        $tukang = auth('tukangs')->user()->load('subTask.task.proyek');
        $proyeks = $tukang->subTask->map(function($subtask) {
            return $subtask->task->proyek;
        })->unique('id');
        
    @endphp
    <!-- Project Selection Dropdown -->
    <div class="flex justify-between items-center mb-6 p-4 bg-white rounded-lg shadow-sm">
        {{-- {{dd($proyek)}} --}}
        <h1 class="text-2xl font-bold text-gray-800">Project Chat</h1>
        <div class="relative">
            <button id="projectDropdownButton" class="flex items-center justify-between w-64 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <span class="truncate">Select a project</span>
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <!-- Project Dropdown Menu -->
            <div id="projectDropdown" class="hidden absolute right-0 z-10 mt-2 w-64 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1 max-h-96 overflow-y-auto">
                    <div class="px-4 py-2 border-b border-gray-100 bg-gray-50">
                        <p class="text-sm font-medium text-gray-700">Active Projects</p>
                    </div>
                    @foreach ($proyeks as $project)
                    <a href="{{ $project->id }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-150">
                        <div class="flex justify-between items-center">
                            <span class="font-medium truncate">{{ $project->nama_proyek }}</span>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 truncate">Last updated: {{ $project->updated_at->diffForHumans() }}</p>
                    </a>
                    @endforeach
                    <div class="px-4 py-2 border-t border-gray-100 bg-gray-50">
                        <button class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create New Project
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Container -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- Chat Messages -->
        <div class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto pb-4">
            @foreach ($obrolans as $obrolan)
            <div class="flex gap-3 message-container">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($obrolan->sender->name) }}&background=random" alt="{{ $obrolan->sender->name }}">
                        <span class="top-0 left-5 absolute w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 min-w-0">
                    <div class="relative bg-gray-50 rounded-lg p-4 shadow-sm">
                        <!-- Message Header -->
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-semibold text-gray-900">{{ $obrolan->sender->name }}</span>
                            <span class="text-xs text-gray-500">{{ $obrolan->created_at->format('h:i A') }}</span>
                        </div>
                        
                        <!-- Message Body -->
                        <p class="text-sm text-gray-800 mb-2">{{ $obrolan->message }}</p>
                        
                        <!-- Message Footer -->
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 flex items-center">
                                
                            </span>
                            
                            <!-- Message Actions -->
                            <button class="text-gray-400 hover:text-gray-600 message-actions-btn">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="hidden absolute right-0 z-10 mt-2 w-44 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 message-dropdown">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Reply</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Forward</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Copy</a>
                                    <div class="border-t border-gray-100"></div>
                                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message Attachments (if any) -->
                    @if($obrolan->attachments)
                    <div class="mt-2 flex space-x-2">
                        @foreach($obrolan->attachments as $attachment)
                        <div class="p-2 border rounded-lg bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-600 truncate" style="max-width: 120px;">{{ $attachment->name }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- New Message Input -->
        <div class="mt-6 border-t border-gray-200 pt-4">
            <form class="flex items-center space-x-2" method="POST" action="/store-chat">
                @csrf
                <div class="flex-grow relative">
                    <input type="hidden" value="{{$proyek->id}}" name="proyek_id">
                    <input type="text" name="message" placeholder="Type your message..." class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500" >
                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                </div>
                <button type="button" class="p-2 text-blue-600 rounded-full hover:bg-blue-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Project dropdown toggle
        document.getElementById('projectDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('projectDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('projectDropdown');
            const button = document.getElementById('projectDropdownButton');
            
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Message actions dropdown
        document.querySelectorAll('.message-actions-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.parentElement.querySelector('.message-dropdown');
                
                // Close all other dropdowns first
                document.querySelectorAll('.message-dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('hidden');
            });
        });

        // Close message dropdowns when clicking elsewhere
        document.addEventListener('click', function() {
            document.querySelectorAll('.message-dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });
    </script>
</x-dashboard-layout>