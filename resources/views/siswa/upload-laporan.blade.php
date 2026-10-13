
@extends('layouts.app')

@section('title', 'Upload Laporan PKL')
@section('page-heading', 'Upload Laporan PKL')

@section('content')
<div class="upload-page">
    <div class="upload-heading">
        <h2>Upload Laporan PKL</h2>
        <p>Unggah laporan PKL dalam format PDF. Pastikan file sesuai dengan ketentuan.</p>
    </div>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('laporan.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <label for="file-laporan" class="upload-box">
            <i class="ti ti-cloud-upload"></i>
            <strong id="upload-text">Pilih file atau drag & drop di sini</strong>
            <span>Format PDF, maks. 10MB</span>
            <input type="file"
                   id="file-laporan"
                   name="file_laporan"
                   accept=".pdf,application/pdf"
                   required>
        </label>

        <button type="submit" class="btn-upload">
            <i class="ti ti-upload"></i>
            Upload File Baru
        </button>
    </form>

    <section class="file-section">
        <h3>File yang sudah diunggah</h3>

        <div class="table-wrapper">
            <table class="file-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Tanggal Upload</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $laporan->nama_file }}</td>
                            <td>
                                {{ $laporan->created_at->format('d M Y H:i') }}
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                                    {{ $laporan->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('laporan.show', $laporan->id) }}"
                                       class="action-btn view-btn"
                                       title="Lihat laporan">
                                        <i class="ti ti-eye"></i>
                                    </a>

                                    <a href="{{ route('laporan.download', $laporan->id) }}"
                                       class="action-btn download-btn"
                                       title="Download laporan">
                                        <i class="ti ti-download"></i>
                                    </a>

                                    <form action="{{ route('laporan.destroy', $laporan->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus laporan">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-data">
                                Belum ada laporan yang diunggah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/upload-laporan.css') }}">
@endpush

@push('scripts')
<script>
    const inputFile = document.getElementById('file-laporan');
    const uploadText = document.getElementById('upload-text');

    inputFile.addEventListener('change', function () {
        uploadText.textContent = this.files.length
            ? this.files[0].name
            : 'Pilih file atau drag & drop di sini';
    });
</script>
@endpush
