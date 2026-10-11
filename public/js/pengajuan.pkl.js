
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('surat_pengajuan');
    const uploadArea = document.getElementById('uploadArea');
    const uploadContent = document.getElementById('uploadContent');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFile = document.getElementById('removeFile');
    const form = document.getElementById('formPengajuan');
    const submitButton = document.getElementById('submitButton');
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');

    if (!fileInput || !uploadArea || !form) return;

    function tampilkanFile(file) {
        if (!file) return;

        const maksimalUkuran = 2 * 1024 * 1024;
        const ekstensiValid = file.name.toLowerCase().endsWith('.pdf');

        if (!ekstensiValid || file.type !== 'application/pdf') {
            alert('Dokumen harus berformat PDF.');
            fileInput.value = '';
            return;
        }

        if (file.size > maksimalUkuran) {
            alert('Ukuran file maksimal 2 MB.');
            fileInput.value = '';
            return;
        }

        fileName.textContent = file.name;
        fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';

        uploadContent.hidden = true;
        fileSelected.hidden = false;
        uploadArea.style.background = 'rgb(239, 246, 255)';
    }

    fileInput.addEventListener('change', function () {
        tampilkanFile(this.files[0]);
    });

    removeFile.addEventListener('click', function () {
        fileInput.value = '';
        fileSelected.hidden = true;
        uploadContent.hidden = false;
        uploadArea.style.background = '';
    });

    uploadArea.addEventListener('dragover', function (event) {
        event.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function () {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function (event) {
        event.preventDefault();
        uploadArea.classList.remove('dragover');

        const file = event.dataTransfer.files[0];
        if (!file) return;

        const transfer = new DataTransfer();
        transfer.items.add(file);
        fileInput.files = transfer.files;
        tampilkanFile(file);
    });

    function aturTanggalSelesai() {
        if (tanggalMulai.value) {
            tanggalSelesai.min = tanggalMulai.value;

            if (tanggalSelesai.value &&
                tanggalSelesai.value < tanggalMulai.value) {
                tanggalSelesai.value = '';
            }
        } else {
            tanggalSelesai.removeAttribute('min');
        }
    }

    tanggalMulai.addEventListener('change', aturTanggalSelesai);

    form.addEventListener('reset', function () {
        setTimeout(function () {
            fileSelected.hidden = true;
            uploadContent.hidden = false;
            uploadArea.style.background = '';
            uploadArea.classList.remove('dragover');
            submitButton.disabled = false;
            submitButton.innerHTML =
                'Ajukan PKL <i class="ti ti-arrow-right"></i>';
            aturTanggalSelesai();
        }, 0);
    });

    form.addEventListener('submit', function (event) {
        if (tanggalMulai.value && tanggalSelesai.value &&
            tanggalSelesai.value < tanggalMulai.value) {
            event.preventDefault();
            alert('Tanggal selesai tidak boleh sebelum tanggal mulai.');
            tanggalSelesai.focus();
            return;
        }

        if (fileInput.files.length === 0) {
            event.preventDefault();
            alert('Silakan unggah surat pengajuan PKL terlebih dahulu.');
            return;
        }

        submitButton.disabled = true;
        submitButton.innerHTML =
            '<i class="ti ti-loader-2"></i> Mengirim pengajuan...';
    });

    aturTanggalSelesai();
});
