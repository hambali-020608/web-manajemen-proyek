<x-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Project Header -->
        <div class="bg-white rounded-xl shadow-sm relative p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Detail Proyek</h1>
                <button id="projectDropdownButton" class="inline-flex justify-between items-center w-64 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                    {{-- {{ $selectedProject->nama_proyek }} --}}
                    Select Project
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
    
                <div id="projectDropdown" class="hidden absolute right-0 mt-10 w-64 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1 max-h-96 overflow-y-auto">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-700">Select Project</p>
                        </div>
                        @foreach ($proyeks as $project)
                        <a href="proyek/{{$project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
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
            
            <!-- Project Details Table -->
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <script>
             document.getElementById('projectDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('projectDropdown');
            dropdown.classList.toggle('hidden');
        });

    </script>
</x-dashboard-layout>