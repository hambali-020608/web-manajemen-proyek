<x-dashboard-layout>
    <div class="flex h-[calc(100vh-80px)]">
        <!-- Sidebar Daftar Proyek -->
        <div class="w-50 border-r border-gray-200 bg-white overflow-y-auto">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Daftar Proyek</h2>
            </div>
            
            <div class="divide-y divide-gray-100">
                @foreach ($projects as $project)
                <a href="/dashboard/chats/proyek/{{$project->id}}" class="block p-4 hover:bg-gray-50 transition-colors duration-150 {{ $project->id == $proyek->id ? 'bg-blue-50' : '' }}">
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

        <!-- Area Chat Utama -->
        <div class="flex-1 flex flex-col">
            <!-- Header Chat -->
            <div class="p-4 border-b border-gray-200 bg-white flex items-center">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                            {{ substr($proyek->nama_proyek, 0, 1) }}
                        </div>
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">{{ $proyek->nama_proyek }}</h2>
                        <p class="text-xs text-gray-500">
                            {{-- {{ $participantsCount }} anggota --}}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Daftar Pesan -->
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <div class="space-y-4">
                    @foreach ($obrolans as $obrolan)

                    <div class="flex gap-3 ">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($obrolan->sender->name) }}&background=random" alt="{{ $obrolan->sender->name }}">
                        </div>
                        
                        <div class="flex-1 min-w-0 ">
                            <div class="inline-block max-w-xs lg:max-w-md bg-white rounded-lg p-3 shadow-sm">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-semibold text-gray-900">{{ $obrolan->sender->name }}</span>
                                    <span class="text-xs text-gray-500 ml-2">{{ $obrolan->created_at->format('H:i') }}</span>
                                </div>
                                
                                <p class="text-sm text-gray-800">{{ $obrolan->message }}</p>
                                
                                @if($obrolan->attachments)
                                <div class="mt-2">
                                    @foreach($obrolan->attachments as $attachment)
                                    <div class="p-2 border rounded-lg bg-gray-50 inline-block">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-sm text-gray-600">{{ $attachment->name }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Input Pesan -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <form class="flex items-center space-x-2" method="POST" action="/store-chat">
                    @csrf
                    <input type="hidden" value="{{$proyek->id}}" name="proyek_id">
                    
                    
                    <div class="flex-grow relative">
                        <input type="text" name="message" placeholder="Ketik pesan..." class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <button type="submit" class="p-2 text-blue-600 rounded-full hover:bg-blue-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
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