<x-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Project Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
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
                        <a href="/dashboard/handover/proyek/{{$project->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
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
            </div>
            
            <!-- Project Details Table -->
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                Nama Proyek
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{$proyek->nama_proyek}}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                Tanggal Mulai
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{$proyek->tanggal_mulai}}
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                Tanggal Selesai
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{$proyek->deadline_proyek}}
                        
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>
            
            <!-- Confirmation Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi</h2>
                <div class="space-y-4">
                    <!-- Status Display -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Status</h3>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                @if($proyek->confirmation_proyek)
                                    <div class="h-3 w-3 rounded-full {{ $proyek->confirmation_proyek->status_confirmation == 'rejected' ? 'bg-red-500' : 'bg-green-400' }} mr-2"></div>
                                    <span class="text-sm text-gray-600 capitalize">
                                        {{ $proyek->confirmation_proyek->status_confirmation }}
                                    </span>
                                @else
                                    <div class="h-3 w-3 rounded-full bg-yellow-400 mr-2"></div>
                                    <span class="text-sm text-gray-600">Belum dikonfirmasi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Jika sudah ada data konfirmasi -->
                    @if($proyek->confirmation_proyek)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-2">
                                <h4 class="text-sm font-medium text-gray-700">Keterangan Sebelumnya:</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $proyek->confirmation_proyek->detail ?? '-' }}</p>
                            </div>
                            <button 
                                onclick="document.getElementById('editForm').classList.toggle('hidden')"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                            >
                                Edit Konfirmasi
                            </button>
                        </div>

                        <!-- Edit Form (Awalnya tersembunyi) -->
                        <div id="editForm" class="hidden">
                            <form action="/proyek-confirmation" method="post">
                                @csrf
                                <input type="hidden" value="{{ $proyek->id }}" name="proyek_id">
                                <input id="status_input" type="hidden" value="" name="status_confirmation">
                                
                                <div class="mb-4">
                                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Keterangan Baru
                                    </label>
                                    <textarea id="keterangan" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                        placeholder="Tambahkan keterangan jika diperlukan" name="detail">{{ old('detail', $proyek->confirmation_proyek->detail ?? '') }}</textarea>
                                </div>
                                
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button type="button" onclick="setStatus('rejected')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Tolak
                                    </button>
                                    <button type="button" onclick="setStatus('accepted')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Konfirmasi
                                    </button>
                                    <button type="submit" id="submitBtn" class="hidden">Submit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- Jika belum ada data konfirmasi -->
                        <form action="/proyek-confirmation" method="post">
                            @csrf
                            <input type="hidden" value="{{ $proyek->id }}" name="proyek_id">
                            <input id="status_input" type="hidden" value="" name="status_confirmation">
                            
                            <div class="mb-4">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Keterangan
                                </label>
                                <textarea id="keterangan" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    placeholder="Tambahkan keterangan jika diperlukan" name="detail">{{ old('detail') }}</textarea>
                            </div>
                            
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="setStatus('rejected')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Tolak
                                </button>
                                <button type="button" onclick="setStatus('accepted')" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Konfirmasi
                                </button>
                                <button type="submit" id="submitBtn" class="hidden">Submit</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function setStatus(status) {
            document.getElementById('status_input').value = status;
            document.getElementById('submitBtn').click();
        }
        
        document.getElementById('projectDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('projectDropdown');
            dropdown.classList.toggle('hidden');
        });
    </script>


</x-dashboard-layout>