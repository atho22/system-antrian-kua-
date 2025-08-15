@extends('layouts.app')

@section('content')
    <div class="row justify-content-center m-0 p-0">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="text-center mb-5">
                <div
                    class="d-inline-flex align-items-center justify-content-center kemenag-gradient rounded-4 p-4 mb-4 shadow">
                    <i class="fas fa-user-plus text-white fs-1"></i>
                </div>
                <h1 class="display-4 fw-bold text-dark mb-3">Buku Tamu & Ambil Antrian</h1>
                <p class="lead text-muted">Silakan isi data diri Anda untuk mengambil nomor antrian</p>
                <div class="kemenag-gradient mx-auto" style="width: 100px; height: 4px; border-radius: 2px;"></div>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-header kemenag-gradient text-white py-4">
                    <h2 class="h3 fw-bold mb-1">Form Pendaftaran</h2>
                    <p class="mb-0 opacity-75">Kementerian Agama Republik Indonesia</p>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" id="guestForm">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-user text-primary me-2"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="Masukkan nama lengkap Anda" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-phone text-primary me-2"></i>
                                Nomor Telepon
                            </label>
                            <input type="text" name="phone" class="form-control form-control-lg"
                                placeholder="Masukkan nomor telepon Anda">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                Alamat
                            </label>
                            <input type="text" name="address" class="form-control form-control-lg"
                                placeholder="Masukkan alamat lengkap">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-camera text-primary me-2"></i>
                                Foto Muka
                            </label>
                            <div class="border rounded-3 p-4">
                                <div class="d-flex flex-column flex-md-row gap-4">
                                    <div class="col">
                                        <div class="ratio ratio-4x3 bg-light rounded-3 mb-3">
                                            <video id="webcam" class="rounded-3 w-100" playsinline autoplay></video>
                                        </div>
                                        <button type="button" id="captureBtn" class="btn btn-primary w-100">
                                            <i class="fas fa-camera me-2"></i>Ambil Foto
                                        </button>
                                    </div>

                                    <div class="col">
                                        <div class="ratio ratio-4x3 bg-light rounded-3 mb-3">
                                            <canvas id="canvas" class="rounded-3 w-100"></canvas>
                                        </div>
                                        <button type="button" id="retakeBtn" class="btn btn-outline-primary w-100" disabled>
                                            <i class="fas fa-redo me-2"></i>Ambil Ulang
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="photo" id="photoInput" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-building text-primary me-2"></i>
                                Pilih Layanan
                            </label>
                            <select name="service_id" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-kemenag btn-lg" id="submitBtn" disabled>
                                <i class="fas fa-plus me-3"></i>
                                Ambil Antrian
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card bg-light border-0 mt-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start">
                        <div class="kemenag-gradient rounded-3 p-3 me-3 shadow">
                            <i class="fas fa-info-circle text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="h5 fw-bold text-dark mb-3">Informasi Penting</h3>
                            <div class="text-muted">
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center mb-2">
                                        <div class="bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                                        <span>Pastikan data yang diisi sudah benar dan lengkap</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <div class="bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                                        <span>Foto wajah akan digunakan untuk verifikasi identitas</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <div class="bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                                        <span>Nomor antrian akan diberikan secara otomatis</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                                        <span>Simpan nomor antrian Anda dengan baik</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #webcam,
        #canvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: #f8f9fa;
        }

        .ratio-4x3 {
            aspect-ratio: 4/3;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const captureBtn = document.getElementById('captureBtn');
            const retakeBtn = document.getElementById('retakeBtn');
            const submitBtn = document.getElementById('submitBtn');
            const photoInput = document.getElementById('photoInput');
            const ctx = canvas.getContext('2d');
            let stream = null;

            // Start webcam
            async function startWebcam() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            width: { ideal: 1280 },
                            height: { ideal: 960 },
                            facingMode: & quot; user& quot;
                    }
            });
        video.srcObject = stream;
        } catch (err) {
            console.error(& quot;Error accessing webcam:& quot;, err);
            alert(& quot;Tidak dapat mengakses kamera.Pastikan kamera tersedia dan izin diberikan.& quot;);
        }
    }

        // Initialize webcam
        startWebcam();

        // Capture photo
        captureBtn.addEventListener(&#39; click &#39;, function() {
            // Set canvas size to match video dimensions
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw video frame to canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas to base64 data URL
            const photoData = canvas.toDataURL(&#39; image / jpeg &#39;, 0.8);
            photoInput.value = photoData;

            // Enable/disable buttons
            retakeBtn.disabled = false;
            submitBtn.disabled = false;
            captureBtn.disabled = true;
        });

        // Retake photo
        retakeBtn.addEventListener(&#39; click &#39;, function() {
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            photoInput.value = &#39;&#39;;

            // Reset buttons
            retakeBtn.disabled = true;
            submitBtn.disabled = true;
            captureBtn.disabled = false;
        });

        // Clean up on page unload
        window.addEventListener(&#39; beforeunload &#39;, function() {
            if (stream) {
                stream.getTracks().forEach(track =& gt; track.stop());
            }
        });
    });
    </script>
@endsection