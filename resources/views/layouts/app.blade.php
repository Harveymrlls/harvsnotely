<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarvsNotely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/notely.css') }}">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="navbar shadow-lg shadow-lg fixed top-0 left-0 right-0 z-50 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="nav-span"><i class="fas fa-sticky-note text-2xl mr-2"></i>HarvsNotely</span>
                    </a>
                </div>


                <!-- Desktop Menu navbar -->
                @auth
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('notes.index') }}" class="navdash px-3 py-2 rounded-md transition text-base">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                    <a href="{{ route('notes.archived') }}" class="navarch px-3 py-2 rounded-md transition">
                        <i class="fas fa-archive mr-1"></i> Archived
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:bg-red-500 px-3 py-2 rounded-md transition">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="navlogin px-3 py-2 rounded-md transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="navsignup px-4 py-2 rounded-md transition">
                        Sign Up
                    </a>
                </div>
                @endauth

                <!-- Mobile menu more icon button-->
                <div class="md:hidden flex items-center">
                    <button 
                        type="button" 
                        id="mobile-menu-button"
                        class="relative inline-flex items-center justify-center p-3 
                            rounded-xl bg-[#F0E491] text-black 
                            shadow-sm transition-all duration-200 
                            hover:bg-[#F0E491] hover:shadow-md 
                            focus:outline-none focus:ring-2 focus:ring-[#7B542F]">

                        <span class="sr-only">Open main menu</span>

                        <i class="fas fa-bars text-lg transition-transform duration-200" id="menu-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu navbar -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-[#7B542F]">
                    @auth
                    <!-- Authenticated Mobile Menu -->
                    <a href="{{ route('notes.index') }}" class="navdash px-3 py-2 rounded-md transition flex mb-3">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('notes.archived') }}" class="navarch px-3 py-2 rounded-md transition flex mb-3">
                        <i class="fas fa-archive mr-2"></i>Archived Notes
                    </a>
                    <div class="border-t border-[#7B542F] pt-2 mt-2">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="hover:bg-red-500 px-3 py-2 rounded-md transition font-bold">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <!-- Guest Mobile Menu -->
                    <a href="{{ route('login') }}" class="navlogin px-3 py-2 rounded-md transition flex">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="navsignup px-4 py-2 rounded-md transition flex">
                        Sign Up
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="fixed top-20 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-0 transition-transform duration-300" id="flash-message">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <script src="{{ asset('js/notely.js') }}"></script>

</body>
</html>