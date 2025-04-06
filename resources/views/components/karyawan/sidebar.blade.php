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
        @if(auth('karyawans')->user()->role == 'superadmin')
        <li>
            <a href="/dashboard/create-karyawan" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg viewBox="0 0 24 24" class="w-5 h-5" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --> <title>ic_fluent_people_add_24_filled</title> <desc>Created with Sketch.</desc> <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="ic_fluent_people_add_24_filled" fill="#212121" fill-rule="nonzero"> <path d="M17.5,12 C20.5375661,12 23,14.4624339 23,17.5 C23,20.5375661 20.5375661,23 17.5,23 C14.4624339,23 12,20.5375661 12,17.5 C12,14.4624339 14.4624339,12 17.5,12 Z M4,12.999 L12.8093956,13.000184 C11.6887317,14.1680611 11,15.7535996 11,17.5 C11,18.5873606 11.266999,19.6123603 11.7390124,20.5130144 C10.6887116,20.8629701 9.53056842,21 8.5,21 C5.77786667,21 2.16469531,20.0439506 2.00545418,16.7296461 L2,16.5 L2,14.999 C2,13.895 2.896,12.999 4,12.999 Z M17.5,14.0015812 L17.4101244,14.0096369 C17.2060313,14.0466809 17.0450996,14.2076126 17.0080557,14.4117056 L17,14.5015812 L17,16.9995812 L14.5,17 L14.4101244,17.0080557 C14.2060313,17.0450996 14.0450996,17.2060313 14.0080557,17.4101244 L14,17.5 L14.0080557,17.5898756 C14.0450996,17.7939687 14.2060313,17.9549004 14.4101244,17.9919443 L14.5,18 L17,17.9995812 L17,20.5 L17.0080557,20.5898756 C17.0450996,20.7939687 17.2060313,20.9549004 17.4101244,20.9919443 L17.5,21 L17.5898756,20.9919443 C17.7939687,20.9549004 17.9549004,20.7939687 17.9919443,20.5898756 L18,20.5 L18,17.9995812 L20.5,18 L20.5898756,17.9919443 C20.7939687,17.9549004 20.9549004,17.7939687 20.9919443,17.5898756 L21,17.5 L20.9919443,17.4101244 C20.9549004,17.2060313 20.7939687,17.0450996 20.5898756,17.0080557 L20.5,17 L18,16.9995812 L18,14.5015812 L17.9919443,14.4117056 C17.9549004,14.2076126 17.7939687,14.0466809 17.5898756,14.0096369 L17.5,14.0015812 Z M8.5,2 C10.985,2 13,4.015 13,6.5 C13,8.985 10.985,11 8.5,11 C6.015,11 4,8.985 4,6.5 C4,4.015 6.015,2 8.5,2 Z M17.5,4 C19.433,4 21,5.567 21,7.5 C21,9.433 19.433,11 17.5,11 C15.567,11 14,9.433 14,7.5 C14,5.567 15.567,4 17.5,4 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
                <span class="ms-3">Create Karyawan</span>
            </a>
        </li>
                
            
        @endif
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
            <a href="/dashboard/chats/proyek/1" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium text-white bg-primary-500 rounded-full">3</span>
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
        <li>
            
            <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
            
            <a onclick="confirmLogout()" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                
               <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.9453 1.25C13.5778 1.24998 12.4754 1.24996 11.6085 1.36652C10.7084 1.48754 9.95048 1.74643 9.34857 2.34835C8.82363 2.87328 8.55839 3.51836 8.41916 4.27635C8.28387 5.01291 8.25799 5.9143 8.25196 6.99583C8.24966 7.41003 8.58357 7.74768 8.99778 7.74999C9.41199 7.7523 9.74964 7.41838 9.75194 7.00418C9.75803 5.91068 9.78643 5.1356 9.89448 4.54735C9.99859 3.98054 10.1658 3.65246 10.4092 3.40901C10.686 3.13225 11.0746 2.9518 11.8083 2.85315C12.5637 2.75159 13.5648 2.75 15.0002 2.75H16.0002C17.4356 2.75 18.4367 2.75159 19.1921 2.85315C19.9259 2.9518 20.3144 3.13225 20.5912 3.40901C20.868 3.68577 21.0484 4.07435 21.1471 4.80812C21.2486 5.56347 21.2502 6.56459 21.2502 8V16C21.2502 17.4354 21.2486 18.4365 21.1471 19.1919C21.0484 19.9257 20.868 20.3142 20.5912 20.591C20.3144 20.8678 19.9259 21.0482 19.1921 21.1469C18.4367 21.2484 17.4356 21.25 16.0002 21.25H15.0002C13.5648 21.25 12.5637 21.2484 11.8083 21.1469C11.0746 21.0482 10.686 20.8678 10.4092 20.591C10.1658 20.3475 9.99859 20.0195 9.89448 19.4527C9.78643 18.8644 9.75803 18.0893 9.75194 16.9958C9.74964 16.5816 9.41199 16.2477 8.99778 16.25C8.58357 16.2523 8.24966 16.59 8.25196 17.0042C8.25799 18.0857 8.28387 18.9871 8.41916 19.7236C8.55839 20.4816 8.82363 21.1267 9.34857 21.6517C9.95048 22.2536 10.7084 22.5125 11.6085 22.6335C12.4754 22.75 13.5778 22.75 14.9453 22.75H16.0551C17.4227 22.75 18.525 22.75 19.392 22.6335C20.2921 22.5125 21.0499 22.2536 21.6519 21.6517C22.2538 21.0497 22.5127 20.2919 22.6337 19.3918C22.7503 18.5248 22.7502 17.4225 22.7502 16.0549V7.94513C22.7502 6.57754 22.7503 5.47522 22.6337 4.60825C22.5127 3.70814 22.2538 2.95027 21.6519 2.34835C21.0499 1.74643 20.2921 1.48754 19.392 1.36652C18.525 1.24996 17.4227 1.24998 16.0551 1.25H14.9453Z" fill="#1C274C"></path> <path d="M15 11.25C15.4142 11.25 15.75 11.5858 15.75 12C15.75 12.4142 15.4142 12.75 15 12.75H4.02744L5.98809 14.4306C6.30259 14.7001 6.33901 15.1736 6.06944 15.4881C5.79988 15.8026 5.3264 15.839 5.01191 15.5694L1.51191 12.5694C1.34567 12.427 1.25 12.2189 1.25 12C1.25 11.7811 1.34567 11.573 1.51191 11.4306L5.01191 8.43056C5.3264 8.16099 5.79988 8.19741 6.06944 8.51191C6.33901 8.8264 6.30259 9.29988 5.98809 9.56944L4.02744 11.25H15Z" fill="#1C274C"></path> </g></svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Logout</span> 
            </a>
            
            <script>
                function confirmLogout() {
                    if (confirm("Apakah Anda yakin ingin logout?")) {
                        document.getElementById("logout-form").submit();
                    }
                }
            </script>
        </li>
        
    </ul>
        
</div>