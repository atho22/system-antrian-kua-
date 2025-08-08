@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Success Header -->
            <div class="text-center mb-5 no-print">
                <div class="d-inline-flex align-items-center justify-content-center kemenag-gradient rounded-4 p-4 mb-4 shadow">
                    <i class="fas fa-check-circle text-white fs-1"></i>
                </div>
                <h1 class="display-4 fw-bold text-dark mb-3">Antrian Berhasil Dibuat!</h1>
                <p class="lead text-muted">Terima kasih telah mendaftar di sistem antrian kami</p>
                <div class="kemenag-gradient mx-auto" style="width: 100px; height: 4px; border-radius: 2px;"></div>
            </div>

            <!-- Thermal Print Section -->
            <div id="thermal-print" class="text-center">
                <div class="print-content">
                    <div class="text-center mb-2">
                        =====================================
                    </div>
                    
                    <div class="text-center mb-2">
                        KUA BANJARMASIN UTARA
                    </div>

                    <div class="text-center mb-4">
                        =====================================
                    </div>

                    <div class="text-center mb-2">
                        NOMOR ANTRIAN
                    </div>

                    <div class="text-center queue-number mb-2">
                        {{ $queue->service->code }}-{{ str_pad($queue->queue_number, 3, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="text-center mb-2">
                        {{ $queue->service->name }}
                    </div>

                    <div class="text-center mb-4">
                        {{ $queue->formatted_time }}
                    </div>

                    <div class="text-center">
                        -------------------------------------
                    </div>

                    <div class="text-center small-text">
                        {{ Carbon\Carbon::now('Asia/Makassar')->format('d/m/Y H:i') }} WITA
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2 justify-content-center mt-4 no-print">
                <button onclick="printTicket()" class="btn btn-primary">
                    <i class="fas fa-print me-2"></i>Cetak Nomor Antrian
                </button>
                <a href="{{ route('guest.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-2"></i>Ambil Antrian Baru
                </a>
            </div>
        </div>
    </div>
</div>

<style>
@media screen {
    #thermal-print {
        width: 58mm;
        margin: auto;
        padding: 8mm;
        border: 1px dashed #ddd;
        border-radius: 0.5rem;
        font-family: monospace;
    }
}

@media print {
    @page {
        margin: 0;
        size: 58mm auto;
    }

    body {
        margin: 0;
        padding: 0;
        width: 58mm;
    }

    #thermal-print {
        width: 58mm;
        padding: 0;
        margin: 0;
        font-family: monospace;
    }

    .print-content {
        padding: 3mm;
    }

    .no-print {
        display: none !important;
    }

    .queue-number {
        font-size: 45px;
        font-weight: bold;
        line-height: 1.2;
    }

    div {
        font-size: 12px;
        margin: 0;
        line-height: 1.2;
    }

    .small-text {
        font-size: 10px;
    }
}
</style>

<script>
function printTicket() {
    window.print();
}
</script>
@endsection 
