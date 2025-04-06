<x-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Tugas Mendatang</h1>
                <div class="relative">
                    <button id="projectDropdownButton" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <span>Banker Room Project</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <!-- Project Dropdown -->
                    <div id="projectDropdown" class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                        <div class="py-1 max-h-60 overflow-y-auto">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-700">Proyek Aktif</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bg-primary-50">
                                <div class="flex justify-between items-center">
                                    <span>Banker Room Project</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-primary-100 text-primary-600">Aktif</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Finishing Gledung Surveyor</p>
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <span>Marketing Website</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-primary-100 text-primary-600">Aktif</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Redesign UI/UX</p>
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <span>Mobile App Dev</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-warning-100 text-warning-600">On Hold</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Fitur Pembayaran</p>
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <span>Data Migration</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-600">Planning</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Database Upgrade</p>
                            </a>
                            <div class="px-4 py-2 border-t border-gray-100">
                                <button class="flex items-center text-sm text-primary-600 hover:text-primary-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Buat Proyek Baru
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Current Task -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold text-gray-700">Pekerjaan Ruang Banker</h2>
                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-primary-100 text-primary-600">Finishing Gledung Surveyor</span>
                </div>
                
                <div class="mb-3">
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Progress</span>
                        <span>75%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-primary-500 h-2.5 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 my-4"></div>
            
            <!-- Client Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-700 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Klien
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Klien A</span>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-warning-100 text-warning-500">4 Days Left</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Klien B</span>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-danger-100 text-danger-500">3 Days Left</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Klien C</span>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-success-100 text-success-500">Selesai</span>
                        </div>
                    </div>
                </div>
                
                <!-- Deadline Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-700 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Tenggat Waktu
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600">20 December 2024</span>
                            <span class="ml-auto text-xs font-medium px-2 py-1 rounded-full bg-primary-100 text-primary-600">On Track</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600">15 January 2025</span>
                            <span class="ml-auto text-xs font-medium px-2 py-1 rounded-full bg-warning-100 text-warning-600">Mendekati</span>
                        </div>
                    </div>
                </div>
                
                <!-- Project Team Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                            </svg>
                            Tim Projek
                        </h3>
                        <span class="text-xs text-gray-500">5 Anggota</span>
                    </div>
                    <div class="flex -space-x-2 mb-4">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/12.jpg" alt="">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/75.jpg" alt="">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-medium text-gray-600">+2</div>
                    </div>
                    <button class="w-full flex items-center justify-center text-sm font-medium text-primary-600 hover:text-primary-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Anggota
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</x-dashboard-layout>