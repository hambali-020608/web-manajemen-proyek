<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Form Header -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r bg-yellow-500">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Create New Project</h2>
                    <a href="{{ url()->previous() }}" class="text-blue-100 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <p class="mt-1 text-sm text-blue-100">Fill in the details below to create a new project</p>
            </div>

            <!-- Project Form -->
            <form method="POST" action="/create-proyek" class="px-6 py-6">
                @csrf

                <!-- Project Name -->
                <div class="mb-6">
                    <label for="nama_proyek" class="block text-sm font-medium text-gray-700 mb-1">Project Name *</label>
                    <input type="text" id="nama_proyek" name="nama_proyek" required
                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="e.g. Website Redesign Project">
                    @error('nama_proyek')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" required
                            class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="deadline_proyek" class="block text-sm font-medium text-gray-700 mb-1">Deadline *</label>
                        <input type="date" id="deadline_proyek" name="deadline_proyek" required
                            class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Client Selection -->
                <div class="mb-6">
                    <label for="klien_id" class="block text-sm font-medium text-gray-700 mb-1">Select Client *</label>
                    <select id="klien_id" name="id_klien" required
                        class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                        <option value="">-- Select Client --</option>
                        @foreach($kliens as $klien)
                        <option value="{{ $klien->id }}" {{ old('klien_id') == $klien->id ? 'selected' : '' }}>
                            {{ $klien->name }} ({{ $klien->email }})
                        </option>
                        @endforeach
                    </select>
                    @error('klien_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Team Member Selection (Fixed Checkbox Section) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Anggota *</label>
                    <ul class="space-y-3">
                        @foreach($tukangs as $tukang)
                        <li>
                            <label class="inline-flex items-center cursor-pointer">
                                <!-- Hidden Native Checkbox -->
                                <input 
                                    type="checkbox" 
                                    id="tukang-{{ $tukang->id }}"
                                    name="tukang_id[]" 
                                    value="{{ $tukang->id }}"
                                    class="hidden"
                                    {{ in_array($tukang->id, old('tukang_id', [])) ? 'checked' : '' }}
                                >
                                <!-- Custom Checkbox Design -->
                                <span class="checkmark h-4 w-4 border border-gray-300 rounded bg-white flex-shrink-0 mr-2 flex items-center justify-center">
                                    <!-- Check icon (hidden by default) -->
                                    <svg class="check-icon hidden w-3 h-3 text-white pointer-events-none" 
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-700">
                                    {{ $tukang->name }} ({{ $tukang->email }})
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                    @error('tukang_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ url()->previous() }}" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Custom Checkbox Styling */
        .checkmark {
            transition: all 0.2s ease;
            position: relative;
        }
        input:checked + .checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        input:checked + .checkmark .check-icon {
            display: block;
        }
        label:hover .checkmark {
            background-color: #f3f4f6;
        }
        input:focus + .checkmark {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>

    <script>
        // Make checkboxes interactive
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            // Update state when label is clicked
            checkbox.addEventListener('change', function() {
                const checkmark = this.nextElementSibling;
                if (this.checked) {
                    checkmark.classList.add('bg-blue-500', 'border-blue-500');
                    checkmark.querySelector('.check-icon').classList.remove('hidden');
                } else {
                    checkmark.classList.remove('bg-blue-500', 'border-blue-500');
                    checkmark.querySelector('.check-icon').classList.add('hidden');
                }
            });

            // Initialize state on page load
            if (checkbox.checked) {
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-dashboard-layout>