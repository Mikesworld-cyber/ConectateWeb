@extends('layouts.app')

@section('title', 'Web')

@section('content')
{{-- Sección Hero --}}
<section class="hero" id="inicio">
    <canvas id="networkCanvas"></canvas>
    <div class="hero-content">
        <h1>Bienvenido a Conectate</h1>
        <p>Siempre brindando servicios de calidad y atención</p>
        <div>
            <button class="btn btn-custom">Comenzar Ahora</button>
            <button class="btn btn-custom btn-custom-secondary">Más Información</button>
        </div>
    </div>
</section>

{{-- Sección de Servicios --}}
<section class="features" id="paquetes">
    <div class="container">
        <h2 style="text-align: center; font-weight: 800; font-size: 2.5rem; margin-bottom: 60px; color: #333;">
            Nuestros Servicios
        </h2>



        <div class="row justify-content-center">


            <div class="col-12 col-md-4 mb-4">
                <div class="card pricing-card h-100 border-0 shadow-lg overflow-hidden transition-all">


                    <div class="card-header bg-gradient border-0 py-4 text-center position-relative overflow-hidden">
                        <div class="icon-wrapper mb-3">
                            <img src="{{ asset('images/iconwifi.png') }}" alt="Folder Security Icon" class="pricing-icon" style="width: 60px; height: 60px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(13, 110, 253, 0.3));">
                        </div>
                        <h3 class="card-title text-white fs-5 fw-bold mb-2">ConectaCon 150</h3>
                        <p class="text-light small mb-0 opacity-90"><i class="bi bi-lightning-charge me-1"></i>Fibra Óptica</p>
                    </div>


                    <div class="separator-line"></div>


                    <div class="price-section text-center py-4 position-relative">
                        <div class="price-badge">
                            <h4 class="display-4 text-primary fw-bold mb-0">$150</h4>
                            <small class="text-secondary fw-500">/mes</small>
                        </div>
                    </div>


                    <div class="card-body px-4 py-3">
                        <ul class="list-unstyled features-list">
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-lightning-fill"></i>
                                </span>
                                <span class="feature-text">Velocidad: hasta <strong>10 Mbps / 20 Mbps</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="feature-text">Plan <strong>ideal básico</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-wifi"></i>
                                </span>
                                <span class="feature-text"><strong>FTTH</strong> Fibra hasta tu hogar</span>
                            </li>

                        </ul>
                    </div>


                    <div class="card-footer bg-transparent border-top-0 p-4 pt-2">
                        <a href="#" class="btn btn-gradient w-100 fw-bold py-3 rounded-3 shadow-sm transition-transform">
                            <i class="bi bi-lightning-charge me-2"></i>CONTRATAR AHORA
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-4">
                <div class="card pricing-card h-100 border-0 shadow-lg overflow-hidden transition-all">

                    <span class="badge bg-gradient-primary position-absolute top-0 start-50 translate-middle rounded-pill px-3 py-2 fw-bold" style="z-index: 10;">
                        ⭐ MÁS POPULAR
                    </span>


                    <div class="card-header bg-gradient border-0 py-4 text-center position-relative overflow-hidden">
                        <div class="icon-wrapper mb-3">
                            <img src="{{ asset('images/iconwifi.png') }}" alt="Folder Security Icon" class="pricing-icon" style="width: 60px; height: 60px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(13, 110, 253, 0.3));">
                        </div>
                        <h3 class="card-title text-white fs-5 fw-bold mb-2">ConectaCon 250</h3>
                        <p class="text-light small mb-0 opacity-90"><i class="bi bi-lightning-charge me-1"></i>Fibra Óptica</p>
                    </div>


                    <div class="separator-line"></div>


                    <div class="price-section text-center py-4 position-relative">
                        <div class="price-badge">
                            <h4 class="display-4 text-primary fw-bold mb-0">$250</h4>
                            <small class="text-secondary fw-500">/mes</small>
                        </div>
                    </div>


                    <div class="card-body px-4 py-3">
                        <ul class="list-unstyled features-list">
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-lightning-fill"></i>
                                </span>
                                <span class="feature-text">Velocidad: hasta <strong> 10 Mbps / 40 Mbps</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="feature-text">Plan <strong>Estandar</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-wifi"></i>
                                </span>
                                <span class="feature-text"><strong>FTTH</strong> Fibra hasta tu hogar</span>
                            </li>

                        </ul>
                    </div>


                    <div class="card-footer bg-transparent border-top-0 p-4 pt-2">
                        <a href="#" class="btn btn-gradient w-100 fw-bold py-3 rounded-3 shadow-sm transition-transform">
                            <i class="bi bi-lightning-charge me-2"></i>CONTRATAR AHORA
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-4 mb-4">
                <div class="card pricing-card h-100 border-0 shadow-lg overflow-hidden transition-all">


                    <div class="card-header bg-gradient border-0 py-4 text-center position-relative overflow-hidden">
                        <div class="icon-wrapper mb-3">
                            <img src="{{ asset('images/iconwifi.png') }}" alt="Folder Security Icon" class="pricing-icon" style="width: 60px; height: 60px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(13, 110, 253, 0.3));">
                        </div>
                        <h3 class="card-title text-white fs-5 fw-bold mb-2">ConectaCon 300</h3>
                        <p class="text-light small mb-0 opacity-90"><i class="bi bi-lightning-charge me-1"></i>Fibra Óptica</p>
                    </div>


                    <div class="separator-line"></div>


                    <div class="price-section text-center py-4 position-relative">
                        <div class="price-badge">
                            <h4 class="display-4 text-primary fw-bold mb-0">$300</h4>
                            <small class="text-secondary fw-500">/mes</small>
                        </div>
                    </div>

                    <!-- Lista de Características -->
                    <div class="card-body px-4 py-3">
                        <ul class="list-unstyled features-list">
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-lightning-fill"></i>
                                </span>
                                <span class="feature-text">Velocidad: hasta <strong>20 Mbps / 50 Mbps</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="feature-text">Plan <strong>Fuerte</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-wifi"></i>
                                </span>
                                <span class="feature-text"><strong>FTTH</strong> Fibra hasta tu hogar</span>
                            </li>

                        </ul>
                    </div>


                    <div class="card-footer bg-transparent border-top-0 p-4 pt-2">
                        <a href="#" class="btn btn-gradient w-100 fw-bold py-3 rounded-3 shadow-sm transition-transform">
                            <i class="bi bi-lightning-charge me-2"></i>CONTRATAR AHORA
                        </a>
                    </div>
                </div>
            </div>
            {{-- Servicio 3: Finger Print Security --}}


            <div class="col-12 col-md-4 mb-4">
                <div class="card pricing-card h-100 border-0 shadow-lg overflow-hidden transition-all">

                    <div class="card-header bg-gradient border-0 py-4 text-center position-relative overflow-hidden">
                        <div class="icon-wrapper mb-3">
                            <img src="{{ asset('images/iconwifi.png') }}" alt="Folder Security Icon" class="pricing-icon" style="width: 60px; height: 60px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(13, 110, 253, 0.3));">
                        </div>
                        <h3 class="card-title text-white fs-5 fw-bold mb-2">ConectaCon 350</h3>
                        <p class="text-light small mb-0 opacity-90"><i class="bi bi-lightning-charge me-1"></i>Fibra Óptica</p>
                    </div>


                    <div class="separator-line"></div>


                    <div class="price-section text-center py-4 position-relative">
                        <div class="price-badge">
                            <h4 class="display-4 text-primary fw-bold mb-0">$350</h4>
                            <small class="text-secondary fw-500">/mes</small>
                        </div>
                    </div>

                    <div class="card-body px-4 py-3">
                        <ul class="list-unstyled features-list">
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-lightning-fill"></i>
                                </span>
                                <span class="feature-text">Velocidad: hasta <strong>50 Mbps / 60 Mbps</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="feature-text">Plan <strong>Extraordinario</strong></span>
                            </li>
                            <li class="feature-item mb-3">
                                <span class="feature-icon">
                                    <i class="bi bi-wifi"></i>
                                </span>
                                <span class="feature-text"><strong>FTTH</strong> Fibra hasta tu hogar</span>
                            </li>

                        </ul>
                    </div>


                    <div class="card-footer bg-transparent border-top-0 p-4 pt-2">
                        <a href="#" class="btn btn-gradient w-100 fw-bold py-3 rounded-3 shadow-sm transition-transform">
                            <i class="bi bi-lightning-charge me-2"></i>CONTRATAR AHORA
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection