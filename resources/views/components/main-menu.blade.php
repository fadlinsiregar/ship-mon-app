<div class="d-flex flex-nowrap" id="navigation-menu">
    <nav class="d-flex flex-column flex-shrink-0 p-3 bg-light position-fixed vh-100" style="width: 260px;"
        id="navigation-menu-sidebar">
        <a href="/" class="d-flex justify-content-center mb-3 mb-md-0 text-decoration-none">
            <h4>ShipMon</h4>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto mt-3">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ activeRoute('/') }}" aria-current="page">
                    <i class="bi bi-house"></i> Beranda
                </a>
            </li>
            @if (Auth::user()->role_id != 2)
            <li class="nav-item mt-3">
                <a href="{{ route('schedules.index') }}" class="nav-link {{ activeRoute('schedules') }}"
                    aria-current="page">
                    <i class="bi bi-calendar"></i> Jadwal
                </a>
            </li>
            @endif
            @if (request()->is('schedules/*'))
                <li class="nav-item">
                    <a class="nav-link mt-3 {{ activeRoute('schedules/*/details') }}" href="{{ route('schedules.details', $schedule->id) }}"><i class="bi bi-info-circle-fill"></i> Rincian</a>
                </li>
                @if (Auth::user()->role_id != 2)
                <li class="nav-item">
                    <a class="nav-link mt-3 {{ activeRoute('schedules/*/workers') }}" href="{{ route('schedules.workers', $schedule->id) }}"><i class="bi bi-person-lines-fill"></i> Tim Pekerja</a>
                </li>
                @endif
            @endif
        </ul>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->full_name ?? ""; }}
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">Keluar</a></li>
            </ul>
        </div>
    </nav>
    <hr>
</div>
