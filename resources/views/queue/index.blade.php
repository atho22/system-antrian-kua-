@extends('layouts.queue_display')
@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="kemenag-gradient rounded-3 p-3 me-3 shadow-sm">
                        <i class="fas fa-list-ol text-white fs-4"></i>
                    </div>
                    <div>
                        <h1 class="display-6 fw-bold text-dark mb-1">Daftar Antrian</h1>
                        <p class="lead text-muted mb-0">Monitor antrian real-time untuk semua layanan</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3">
                        <p class="text-muted small mb-1">Update terakhir</p>
                        <p class="h5 fw-semibold text-dark mb-0">{{ Carbon\Carbon::now('Asia/Makassar')->format('H:i') }} WITA</p>
                    </div>
                    <div class="kemenag-secondary rounded-3 p-3 shadow-sm">
                        <i class="fas fa-sync-alt text-white fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="kemenag-gradient mt-3" style="width: 150px; height: 4px; border-radius: 2px;"></div>
        </div>
    </div>

    <div class="row g-4">
        @foreach($services as $service)
            @php
                $currentQueue = $queues->where('service_id', $service->id)
                    ->where('status', 'waiting')
                    ->sortBy('queue_number')
                    ->first();
                
                $nextQueue = $queues->where('service_id', $service->id)
                    ->where('status', 'waiting')
                    ->where('queue_number', '>', optional($currentQueue)->queue_number ?? 0)
                    ->sortBy('queue_number')
                    ->first();
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header kemenag-gradient border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-3 p-2 me-3">
                                    <span class="fw-bold text-primary">{{ $service->code }}</span>
                                </div>
                                <h5 class="text-white mb-0 fw-bold">{{ $service->name }}</h5>
                            </div>
                            <div class="bg-white rounded-3 px-2 py-1">
                                <span class="text-success small">
                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h6 class="text-muted mb-3">SEDANG DILAYANI</h6>
                            <div class="display-1 fw-bold text-primary mb-2">
                                @if($currentQueue)
                                    {{ $service->code }}-{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}
                                @else
                                    -
                                @endif
                            </div>
                            @if($currentQueue)
                                <div class="text-muted">
                                    <div class="mb-1">{{ $currentQueue->guest->name }}</div>
                                    <div>Estimasi: {{ $currentQueue->formatted_time }} WITA</div>
                                </div>
                            @endif
                        </div>

                        <div class="text-center">
                            <h6 class="text-muted mb-3">ANTRIAN SELANJUTNYA</h6>
                            <div class="h2 fw-bold text-success mb-2">
                                @if($nextQueue)
                                    {{ $service->code }}-{{ str_pad($nextQueue->queue_number, 3, '0', STR_PAD_LEFT) }}
                                @else
                                    -
                                @endif
                            </div>
                            @if($nextQueue)
                                <div class="text-muted">
                                    <div class="mb-1">{{ $nextQueue->guest->name }}</div>
                                    <div>Estimasi: {{ $nextQueue->formatted_time }} WITA</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <div>
                                <i class="fas fa-users me-1"></i>
                                {{ $queues->where('service_id', $service->id)->where('status', 'waiting')->count() }} menunggu
                            </div>
                            <div>
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $queues->where('service_id', $service->id)->where('status', 'served')->count() }} selesai
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function refreshPage() {
            location.reload();
        }
        // Refresh setiap 30 detik
        setInterval(refreshPage, 15000);
    </script>
</div>
@endsection