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

            <a href="{{ route('contratos.index', ['request' => 'paquetes']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'paquetes' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">inventory_2</span>
                <span>Paquetes</span>
            </a>

            <a href="{{ route('contratos.index', ['request' => 'promociones']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'promociones' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">campaign</span>
                <span>Promociones</span>
            </a>
  <a href="{{ route('contratos.index', ['request' => 'calendario']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'calendario' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">description</span>
                <span>Calendario</span>
            </a>
            <a href="{{ route('contratos.index', ['request' => 'contratos']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'contratos' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">description</span>
                <span>Contratos</span>
            </a>
            <a href="{{ route('contratos.index', ['request' => 'ganancias']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'ganancias' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">trending_up</span>
                <span>Ventas</span>
            </a>
                 <a href="{{ route('contratos.index', ['request' => 'pagos']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'pagos' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">payments</span>
                <span>Pagos</span>
            </a>
                       <a href="{{ route('contratos.index', ['request' => 'tickets']) }}"
                class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none 
            {{ request()->routeIs('contratos.index') && request('request') == 'tickets' ? 'bg-primary text-white' : 'text-secondary hover-bg' }}">
                <span class="material-symbols-outlined" translate="no">support_agent</span>
                <span>Tickets</span>
            </a>
        </nav>
    </div>
</aside>