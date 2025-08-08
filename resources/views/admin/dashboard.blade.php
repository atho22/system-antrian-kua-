@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="kemenag-gradient rounded-3 p-3 me-3 shadow">
                        <i class="fas fa-chart-bar text-white fs-4"></i>
                    </div>
                    <div>
                        <h1 class="display-5 fw-bold text-dark mb-1">Dashboard Admin</h1>
                        <p class="lead text-muted mb-0">Statistik dan monitoring sistem antrian</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3">
                        <p class="text-muted small mb-1">Update terakhir</p>
                        <p class="h5 fw-semibold text-dark mb-0">{{ Carbon\Carbon::now('Asia/Makassar')->format('H:i') }} WITA</p>
                    </div>
                    <div class="kemenag-secondary rounded-3 p-3 shadow">
                        <i class="fas fa-sync-alt text-white fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="kemenag-gradient mt-3" style="width: 150px; height: 4px; border-radius: 2px;"></div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="fas fa-users text-primary fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Antrian</p>
                            <h2 class="display-6 fw-bold text-dark mb-1">{{ $todayQueues }}</h2>
                            <p class="text-muted small mb-0">Hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="fas fa-check-circle text-success fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Sudah Dilayani</p>
                            <h2 class="display-6 fw-bold text-dark mb-1">{{ $todayServed }}</h2>
                            <p class="text-muted small mb-0">Hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="fas fa-clock text-warning fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Menunggu</p>
                            <h2 class="display-6 fw-bold text-dark mb-1">{{ $todayWaiting }}</h2>
                            <p class="text-muted small mb-0">Hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik per Layanan -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="h5 fw-bold text-dark mb-0">Statistik per Layanan</h3>
                        <div class="d-flex align-items-center text-muted">
                            <i class="fas fa-chart-line me-2"></i>
                            <small>Real-time</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($serviceStats as $stat)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="bg-light rounded-3 p-4 text-center h-100">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-building text-white fs-4"></i>
                                </div>
                                <h6 class="fw-semibold text-dark mb-2">{{ $stat->service->name }}</h6>
                                <h3 class="display-6 fw-bold text-primary mb-1">{{ $stat->total }}</h3>
                                <p class="text-muted small mb-0">antrian</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Antrian Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h3 class="h5 fw-bold text-dark mb-0">Antrian Terbaru</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-hashtag text-primary me-2"></i>
                                        No Antrian
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        Nama
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-building text-primary me-2"></i>
                                        Layanan
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        Estimasi
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                        Status
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-cogs text-primary me-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentQueues as $queue)
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <span class="text-white fw-bold small">{{ $queue->service->code }}</span>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ str_pad($queue->queue_number, 3, '0', STR_PAD_LEFT) }}</div>
                                                <small class="text-muted">{{ $queue->service->code }}-{{ str_pad($queue->queue_number, 3, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $queue->guest->name }}</div>
                                            <small class="text-muted">{{ $queue->guest->phone }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">{{ $queue->service->name }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $queue->formatted_time }} WITA</div>
                                            <small class="text-muted">{{ $queue->formatted_date }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        @if($queue->status == 'waiting')
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Menunggu
                                            </span>
                                        @elseif($queue->status == 'served')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-check me-1"></i>Selesai
                                            </span>
                                        @elseif($queue->status == 'skipped')
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="fas fa-times me-1"></i>Lewati
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if($queue->status == 'waiting')
                                            <div class="btn-group" role="group">
                                                <form method="POST" action="{{ route('admin.queue.status', $queue->id) }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="served">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check me-1"></i>Selesai
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.queue.status', $queue->id) }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="skipped">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times me-1"></i>Lewati
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($queue->status == 'skipped')
                                            @if($queue->can_recall)
                                                <form method="POST" action="{{ route('admin.queue.recall', $queue->id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-undo me-1"></i>Panggil Ulang
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">
                                                    <i class="fas fa-hourglass-half me-1"></i>Tunggu 2 antrian
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-inbox text-muted fs-1 mb-3"></i>
                                        <p class="text-muted">Belum ada antrian hari ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 