document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('profileActionModal');
    const modalTitle = document.getElementById('profileModalTitle');
    const modalMessage = document.getElementById('profileModalMessage');
    const modalIcon = document.getElementById('profileModalIcon');
    const closeButton = document.getElementById('closeProfileModal');
    const confirmButton = document.getElementById('confirmProfileModal');

    if (!modal) return;

    const actions = {
        personal: {
            title: 'Edit Informasi Pribadi',
            message: 'Form untuk mengubah nama, email, nomor telepon, dan informasi pribadi akan kita buat pada tahap berikutnya.',
            icon: 'ti-user-edit'
        },
        school: {
            title: 'Informasi Sekolah dan PKL',
            message: 'Data sekolah dan PKL akan ditampilkan sesuai data yang diberikan oleh sistem. Pengeditan data ini dapat dibatasi untuk menjaga keakuratan informasi.',
            icon: 'ti-school'
        },
        password: {
            title: 'Ubah Password',
            message: 'Form perubahan password belum dihubungkan ke proses autentikasi. Kita akan menambahkannya dengan validasi password lama dan password baru.',
            icon: 'ti-lock'
        },
        photo: {
            title: 'Ganti Foto Profil',
            message: 'Fitur unggah foto akan ditambahkan dengan validasi format JPG atau PNG dan ukuran maksimal 2 MB.',
            icon: 'ti-camera'
        }
    };

    function openModal(type) {
        const action = actions[type];

        if (!action) return;

        modalTitle.textContent = action.title;
        modalMessage.textContent = action.message;
        modalIcon.className = 'ti ' + action.icon;

        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        closeButton?.focus();
    }

    function closeModal() {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-edit-section]').forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button.dataset.editSection);
        });
    });

    document.querySelectorAll('[data-profile-action]').forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button.dataset.profileAction);
        });
    });

    closeButton?.addEventListener('click', closeModal);
    confirmButton?.addEventListener('click', closeModal);

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });
});