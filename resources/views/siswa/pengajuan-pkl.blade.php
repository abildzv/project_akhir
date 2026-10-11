
@extends('layouts.app')

@section('title', 'Pengajuan PKL')

@section('page-heading', 'Pengajuan PKL')

@section('content')

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

    <form action="{{ url('/pengajuan-pkl') }}"
          method="POST"
          enctype="multipart/form-data"
          id="formPengajuan">
        @csrf

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
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-code input-icon"></i>
                        <select id="jurusan" name="jurusan" required>
                            <option value="">Pilih jurusan</option>
                            <option value="Rekayasa Perangkat Lunak"
                                @selected(old('jurusan') == 'Rekayasa Perangkat Lunak')>
                                Rekayasa Perangkat Lunak
                            </option>
                            <option value="Teknik Komputer dan Jaringan"
                                @selected(old('jurusan') == 'Teknik Komputer dan Jaringan')>
                                Teknik Komputer dan Jaringan
                            </option>
                            <option value="Multimedia"
                                @selected(old('jurusan') == 'Multimedia')>
                                Multimedia
                            </option>
                        </select>
                    </div>
                    @error('jurusan')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-heading">
                <div class="form-heading-icon blue-icon">
                    <i class="ti ti-building"></i>
                </div>
                <div>
                    <h2>Informasi Tempat PKL</h2>
                    <p>Detail perusahaan dan periode pelaksanaan</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
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

                <div class="form-group">
                    <label for="alamat">Alamat Instansi <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-map-pin input-icon"></i>
                        <input type="text" id="alamat" name="alamat"
                            value="{{ old('alamat') }}"
                            placeholder="Kota atau alamat perusahaan" required>
                    </div>
                    @error('alamat')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar input-icon"></i>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai') }}" required>
                    </div>
                    @error('tanggal_mulai')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai <span>*</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar-check input-icon"></i>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai') }}" required>
                    </div>
                    @error('tanggal_selesai')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-heading">
                <div class="form-heading-icon purple-icon">
                    <i class="ti ti-file-text"></i>
                </div>
                <div>
                    <h2>Dokumen Pengajuan</h2>
                    <p>Unggah surat pengajuan dalam format PDF</p>
                </div>
            </div>

            <div class="upload-area" id="uploadArea">
                <input type="file" id="surat_pengajuan"
                    name="surat_pengajuan" accept=".pdf,application/pdf" required>

                <div class="upload-content" id="uploadContent">
                    <div class="upload-icon">
                        <i class="ti ti-cloud-upload"></i>
                    </div>
                    <strong>Pilih dokumen untuk diunggah</strong>
                    <p>Klik area ini untuk memilih file PDF</p>
                    <span>Maksimal ukuran file 2 MB</span>
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

            @error('surat_pengajuan')
                <small class="error-text">{{ $message }}</small>
            @enderror
            <p class="upload-note">
                <i class="ti ti-shield-check"></i>
                Pastikan dokumen dapat dibuka dan berisi informasi yang benar.
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
