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
            <li class="nav-item mt-3">
                <a href="{{ route('schedules.index') }}" class="nav-link {{ activeRoute('schedules') }}"
                    aria-current="page">
                    <i class="bi bi-calendar"></i> Jadwal
                </a>
                @if (request()->is('schedules/*'))
                    <nav class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link ms-3 my-2 {{ activeRoute('schedules/*/details') }}" href="{{ route('schedules.details', $schedule->id) }}"><i class="bi bi-info-circle-fill"></i> Rincian</a>
                        </li>
                    </nav>
                @endif
            </li>
        </ul>
    </nav>

</div>