@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="kemenag-gradient rounded-3 p-3 me-3 shadow-sm">
                        <i class="fas fa-history text-white fs-4"></i>
                    </div>
                    <div>
                        <h1 class="display-6 fw-bold text-dark mb-1">Log Aktivitas</h1>
                        <p class="lead text-muted mb-0">Riwayat semua aktivitas sistem</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3">
                        <p class="text-muted small mb-1">Total log</p>
                        <p class="h5 fw-semibold text-dark mb-0">{{ number_format($logs->total()) }}</p>
                    </div>
                    <div class="kemenag-secondary rounded-3 p-3 shadow-sm">
                        <i class="fas fa-sync-alt text-white fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="kemenag-gradient mt-3" style="width: 150px; height: 4px; border-radius: 2px;"></div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-bold mb-0">Filter Log</h5>
                <a href="{{ route('admin.logs') }}" class="btn btn-outline-primary btn-sm px-3">
                    <i class="fas fa-sync-alt me-2"></i>Reset Filter
                </a>
            </div>
            
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">Aksi</label>
                    <select name="action" class="form-select form-select-sm">
                        <option value="">Semua Aksi</option>
                        <option value="create" @if(request('action') == 'create') selected @endif>Create</option>
                        <option value="update" @if(request('action') == 'update') selected @endif>Update</option>
                        <option value="delete" @if(request('action') == 'delete') selected @endif>Delete</option>
                        <option value="export" @if(request('action') == 'export') selected @endif>Export</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">Tabel</label>
                    <select name="table_name" class="form-select form-select-sm">
                        <option value="">Semua Tabel</option>
                        <option value="guests" @if(request('table_name') == 'guests') selected @endif>Guests</option>
                        <option value="queues" @if(request('table_name') == 'queues') selected @endif>Queues</option>
                        <option value="services" @if(request('table_name') == 'services') selected @endif>Services</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-kemenag btn-sm w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Log Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header kemenag-gradient p-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="text-white mb-1">Data Log Aktivitas</h5>
                    <p class="text-white-50 small mb-0">
                        <i class="fas fa-clock me-1"></i>
                        Update terakhir: {{ Carbon\Carbon::now('Asia/Makassar')->format('H:i') }} WITA
                    </p>
                </div>
                <div class="bg-white rounded-3 px-3 py-2">
                    <span class="text-success small fw-semibold">
                        <i class="fas fa-check-circle me-1"></i>Live
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 ps-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <span class="text-uppercase small fw-bold">Waktu</span>
                                </div>
                            </th>
                            <th class="border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-bolt text-primary me-2"></i>
                                    <span class="text-uppercase small fw-bold">Aksi</span>
                                </div>
                            </th>
                            <th class="border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-database text-primary me-2"></i>
                                    <span class="text-uppercase small fw-bold">Tabel</span>
                                </div>
                            </th>
                            <th class="border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-align-left text-primary me-2"></i>
                                    <span class="text-uppercase small fw-bold">Deskripsi</span>
                                </div>
                            </th>
                            <th class="border-0 py-3 pe-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-network-wired text-primary me-2"></i>
                                    <span class="text-uppercase small fw-bold">IP Address</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($logs as $log)
                        <tr>
                            <td class="py-3 ps-4">
                                <div class="fw-semibold text-dark">{{ Carbon\Carbon::parse($log->created_at)->timezone('Asia/Makassar')->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ Carbon\Carbon::parse($log->created_at)->timezone('Asia/Makassar')->format('H:i:s') }} WITA</small>
                            </td>
                            <td class="py-3">
                                @if($log->action == 'create')
                                    <span class="badge bg-success-subtle text-success px-2 py-1">
                                        <i class="fas fa-plus me-1"></i>Create
                                    </span>
                                @elseif($log->action == 'update')
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1">
                                        <i class="fas fa-edit me-1"></i>Update
                                    </span>
                                @elseif($log->action == 'delete')
                                    <span class="badge bg-danger-subtle text-danger px-2 py-1">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </span>
                                @else
                                    <span class="badge bg-info-subtle text-info px-2 py-1">
                                        <i class="fas fa-file-export me-1"></i>Export
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary-subtle text-primary px-2 py-1">
                                    {{ ucfirst($log->table_name) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="text-dark small">{{ $log->description }}</div>
                            </td>
                            <td class="py-3 pe-4">
                                <code class="text-muted small">{{ $log->ip_address }}</code>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-5">
                                    <i class="fas fa-history text-muted fs-1 mb-3 d-block"></i>
                                    <h6 class="fw-semibold text-dark mb-1">Tidak ada log aktivitas</h6>
                                    <p class="text-muted mb-0">Belum ada aktivitas yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="card-footer bg-white border-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Menampilkan {{ $logs->firstItem() }} sampai {{ $logs->lastItem() }}
                    dari {{ $logs->total() }} data
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Navigation -->
    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
        </a>
    </div>
</div>

<style>
.page-link {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}
.pagination {
    margin-bottom: 0;
}
.btn-kemenag {
    background: var(--kemenag-gradient);
    border: none;
    color: white;
}
.btn-kemenag:hover {
    background: var(--kemenag-dark-green);
    color: white;
}
.table > :not(caption) > * > * {
    padding: 1rem 1rem;
}
.badge {
    font-weight: 500;
}
</style>
@endsection 