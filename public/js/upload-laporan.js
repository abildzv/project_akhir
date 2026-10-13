
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formUploadLaporan');
    const input = document.getElementById('fileLaporan');
    const dropZone = document.getElementById('dropZone');
    const preview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const message = document.getElementById('uploadMessage');

    if (!form || !input || !dropZone) return;

    let selectedFile = null;

    function showMessage(text, type) {
        message.textContent = text;
        message.className = 'upload-message ' + type;
    }

    function formatSize(bytes) {
        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(1) + ' KB';
        }

        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function resetFile() {
        selectedFile = null;
        input.value = '';
        preview.hidden = true;
        dropZone.hidden = false;
        showMessage('', '');
    }

    function processFile(file) {
        if (!file) return;

        const isPdf = file.type === 'application/pdf'
            || file.name.toLowerCase().endsWith('.pdf');

        if (!isPdf) {
            resetFile();
            showMessage('File harus berformat PDF.', 'error');
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            resetFile();
            showMessage('Ukuran file maksimal 10 MB.', 'error');
            return;
        }

        if (file.size === 0) {
            resetFile();
            showMessage('File kosong tidak dapat digunakan.', 'error');
            return;
        }

        selectedFile = file;
        fileName.textContent = file.name;
        fileSize.textContent = formatSize(file.size);

        dropZone.hidden = true;
        preview.hidden = false;
        showMessage('', '');
    }

    document.getElementById('btnPilihFile').addEventListener('click', function () {
        input.click();
    });

    input.addEventListener('change', function () {
        processFile(this.files[0]);
    });

    document.getElementById('btnHapusFile').addEventListener('click', resetFile);

    ['dragenter', 'dragover'].forEach(function (eventName) {
        dropZone.addEventListener(eventName, function (event) {
            event.preventDefault();
            dropZone.classList.add('drag-over');
        });
    });

    ['dragleave', 'drop'].forEach(function (eventName) {
        dropZone.addEventListener(eventName, function (event) {
            event.preventDefault();
            dropZone.classList.remove('drag-over');
        });
    });

    dropZone.addEventListener('drop', function (event) {
        const file = event.dataTransfer.files[0];
        processFile(file);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!selectedFile) {
            showMessage('Pilih file PDF terlebih dahulu.', 'error');
            return;
        }

        showMessage(
            'Tampilan sudah siap. Upload belum terhubung ke backend penyimpanan.',
            'success'
        );
    });

    document.querySelectorAll('[data-demo-action]').forEach(function (button) {
        button.addEventListener('click', function () {
            showMessage(
                'Fitur ' + this.dataset.demoAction.toLowerCase()
                + ' akan diaktifkan setelah backend laporan dibuat.',
                'success'
            );
        });
    });
});
