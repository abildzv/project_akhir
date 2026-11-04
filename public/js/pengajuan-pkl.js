document.addEventListener('DOMContentLoaded', () => {
    const MAX_SIZE = 2 * 1024 * 1024; // 2 MB

    const form      = document.getElementById('formPengajuan');
    const area      = document.getElementById('uploadArea');
    const input     = document.getElementById('dokumen');
    const content   = document.getElementById('uploadContent');
    const selected  = document.getElementById('fileSelected');
    const fileName  = document.getElementById('fileName');
    const fileSize  = document.getElementById('fileSize');
    const removeBtn = document.getElementById('removeFile');
    const errorBox  = document.getElementById('fileError');
    const submitBtn = document.getElementById('submitButton');

    if (!form || !input) return;

    const formatSize = (bytes) =>
        bytes >= 1024 * 1024
            ? (bytes / (1024 * 1024)).toFixed(2) + ' MB'
            : Math.max(1, Math.round(bytes / 1024)) + ' KB';

    const showError = (msg) => {
        errorBox.textContent = msg;
        errorBox.hidden = false;
    };

    const hideError = () => {
        errorBox.textContent = '';
        errorBox.hidden = true;
    };

    const clearFile = () => {
        input.value = '';
        selected.hidden = true;
        content.hidden = false;
    };

    const isPdf = (file) =>
        file.type === 'application/pdf' || /\.pdf$/i.test(file.name);

    input.addEventListener('change', () => {
        const file = input.files[0];
        hideError();

        if (!file) {
            clearFile();
            return;
        }

        if (!isPdf(file)) {
            clearFile();
            showError('File harus berformat PDF.');
            return;
        }

        if (file.size > MAX_SIZE) {
            clearFile();
            showError(`Ukuran file ${formatSize(file.size)} melebihi batas maksimal 2 MB.`);
            return;
        }

        fileName.textContent = file.name;
        fileSize.textContent = formatSize(file.size);
        content.hidden = true;
        selected.hidden = false;
    });

    removeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        hideError();
        clearFile();
    });

    // Efek drag & drop (file ditangani langsung oleh input yang menutupi area)
    ['dragenter', 'dragover'].forEach((evt) =>
        area.addEventListener(evt, () => area.classList.add('dragover'))
    );
    ['dragleave', 'drop'].forEach((evt) =>
        area.addEventListener(evt, () => area.classList.remove('dragover'))
    );

    // Reset: bersihkan juga tampilan file & pesan error
    form.addEventListener('reset', () => {
        setTimeout(() => {
            hideError();
            clearFile();
        }, 0);
    });

    // Validasi sebelum submit
    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            e.preventDefault();
            form.reportValidity();
            return;
        }

        if (!input.files.length) {
            e.preventDefault();
            showError('Dokumen wajib diunggah.');
            area.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        submitBtn.disabled = true;
        submitBtn.firstChild.textContent = 'Mengirim... ';
    });

    // Aktifkan lagi tombol kalau user kembali lewat tombol Back
    window.addEventListener('pageshow', () => {
        submitBtn.disabled = false;
    });
});