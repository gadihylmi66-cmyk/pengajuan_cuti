@extends('layouts.app')

@section('content')
<style>
    .cuti-dashboard {
        max-width: 1080px;
        margin: 2.5rem auto;
        padding: 0 1rem;
    }

    .hero-card {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        color: #ffffff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 30px 60px rgba(18, 76, 161, 0.16);
    }

    .hero-card h1 {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }

    .hero-card p {
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.75;
    }

    .page-grid {
        display: grid;
        gap: 1.5rem;
    }

    @media (min-width: 992px) {
        .page-grid {
            grid-template-columns: 1.15fr 0.85fr;
        }
    }

    .panel {
        background: #ffffff;
        border-radius: 1.25rem;
        padding: 1.75rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
    }

    .panel h2 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .panel small {
        color: #6b7280;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #111827;
    }

    .form-control,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 0.95rem;
        border: 1px solid #d1d5db;
        padding: 0.95rem 1rem;
        font-size: 0.98rem;
        background: #f9fafb;
        color: #111827;
        outline: none;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-control:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        background: #ffffff;
    }

    .form-textarea {
        min-height: 160px;
        resize: vertical;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.95rem 1.5rem;
        border-radius: 0.95rem;
        border: none;
        background: #4f46e5;
        color: #ffffff;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.2s ease;
        box-shadow: 0 18px 32px rgba(79, 70, 229, 0.18);
    }

    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-1px);
    }

    .status-card {
        border-radius: 1.25rem;
        overflow: hidden;
    }

    .status-card header {
        background: #f8fafc;
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .status-card header h3 {
        margin: 0;
        font-size: 1.1rem;
    }

    .status-card .status-list {
        display: grid;
        gap: 1rem;
        padding: 1.5rem;
    }

    .status-item {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.2rem;
        background: #ffffff;
    }

    .status-item strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 0.45rem;
    }

    .status-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.65rem;
        margin-bottom: 0.8rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge.approved {
        background: #dcfce7;
        color: #166534;
    }

    .badge.rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-item p {
        margin: 0;
        color: #4b5563;
        line-height: 1.7;
    }

    .support-note {
        background: #eef2ff;
        color: #3730a3;
        padding: 1rem 1.2rem;
        border-radius: 1rem;
        margin-top: 1.5rem;
        border: 1px solid #c7d2fe;
    }
</style>

<div class="cuti-dashboard">
    <div class="hero-card">
        <h1>Ajukan Cuti &amp; Lihat Konfirmasi Admin</h1>
        <p>Isi form pengajuan cuti di sebelah kiri. Hasil konfirmasi oleh admin akan terlihat di daftar di sebelah kanan.</p>
    </div>

    <div class="page-grid mt-5">
        <section class="panel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>Form Pengajuan Cuti</h2>
                    <small>Lengkapi informasi cuti Anda dengan jelas.</small>
                </div>
            </div>

            <form>
                <div class="form-group">
                    <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                    <select id="jenis_cuti" class="form-select" name="jenis_cuti">
                        <option selected>Pilih jenis cuti</option>
                        <option value="tahunan">Cuti Tahunan</option>
                        <option value="sakit">Cuti Sakit</option>
                        <option value="besar">Cuti Besar</option>
                        <option value="lainnya">Cuti Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" id="mulai" class="form-control" name="mulai" />
                </div>

                <div class="form-group">
                    <label for="selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" id="selesai" class="form-control" name="selesai" />
                </div>

                <div class="form-group">
                    <label for="alasan" class="form-label">Alasan Cuti</label>
                    <textarea id="alasan" class="form-textarea" name="alasan" placeholder="Tuliskan alasan cuti Anda"></textarea>
                </div>

                <div class="form-group">
                    <label for="kontak" class="form-label">Kontak Darurat</label>
                    <input type="text" id="kontak" class="form-control" name="kontak" placeholder="0812xxxxxxx" />
                </div>

                <button type="submit" class="btn-primary">Kirim Pengajuan</button>
            </form>
        </section>

        <section class="status-card">
            <header>
                <h3>Status Cuti Anda</h3>
                <small>Ringkasan hasil konfirmasi admin.</small>
            </header>

            <div class="status-list">
                <article class="status-item">
                    <div class="status-meta">
                        <span class="badge pending">Menunggu</span>
                        <span>Pengajuan: 8 April 2026</span>
                        <span>Durasi: 3 hari</span>
                    </div>
                    <strong>Cuti Tahunan</strong>
                    <p>Administrasi sedang meninjau permintaan cuti Anda. Silakan cek kembali beberapa saat lagi.</p>
                </article>

                <article class="status-item">
                    <div class="status-meta">
                        <span class="badge approved">Disetujui</span>
                        <span>Pengajuan: 26 Maret 2026</span>
                        <span>Durasi: 2 hari</span>
                    </div>
                    <strong>Cuti Sakit</strong>
                    <p>Admin telah menyetujui cuti Anda. Silakan siapkan bukti jika diperlukan saat kembali bekerja.</p>
                </article>

                <article class="status-item">
                    <div class="status-meta">
                        <span class="badge rejected">Ditolak</span>
                        <span>Pengajuan: 10 Maret 2026</span>
                        <span>Durasi: 1 hari</span>
                    </div>
                    <strong>Cuti Lainnya</strong>
                    <p>Permintaan tersebut ditolak karena jadwal operasional. Coba ajukan kembali dengan tanggal berbeda.</p>
                </article>
            </div>

            <div class="support-note">
                <strong>Catatan:</strong> Setelah form dikirim, admin akan melakukan verifikasi dan hasil konfirmasi akan muncul di daftar status di atas.
            </div>
        </section>
    </div>
</div>
@endsection
