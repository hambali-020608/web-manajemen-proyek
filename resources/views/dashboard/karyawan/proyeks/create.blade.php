<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Form Header -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700">
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

                <!-- Project Description -->
                
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

                <!-- Project Budget -->
                {{-- <div class="mb-6">
                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget (Optional)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="text" name="budget" id="budget"
                            class="block w-full pl-7 pr-12 py-3 rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="0.00">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <select name="currency" class="h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 focus:border-blue-500 focus:ring-blue-500 rounded-r-md">
                                <option>USD</option>
                                <option>IDR</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </div> --}}

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ url()->previous() }}" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>