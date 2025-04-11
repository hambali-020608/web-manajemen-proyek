<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task Management Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else --}}

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#3b82f6',
                            600: '#2563eb',
                        },
                        success: {
                            100: '#dcfce7',
                            500: '#22c55e',
                        },
                        warning: {
                            100: '#fef9c3',
                            500: '#eab308',
                        },
                        danger: {
                            100: '#fee2e2',
                            500: '#ef4444',
                        },
                    }
                }
            }
        }
    </script>
    {{-- @endif --}}
</head>
<body class="bg-gray-50 font-sans">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-4 py-3 lg:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="/" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-bold whitespace-nowrap text-gray-800">TaskFlow</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button type="button" onclick="window.location.href = '/dashboard/chats/'" class="p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="sr-only">View notifications</span> 
                        </button>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center relative">
                        <button id="user-menu-button" type="button" class="flex text-sm bg-gray-100 rounded-full focus:ring-4 focus:ring-gray-300">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 rounded-full bg-primary-500 flex items-center justify-center text-white font-medium">US</div>
                        </button>
                    
                        <div id="dropdown-user" class="absolute hidden top-10 right-0 z-50  mt-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                            <div class="px-4 py-3">
                                {{-- <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p> --}}
                                <p class="text-sm text-gray-500 truncate">user@example.com</p>
                            </div>
                            <ul class="py-1">
                                {{-- <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a></li>
                                <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a></li> --}}
                                <li><a href="#" onclick="confirmLogout()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            @auth('karyawans')

         <x-karyawan.sidebar/>
         
         @endauth
         
         @auth('tukangs')

         <x-tukang.sidebar/>

            @endauth

         @auth('kliens')
         
         <x-klien.sidebar/>

            @endauth
        </div>
    </aside>
    
    <div class="p-4 sm:ml-64 pt-20 relative">
        <div class="flex justify-end">
            <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
            
            
        </div>
        {{ $slot }}
    </div>

    <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            const menu = document.getElementById('dropdownMenu');
            const icon = this.querySelector('svg:last-child');
            
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
        document.getElementById('user-menu-button').addEventListener('click',function () {
            const menu = document.getElementById('dropdown-user').classList.toggle('hidden'); 
            
        })
        function confirmLogout() {
                    if (confirm("Apakah Anda yakin ingin logout?")) {
                        document.getElementById("logout-form").submit();
                    }
                }
    </script>
</body>
</html>