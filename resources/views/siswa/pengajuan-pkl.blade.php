@extends('layouts.app')

@section('title', 'Pengajuan PKL')

@section('page-heading', 'Pengajuan PKL')

@section('content')

@php
    $daftarJurusan = [
        'Rekayasa Perangkat Lunak',
        'Desain Pemodelan dan Informasi Bangunan',
        'Akuntansi',
        'Kuliner',
        'Teknik Pendingin dan Tata Udara',
        'Teknik Konstruksi dan Perumahan',
        'Teknik Pengelasan',
    ];
@endphp

<div class="pkl-page">
    <div class="page-heading">
        <div>
            <span class="heading-label">
                <i class="ti ti-file-pencil"></i>
                PENGAJUAN PKL
            </span>
            <h1>Form Pengajuan PKL</h1>
            <p>Lengkapi data berikut untuk mengajukan Praktik Kerja Lapangan.</p>
        </div>

        <div class="heading-icon">
            <i class="ti ti-school"></i>
        </div>
    </div>

    <div class="info-banner">
        <div class="info-banner-icon">
            <i class="ti ti-info-circle"></i>
        </div>
        <div>
            <strong>Periksa kembali data kamu</strong>
            <p>Pastikan identitas, tempat PKL, dan dokumen pengajuan sudah benar sebelum dikirim.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="success-message">
            <i class="ti ti-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('siswa.pengajuan.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="formPengajuan"
          novalidate>
        @csrf

        {{-- ================= DATA DIRI ================= --}}
        <div class="form-card">
            <div class="form-card-heading">
                <div class="form-heading-icon">
                    <i class="ti ti-user"></i>
                </div>
                <div>
                    <h2>Data Diri</h2>
                    <p>Informasi identitas siswa</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-user input-icon"></i>
                        <input type="text" id="nama" name="nama"
                            value="{{ old('nama', $siswa['nama'] ?? auth()->user()->name ?? '') }}"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    @error('nama')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nis">NIS / NISN <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-id input-icon"></i>
                        <input type="text" id="nis" name="nis"
                            value="{{ old('nis', $siswa['nis'] ?? '') }}"
                            placeholder="Masukkan NIS atau NISN" required>
                    </div>
                    @error('nis')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <div class="input-wrap">
                        <i class="ti ti-school input-icon"></i>
                        <input type="text" id="kelas" name="kelas"
                            value="{{ old('kelas', $siswa['kelas'] ?? '') }}"
                            placeholder="Contoh: XI RPL C">
                    </div>
                    @error('kelas')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-code input-icon"></i>
                        <select id="jurusan" name="jurusan" required>
                            <option value="">Pilih jurusan</option>
                            @foreach ($daftarJurusan as $jurusan)
                                <option value="{{ $jurusan }}"
                                    @selected(old('jurusan', $siswa['jurusan'] ?? '') === $jurusan)>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('jurusan')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ================= TEMPAT PKL ================= --}}
        <div class="form-card">
            <div class="form-card-heading">
                <div class="form-heading-icon blue-icon">
                    <i class="ti ti-building"></i>
                </div>
                <div>
                    <h2>Tempat PKL</h2>
                    <p>Perusahaan tujuan Praktik Kerja Lapangan</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group form-group-full">
                    <label for="instansi">Nama Instansi / Tempat PKL <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-building input-icon"></i>
                        <input type="text" id="instansi" name="instansi"
                            value="{{ old('instansi') }}"
                            placeholder="Masukkan nama perusahaan" required>
                    </div>
                    @error('instansi')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ================= DOKUMEN PENGAJUAN ================= --}}
        <div class="form-card">
            <div class="form-card-heading">
                <div class="form-heading-icon purple-icon">
                    <i class="ti ti-file-text"></i>
                </div>
                <div>
                    <h2>Dokumen Pengajuan</h2>
                    <p>Unggah surat pengajuan dan laporan dalam 1 file PDF</p>
                </div>
            </div>

            <div class="upload-area" id="uploadArea">
                <input type="file" id="dokumen" name="dokumen"
                       accept=".pdf,application/pdf" required>

                <div class="upload-content" id="uploadContent">
                    <div class="upload-icon">
                        <i class="ti ti-cloud-upload"></i>
                    </div>
                    <strong>Pilih dokumen untuk diunggah</strong>
                    <p>Klik area ini atau seret file PDF ke sini</p>
                    <span>1 file PDF, maksimal 2 MB</span>
                </div>

                <div class="file-selected" id="fileSelected" hidden>
                    <div class="selected-file-icon">
                        <i class="ti ti-file-type-pdf"></i>
                    </div>
                    <div class="selected-file-info">
                        <strong id="fileName">Nama file</strong>
                        <span id="fileSize">0 KB</span>
                    </div>
                    <button type="button" id="removeFile" class="remove-file"
                            aria-label="Hapus file">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>

            <small class="error-text" id="fileError" role="alert"
                   @unless($errors->has('dokumen')) hidden @endunless>
                {{ $errors->first('dokumen') }}
            </small>

            <p class="upload-note">
                <i class="ti ti-shield-check"></i>
                Gabungkan surat pengajuan dan laporan menjadi 1 file PDF. Pastikan dokumen dapat dibuka dan berisi informasi yang benar.
            </p>
        </div>

        <div class="form-footer">
            <p><span>*</span> Wajib diisi</p>
            <button type="reset" class="btn-reset">
                <i class="ti ti-refresh"></i>
                Reset
            </button>
            <button type="submit" class="btn-submit" id="submitButton">
                Ajukan PKL
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pengajuan-pkl.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/pengajuan-pkl.js') }}"></script>
@endpush