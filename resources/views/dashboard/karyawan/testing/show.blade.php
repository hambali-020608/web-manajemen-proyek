<x-dashboard-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        {{-- {{dd($proyeks[0]->testProject[0]->quality->quality_name)}} --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pengujian Proyek</h1>
            <div class="flex space-x-3">
                <button id="ProyekDropdownButton" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    {{$proyek->nama_proyek}}
                </button>
                

            </div>
        </div>
        <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-64 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
            <div class="py-1 max-h-96 overflow-y-auto">
                <div class="px-4 py-2 border-b border-gray-200">
                    <p class="text-sm font-medium text-gray-700">Select Project</p>
                </div>
                @foreach ($proyeks as $project)
                <a href="/dashboard/testing/proyek/{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
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

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Project List Card -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Nama Proyek</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{$proyek->nama_proyek}}</span>
                </div>

                <div class="space-y-4">
                    <!-- Project 1 - With Checklist -->

                    
                    <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">{{$proyek->nama_proyek}}</h3>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                        
                        <!-- Checklist Section -->
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Checklist Kualitas Proyek</h4>
                            <div class="space-y-2">
                                @php
                                 $totalTest = $proyek->testProject->count();
                                 $progress_test = $check_done > 0 ? ($totalTest / $check_done) * 100: 0 ;
                                //  dd($progress_test);
                            @endphp
                                <form action="/check-testing" method="post">
                                    @csrf
                                @foreach ($proyek->testProject as $testProject)

                                <div class="flex items-center {{$testProject->is_checked ? 'line-through' :''}}">
                                    <input type="hidden" name="id_test" value="{{$testProject->id}}">
                                    <input type="checkbox" name="is_checked" id="quality-1-1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{$testProject->is_checked?'checked' :''}} >
                                    <label for="quality-1-1" class="ml-2 text-sm text-gray-700">{{$testProject->quality->quality_name}}</label>
                                    <span class="ml-auto text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">Wajib</span>
                                </div>
                                <button type="submit" class="px-2 py-2 bg-blue-400 rounded-lg mt-4">Simpan Perubahan</button>
                                @endforeach
                            </form>
                            </div>
                            
                            <!-- Progress based on checklist -->
                            
                            <div class="mt-3">
                                <div class="flex justify-between text-sm text-gray-500 mb-1">
                                    <span>Progress Checklist</span>
                                    <span>{{$progress_test}}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{$progress_test}}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    
                    <!-- Project 2 - With Checklist -->
                    
                </div>
            </div>

            <!-- Testing Status Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Status Pengujian</h2>
                
                <div class="space-y-6">
                    <!-- Status based on checklist completion -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium text-gray-700">Pekerjaan Ruang Banker</h3>
                            <span class="text-sm font-medium text-yellow-600">33%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full bg-yellow-500" style="width: 33%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>1/3 checklist</span>
                            <span>Prioritas: Tinggi</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium text-gray-700">Chatstar Program</h3>
                            <span class="text-sm font-medium text-green-600">67%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full bg-green-500" style="width: 67%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>2/3 checklist</span>
                            <span>Prioritas: Sedang</span>
                        </div>
                    </div>
                </div>
                
                <!-- Checklist Summary -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">{{$check_done}}</p>
                            <p class="text-xs text-gray-500">Checklist Selesai</p>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-lg">
                            <p class="text-2xl font-bold text-yellow-600">{{$check_undone}}</p>
                            <p class="text-xs text-gray-500">Checklist Tersisa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monitoring Chart Card -->
            <div class="lg:col-span-3 bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Grafik Monitoring Checklist</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Checklist Completion Chart -->
                    <div class="border border-gray-100 rounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-4">Status Penyelesaian Checklist</h3>
                        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                            <div class="text-center">
                                <div class="w-32 h-32 mx-auto mb-4 relative">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <path d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#eee"
                                            stroke-width="3"
                                        />
                                        <path d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#4f46e5"
                                            stroke-width="3"
                                            stroke-dasharray="50, 100"
                                        />
                                        <text x="18" y="20.5" text-anchor="middle" font-size="6" fill="#4f46e5" font-weight="bold">50%</text>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500">3 dari 6 checklist selesai</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Checklist by Project -->
                    <div class="border border-gray-100 xrounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-4">Checklist per Proyek</h3>
                        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                            <div class="w-full max-w-md">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 truncate" style="width: 120px;">Pekerjaan Ruang Banker</span>
                                    <div class="w-full max-w-xs bg-gray-200 rounded-full h-2.5 mx-2">
                                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: 33%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">33%</span>
                                </div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 truncate" style="width: 120px;">Chatstar Program</span>
                                    <div class="w-full max-w-xs bg-gray-200 rounded-full h-2.5 mx-2">
                                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: 67%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">67%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Checklist Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all checkboxes
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
             const ProyekDropdownButton= document.getElementById('ProyekDropdownButton')
            ProyekDropdownButton.addEventListener('click',()=>{
                const dropdown = document.getElementById('projectDropdown');
                dropdown.classList.toggle('hidden');
                    
            })
            // Add event listener to each checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const projectCard = this.closest('.border-gray-100');
                    const checklistItems = projectCard.querySelectorAll('input[type="checkbox"]');
                    const checkedItems = projectCard.querySelectorAll('input[type="checkbox"]:checked');
                    
                    // Calculate progress percentage
                    const progress = Math.round((checkedItems.length / checklistItems.length) * 100);
                    
                    // Update progress bar
                    const progressBar = projectCard.querySelector('.bg-blue-500');
                    progressBar.style.width = progress + '%';
                    
                    // Update progress text
                    const progressText = projectCard.querySelector('.flex.justify-between.text-sm.text-gray-500 span:last-child');
                    progressText.textContent = progress + '%';
                    
                    // Update label style if checked
                    const label = this.nextElementSibling;
                    if(this.checked) {
                        label.classList.add('line-through');
                        // Find and update the status badge if exists
                        const statusBadge = this.parentElement.querySelector('.bg-blue-100');
                        if(statusBadge) {
                            statusBadge.classList.remove('bg-blue-100', 'text-blue-800');
                            statusBadge.classList.add('bg-green-100', 'text-green-800');
                            statusBadge.textContent = 'Selesai';
                        }
                    } else {
                        label.classList.remove('line-through');
                        // Revert status badge if unchecked
                        const statusBadge = this.parentElement.querySelector('.bg-green-100');
                        if(statusBadge && statusBadge.textContent === 'Selesai') {
                            statusBadge.classList.remove('bg-green-100', 'text-green-800');
                            statusBadge.classList.add('bg-blue-100', 'text-blue-800');
                            statusBadge.textContent = 'Wajib';
                        }
                    }
                    
                    // Update the testing status card
                    updateTestingStatus();
                });
            });
            
            function updateTestingStatus() {
                // This function would update the testing status card based on all checkboxes
                // In a real implementation, you might send this data to the server
                console.log('Checklist updated - would send data to server in real implementation');
            }
        });
    </script>
</x-dashboard-layout>