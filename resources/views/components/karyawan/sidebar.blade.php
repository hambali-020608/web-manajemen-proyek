<div>
    <ul class="space-y-2">
        <li>
            <a href="/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
       
        <li>
            <button id="dropdownButton" class="flex items-center justify-between w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 1h2v2H7V5zm4 0h2v2h-2V5z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Projects</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <ul id="dropdownMenu" class="hidden pl-4 mt-2 space-y-2">
                <li>
                    <a href="/dashboard/proyek/overview" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 pl-8">
                        <span>Overview</span>
                    </a>
                </li>
                
                <li>
                    <a href="/dashboard/proyek/create" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 pl-8">
                        <span>Create Project</span>
                    </a>
                </li>
                
                <li>
                    <a href="/dashboard/proyek/task" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 pl-8">
                        <span>Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/testing" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 pl-8">
                        <span>Uji Proyek</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/handover/" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 pl-8">
                        <span>Serah Terima</span>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="/dashboard/chats/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                {{-- <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium text-white bg-primary-500 rounded-full">3</span> --}}
            </a>
        </li>
        <li>
            <a href="/dashboard/task" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Tasks Kanban</span>
            </a>
        </li>
        @if(auth('karyawans')->user()->role == 'superadmin')
        <li>
            <a href="/dashboard/create-karyawan" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg viewBox="0 0 24 24" class="w-5 h-5" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --> <title>ic_fluent_people_add_24_filled</title> <desc>Created with Sketch.</desc> <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="ic_fluent_people_add_24_filled" fill="#212121" fill-rule="nonzero"> <path d="M17.5,12 C20.5375661,12 23,14.4624339 23,17.5 C23,20.5375661 20.5375661,23 17.5,23 C14.4624339,23 12,20.5375661 12,17.5 C12,14.4624339 14.4624339,12 17.5,12 Z M4,12.999 L12.8093956,13.000184 C11.6887317,14.1680611 11,15.7535996 11,17.5 C11,18.5873606 11.266999,19.6123603 11.7390124,20.5130144 C10.6887116,20.8629701 9.53056842,21 8.5,21 C5.77786667,21 2.16469531,20.0439506 2.00545418,16.7296461 L2,16.5 L2,14.999 C2,13.895 2.896,12.999 4,12.999 Z M17.5,14.0015812 L17.4101244,14.0096369 C17.2060313,14.0466809 17.0450996,14.2076126 17.0080557,14.4117056 L17,14.5015812 L17,16.9995812 L14.5,17 L14.4101244,17.0080557 C14.2060313,17.0450996 14.0450996,17.2060313 14.0080557,17.4101244 L14,17.5 L14.0080557,17.5898756 C14.0450996,17.7939687 14.2060313,17.9549004 14.4101244,17.9919443 L14.5,18 L17,17.9995812 L17,20.5 L17.0080557,20.5898756 C17.0450996,20.7939687 17.2060313,20.9549004 17.4101244,20.9919443 L17.5,21 L17.5898756,20.9919443 C17.7939687,20.9549004 17.9549004,20.7939687 17.9919443,20.5898756 L18,20.5 L18,17.9995812 L20.5,18 L20.5898756,17.9919443 C20.7939687,17.9549004 20.9549004,17.7939687 20.9919443,17.5898756 L21,17.5 L20.9919443,17.4101244 C20.9549004,17.2060313 20.7939687,17.0450996 20.5898756,17.0080557 L20.5,17 L18,16.9995812 L18,14.5015812 L17.9919443,14.4117056 C17.9549004,14.2076126 17.7939687,14.0466809 17.5898756,14.0096369 L17.5,14.0015812 Z M8.5,2 C10.985,2 13,4.015 13,6.5 C13,8.985 10.985,11 8.5,11 C6.015,11 4,8.985 4,6.5 C4,4.015 6.015,2 8.5,2 Z M17.5,4 C19.433,4 21,5.567 21,7.5 C21,9.433 19.433,11 17.5,11 C15.567,11 14,9.433 14,7.5 C14,5.567 15.567,4 17.5,4 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
                <span class="ms-3">Create Karyawan</span>
            </a>
        </li>
                
            
        @endif
    </ul>
        
</div>