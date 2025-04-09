<x-dashboard-layout>
    <div class="flex h-[calc(100vh-80px)]">
        <!-- Sidebar Daftar Proyek -->
        <div class="w-50 border-r border-gray-200 bg-white overflow-y-auto">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Daftar Proyek</h2>
            </div>
            
            <div class="divide-y divide-gray-100">
                @foreach ($projects as $project)
                <a href="/dashboard/chats/proyek/{{$project->id}}" class="block p-4 hover:bg-gray-50 transition-colors duration-150 ">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $project->nama_proyek }}</h3>
                            <p class="text-sm text-gray-500 truncate mt-1">
                                {{-- {{ $project->lastMessage ? Str::limit($project-->message, 40) : 'Belum ada pesan' }} --}}
                            </p>
                        </div>
                        <span class="text-xs text-gray-400">
                            {{ $project->lastMessage ? $project->lastMessage->created_at->diffForHumans() : '' }}
                        </span>
                    </div>
                    @if($project->unread_count > 0)
                    <span class="inline-block mt-2 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                        {{ $project->unread_count }} pesan baru
                    </span> 
                    @endif
                </a>
                @endforeach
            </div>
        </div>

    </div>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</x-dashboard-layout>