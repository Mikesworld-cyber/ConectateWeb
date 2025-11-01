<aside class="p-4 d-flex flex-column justify-content-between">
    <div>
        <h1 class="fs-5 fw-bold text-dark mb-4">Admin Panel</h1>
        <nav class="d-flex flex-column gap-2">
            <a href="{{ route('dashboard') }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">home</span>
                <span>Inicio</span>
            </a>

            <a href="{{ route('contratos.index', ['request' => 'clientes']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'clientes' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">group</span>
                <span>Clientes</span>
            </a>

            <a href="{{ route('contratos.index', ['request' => 'registros']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'registros' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">inventory_2</span>
                <span>Paquetes</span>
            </a>

            <a href="{{ route('contratos.index', ['request' => 'promociones']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'promociones' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">campaign</span>
                <span>Promociones</span>
            </a>

            <a href="{{ route('contratos.index', ['request' => 'contratos']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'contratos' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">description</span>
                <span>Contratos</span>
            </a>
        </nav>
    </div>
</aside>