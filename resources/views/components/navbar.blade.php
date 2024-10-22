<nav
    class="fixed inset-y-0 left-0 lg:w-64 w-full bg-[#1D3557] text-white flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full z-50">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden flex justify-between items-center p-4 bg-[#1D3557]">
        <h2 class="text-white text-xl font-bold">Menu</h2>
        <button id="navbar-toggle" class="focus:outline-none text-white">
            <!-- Hamburger Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Menu Items -->
    <div id="navbar-content" class="flex-1 overflow-y-auto px-4 mt-20 space-y-4 lg:block hidden">
        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center text-gray-300 hover:bg-[#457B9D] px-3 py-2 rounded-md text-base font-medium transition duration-300">
            <!-- Dashboard Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="h-5 w-5 mr-2 feather feather-home">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Home
        </a>

        <!-- Example Conditional Navigation for Different Roles -->
        <ul class="flex flex-col space-y-2">
            @if (Auth::user()->tipo === 'administrador')
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center text-white hover:bg-[#457B9D] px-3 py-2 rounded-md text-base font-medium transition duration-300">
                        <!-- Admin Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Cadastrar Usuário
                    </a>
                </li>
            @elseif (Auth::user()->tipo === 'vendedor')
                <li>
                    <a href="{{ route('vendedor.dashboard') }}"
                        class="flex items-center text-white hover:bg-[#457B9D] px-3 py-2 rounded-md text-base font-medium transition duration-300">
                        <!-- Vendedor Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-layout">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                        Dashboard
                    </a>
                </li>
            @elseif (Auth::user()->tipo === 'transportadora')
                <li>
                    <a href="{{ route('transportadora.dashboard') }}"
                        class="flex items-center text-white hover:bg-[#457B9D] px-3 py-2 rounded-md text-base font-medium transition duration-300">
                        <!-- Transport Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-layout">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                        Dashboard
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Logout Button Fixed at Bottom -->
    <div class="p-6 mt-auto hidden lg:block">
        <form id="logoutUserForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button  type="submit"
                class="logoutButton inline-flex items-center px-5 py-3 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition duration-300">
                <!-- Logout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.logoutButton').addEventListener('click', function(e) {
        e.preventDefault();

        const form = this.closest('form');

        Swal.fire({
            title: 'Tem certeza?',
            text: "Você será desconectado.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, sair!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>


<script>
    // Toggle sidebar on mobile
    const toggleButton = document.getElementById('navbar-toggle');
    const navbarContent = document.getElementById('navbar-content');

    toggleButton.addEventListener('click', () => {
        navbarContent.classList.toggle('hidden');
    });
</script>
