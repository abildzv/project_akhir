document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuToggle = document.getElementById('menuToggle');

    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-button');
    const rows = [...document.querySelectorAll('.application-row')];
    const emptyRow = document.querySelector('.empty-row');
    const noResults = document.getElementById('noResults');
    const resultCount = document.getElementById('resultCount');

    const modal = document.getElementById('detailModal');
    const closeModal = document.getElementById('closeModal');
    const doneModal = document.getElementById('doneModal');
    const detailButtons = document.querySelectorAll('.detail-button');

    let currentFilter = 'Semua';

    // SIDEBAR RESPONSIF
    function closeSidebar() {
        sidebar?.classList.remove('open');
        overlay?.classList.remove('show');
    }

    menuToggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('open');
        overlay?.classList.toggle('show');
    });

    overlay?.addEventListener('click', closeSidebar);

    window.addEventListener('resize', () => {
        if (window.innerWidth > 950) {
            closeSidebar();
        }
    });

    // PENCARIAN DAN FILTER STATUS
    function filterApplications() {
        const keyword = (searchInput?.value || '').trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach((row) => {
            const status = row.dataset.status || '';
            const searchableText = row.dataset.search || '';

            const matchesSearch = searchableText.includes(keyword);
            const matchesStatus =
                currentFilter === 'Semua' || status === currentFilter;

            const visible = matchesSearch && matchesStatus;

            row.hidden = !visible;

            if (visible) {
                visibleCount++;
            }
        });

        if (emptyRow) {
            emptyRow.hidden = rows.length > 0;
        }

        if (noResults) {
            noResults.hidden = !(rows.length > 0 && visibleCount === 0);
        }

        if (resultCount) {
            resultCount.textContent = `${visibleCount} pengajuan`;
        }
    }

    searchInput?.addEventListener('input', filterApplications);

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            currentFilter = button.dataset.filter || 'Semua';

            filterButtons.forEach((item) => {
                item.classList.toggle('active', item === button);
            });

            filterApplications();
        });
    });

    // MODAL DETAIL PENGAJUAN
    function openDetail(button) {
        const fields = {
            modalInstansi: button.dataset.instansi,
            modalPeriode: button.dataset.periode,
            modalTanggal: button.dataset.tanggal,
            modalPembimbing: button.dataset.pembimbing,
            modalStatus: button.dataset.status,
            modalCatatan: button.dataset.catatan
        };

        Object.entries(fields).forEach(([id, value]) => {
            const element = document.getElementById(id);

            if (element) {
                // Gunakan textContent agar nilai data tampil sebagai teks biasa.
                element.textContent = value || 'Belum tersedia';
            }
        });

        modal?.classList.add('show');
        modal?.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        closeModal?.focus();
    }

    function hideDetail() {
        modal?.classList.remove('show');
        modal?.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    detailButtons.forEach((button) => {
        button.addEventListener('click', () => openDetail(button));
    });

    closeModal?.addEventListener('click', hideDetail);
    doneModal?.addEventListener('click', hideDetail);

    modal?.addEventListener('click', (event) => {
        if (event.target === modal) {
            hideDetail();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal?.classList.contains('show')) {
            hideDetail();
        }
    });

    // Animasi masuk elemen ketika halaman dibuka.
    // CSS tetap menyediakan animasi dasar jika IntersectionObserver tidak tersedia.
    const animatedElements = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        animatedElements.forEach((element) => observer.observe(element));
    }

    filterApplications();
});