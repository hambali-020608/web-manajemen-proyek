<x-dashboard-layout>
    <div class="container mx-auto px-4 py-8 mt-5">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Pengujian Proyek</h1>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Button Tambah Kualitas Pengujian -->
                <button onclick="openModal('modal-tambah-kualitas')" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm text-sm font-medium flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Kualitas Pengujian
                </button>
                
                <!-- Dropdown Pilih Proyek -->
                <div class="relative">
                    <button id="ProyekDropdownButton" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 w-full md:w-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Pilih Proyek
                    </button>
                    
                    <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                        <div class="py-1 max-h-96 overflow-y-auto">
                            <div class="px-4 py-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-700">Select Project</p>
                            </div>
                            @foreach ($proyeks as $project)
                            <a href="/dashboard/testing/proyek/{{ $project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <span>{{ $project->nama_proyek }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Project List Card -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Proyek</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{$proyeks->count()}} Proyek</span>
                </div>

                <div class="space-y-4">
                    @foreach ($proyeks as $proyek)
                    @php
                        $check_done = $proyek->testProject->where('is_checked', true)->count();
                        $check_undone = $proyek->testProject->where('is_checked', false)->count();
                        $totalTest = $proyek->testProject->count();
                        $progress_test = $totalTest > 0 ? round(($check_done / $totalTest) * 100) : 0;
                    @endphp
                    
                    <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">{{$proyek->nama_proyek}}</h3>
                            </div>
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                                <!-- Tambah Pengujian Button -->
                                <button onclick="openModal('modal-{{$proyek->id}}')" 
                                        class="px-3 py-1 text-xs bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                                    + Tambah Pengujian
                                </button>
                            </div>
                        </div>
                    
                        <!-- Checklist Section -->
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Checklist Kualitas Proyek</h4>
                            <form action="/check-testing" method="POST">
                                @csrf
                                <div class="space-y-2">
                                    @foreach ($proyek->testProject as $testProject)
                                    <div class="flex items-center {{$testProject->is_checked ? 'line-through' : ''}}">
                                        <input type="hidden" name="tests[{{$testProject->id}}][id]" value="{{$testProject->id}}">
                                        <input type="checkbox" name="tests[{{$testProject->id}}][is_checked]" 
                                               id="quality-{{$testProject->id}}" 
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                               {{$testProject->is_checked ? 'checked' : ''}}>
                                        <label for="quality-{{$testProject->id}}" class="ml-2 text-sm text-gray-700">
                                            {{$testProject->quality->quality_name}}
                                        </label>
                                        <span class="ml-auto text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">Wajib</span>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded-lg mt-4 hover:bg-blue-600 transition-colors">
                                    Simpan Perubahan
                                </button>
                            </form>
                            
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

                    <!-- Modal for Tambah Pengujian -->
                    <div id="modal-{{$proyek->id}}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Tambah Pengujian Baru</h3>
                                <button onclick="closeModal('modal-{{$proyek->id}}')" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form action="/add-test" method="POST">
                                @csrf
                                <input type="hidden" name="proyek_id" value="{{$proyek->id}}">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Quality</label>
                                    <select id="qualities" name="quality_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>Choose a Quality</option>
                                        @foreach ($qualities as $quality)
                                        <option value="{{$quality->id}}">{{$quality->quality_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="closeModal('modal-{{$proyek->id}}')"
                                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Testing Status Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Status Pengujian</h2>
                
                <!-- Checklist Summary -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Ringkasan Checklist</h3>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600">{{$proyeks->count()}}</p>
                            <p class="text-xs text-gray-500">Total Proyek</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">{{$check_done ?? 0}}</p>
                            <p class="text-xs text-gray-500">Checklist Selesai</p>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-lg">
                            <p class="text-2xl font-bold text-yellow-600">{{$check_undone ?? 0}}</p>
                            <p class="text-xs text-gray-500">Checklist Tersisa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Tambah Kualitas Pengujian -->
    <div id="modal-tambah-kualitas" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Kualitas Pengujian Baru</h3>
                <button onclick="closeModal('modal-tambah-kualitas')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="/store-quality" method="POST" >
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kualitas *</label>
                    <input type="text" name="quality_name" required
                        class="block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Kualitas Material">
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('modal-tambah-kualitas')"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle project dropdown
            const ProyekDropdownButton = document.getElementById('ProyekDropdownButton');
            ProyekDropdownButton.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = document.getElementById('projectDropdown');
                dropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                const dropdown = document.getElementById('projectDropdown');
                dropdown.classList.add('hidden');
            });

            // Prevent dropdown from closing when clicking inside it
            document.getElementById('projectDropdown').addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Update progress when checkboxes change
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const projectCard = this.closest('.border-gray-100');
                    const checklistItems = projectCard.querySelectorAll('input[type="checkbox"]');
                    const checkedItems = projectCard.querySelectorAll('input[type="checkbox"]:checked');
                    
                    // Calculate progress percentage
                    const progress = Math.round((checkedItems.length / checklistItems.length) * 100);
                    
                    // Update progress bar
                    const progressBar = projectCard.querySelector('.bg-blue-500');
                    const progressText = projectCard.querySelector('.flex.justify-between.text-sm.text-gray-500 span:last-child');
                    
                    if(progressBar && progressText) {
                        progressBar.style.width = progress + '%';
                        progressText.textContent = progress + '%';
                    }
                    
                    // Update label style
                    const label = this.nextElementSibling;
                    if(this.checked) {
                        label.classList.add('line-through');
                    } else {
                        label.classList.remove('line-through');
                    }
                });
            });
        });

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                if (event.target == modal) {
                    closeModal(modal.id);
                }
            });
        }
    </script>
</x-dashboard-layout>