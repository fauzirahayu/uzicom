<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cara Daftar Haji - Jamaah Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="contern/dasboard/index.css" />
</head>

<body>
    <div class="conten">

        <div class="main-content">
            <h2><i class="bi bi-info-circle"></i> Cara Daftar Haji</h2>
            <p>Panduan lengkap untuk mendaftar haji melalui sistem kami</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="bi bi-list-ol"></i> Langkah-langkah Pendaftaran Haji</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionCaraDaftar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <strong>1. Persiapan Dokumen</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Siapkan dokumen-dokumen berikut:</p>
                                            <ul>
                                                <li>KTP (Kartu Tanda Penduduk)</li>
                                                <li>KK (Kartu Keluarga)</li>
                                                <li>Paspor (jika sudah ada)</li>
                                                <li>Buku Nikah (untuk yang sudah menikah)</li>
                                                <li>Akte Kelahiran</li>
                                                <li>Foto berwarna ukuran 4x6 cm (5 lembar)</li>
                                                <li>Buku Tabungan Haji</li>
                                                <li>Surat Keterangan Sehat dari dokter</li>
                                            </ul>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <strong>2. Datang ke Kantor Kemenag</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Datang langsung ke kantor Kementerian Agama Kabupaten/Kota setempat dengan membawa dokumen yang telah disiapkan.</p>
                                            <p>Pastikan Anda datang pada jam kerja kantor (Senin-Jumat, 08.00-16.00 WIB).</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <strong>3. Isi Formulir Pendaftaran</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Lengkapi formulir pendaftaran yang disediakan di kantor dengan data:</p>
                                            <ul>
                                                <li>Data pribadi (nama, alamat, pekerjaan)</li>
                                                <li>Data keluarga (suami/istri, anak)</li>
                                                <li>Data kesehatan</li>
                                                <li>Pilihan paket haji</li>
                                                <li>Informasi pembimbing (jika ada)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <strong>4. Serahkan Dokumen</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Serahkan dokumen asli dan fotokopi yang telah disiapkan kepada petugas pendaftaran.</p>
                                            <p>Petugas akan memverifikasi kelengkapan dokumen Anda.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <strong>5. Pembayaran dan Setoran Awal</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Lakukan pembayaran setoran awal haji sesuai dengan ketentuan yang berlaku.</p>
                                            <ul>
                                                <li>Pembayaran dapat dilakukan melalui bank atau loket pembayaran di kantor Kemenag</li>
                                                <li>Simpan bukti pembayaran sebagai arsip</li>
                                                <li>Setoran awal akan disimpan di rekening khusus haji</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            <strong>6. Verifikasi dan Penerbitan Nomor Porsi</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionCaraDaftar">
                                        <div class="accordion-body">
                                            <p>Tunggu proses verifikasi dari kantor Kemenag:</p>
                                            <ul>
                                                <li>Verifikasi dokumen dan data (1-7 hari kerja)</li>
                                                <li>Penerbitan nomor porsi haji</li>
                                                <li>Pemberian buku panduan manasik haji</li>
                                                <li>Informasi jadwal keberangkatan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5><i class="bi bi-question-circle"></i> Pertanyaan Umum</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionFAQ">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" aria-expanded="false" aria-controls="faqOne">
                                            Berapa biaya pendaftaran haji?
                                        </button>
                                    </h2>
                                    <div id="faqOne" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                        <div class="accordion-body">
                                            Biaya haji reguler tahun 2025 (1446 H) adalah rata-rata Rp55,4 juta yang dibayarkan oleh jemaah, dengan total biaya penyelenggaraan ibadah haji (BPIH) sebesar Rp89,41 juta per jemaah.
                                            Biaya haji plus 2025 berkisar antara USD 11.500 hingga USD 20.500 (sekitar Rp 186,7 juta hingga Rp 332,8 juta), meskipun harga bisa bervariasi tergantung paket dan penyelenggara perjalanan haji (PIHK). Uang muka (DP) untuk mendaftar biasanya sebesar USD 4.500 hingga USD 5.000 untuk mendapatkan nomor porsi.
                                        </div>
                                    </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                                                Berapa lama proses pendaftaran?
                                            </button>
                                        </h2>
                                        <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body">
                                                Proses pendaftaran biasanya memakan waktu 1-3 hari kerja untuk verifikasi dokumen. Waktu tunggu keberangkatan tergantung antrian dan kuota haji setiap tahunnya.

                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
                                                Apakah bisa mendaftar untuk keluarga?
                                            </button>
                                        </h2>
                                        <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body">
                                                Ya, Anda dapat mendaftar untuk diri sendiri dan keluarga. Pastikan semua anggota keluarga memenuhi syarat dan memiliki dokumen yang lengkap.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5><i class="bi bi-geo-alt"></i> Lokasi Pendaftaran</h5>
                            </div>
                            <div class="card-body">
                                <p>Untuk mendaftar haji, silakan datang langsung ke kantor pemerintah setempat atau Kementerian Agama di daerah Anda.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Kantor Kementerian Agama Kabupaten/Kota</h6>
                                        <p>Cari alamat kantor Kemenag terdekat di daerah Anda melalui website resmi Kementerian Agama atau telepon ke nomor hotline.</p><br>
                                        <p>atau Jalan Lapangan Banteng Barat No. 3-4 Jakarta Pusat 10710</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Persyaratan Umum</h6>
                                        <ul>
                                            <li>Warga Negara Indonesia</li>
                                            <li>Beragama Islam</li>
                                            <li>Berusia minimal 18 tahun atau sudah menikah</li>
                                            <li>Mampu secara fisik dan mental</li>
                                            <li>Mempunyai biaya yang cukup</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h5>Ikuti Kami</h5>
                                <p>Temukan informasi lebih lanjut melalui platform resmi kami:</p>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <a href="https://x.com/informasi_haji" target="_blank" class="btn btn-outline-primary mx-2 my-1" title="X (Twitter)">
                                        <i class="bi bi-twitter-x">X</i>
                                    </a>
                                    <a href="https://www.facebook.com/phu.informasihaji/" target="_blank" class="btn btn-outline-primary mx-2 my-1" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://www.youtube.com/channel/UCQQGJ4TfqXGt7UIhKuYAC6Q" target="_blank" class="btn btn-outline-danger mx-2 my-1" title="YouTube">
                                        <i class="bi bi-youtube"></i>
                                    </a>
                                    <a href="https://www.instagram.com/informasihaji/" target="_blank" class="btn btn-outline-danger mx-2 my-1" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="https://play.google.com/store" target="_blank" class="btn btn-outline-success mx-2 my-1" title="Google Play Store">
                                        <i class="bi bi-google-play"></i>
                                    </a>
                                </div>
                                <p class="mt-3"><strong>Kontak Kami:</strong><br>

                                    Telp: (021) 7662023<br>
                                    Whatsapp: 082123213121</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>