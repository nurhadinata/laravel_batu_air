<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('admin.index') }}" class="nav-link {{ Request::is('admin/*') || Request::is('admin')  ? !Request::is('admin/kuantitas') && !Request::is('admin/waktu-sampling')? 'active' : '' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Kualitas</p>
    </a>
    {{-- <a href="{{ route('admin.kuantitas') }}" class="nav-link {{ Request::is('admin/kuantitas') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Kuantitas</p>
    </a> --}}
    <a href="{{ route('admin.waktu-sampling') }}" class="nav-link {{ Request::is('admin/waktu-sampling') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clock"></i>
        <p>Waktu Sampling</p>
    </a>
</li>
