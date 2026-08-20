@extends('layouts.app')

@section('content')
    <!-- TopNavBar -->
    @include('portfolio.components.navbar')

    <main class="w-full">
        <!-- Hero Section -->
        @include('portfolio.components.hero')

        <!-- About Section -->
        @include('portfolio.components.about')

        <!-- Experience Section -->
        @include('portfolio.components.experience')

        <!-- Skills Section -->
        @include('portfolio.components.skills')

        <!-- Education Section -->
        @include('portfolio.components.education')

        <!-- Work Section -->
        @include('portfolio.components.projects')

        <!-- Contact Section -->
        @include('portfolio.components.contact')
    </main>

    <!-- Footer -->
    @include('portfolio.components.footer')

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Intersection Observer for scroll animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Modal Logic
        const modal = document.getElementById('project-modal');
        const overlay = document.getElementById('modal-overlay');
        const content = document.getElementById('modal-content');
        const closeBtn = document.getElementById('close-modal');
        const openBtns = document.querySelectorAll('.open-modal-btn');

        const modalImg = document.getElementById('modal-image');
        const imgIndexDisplay = document.getElementById('img-index');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');

        let images = [];
        let currentImgIndex = 0;

        function updateImage() {
            if (!images.length) return;
            modalImg.style.opacity = '0';
            setTimeout(() => {
                modalImg.src = images[currentImgIndex];
                imgIndexDisplay.textContent = `0${currentImgIndex + 1}/0${images.length}`;
                modalImg.style.opacity = '1';
            }, 150);
        }

        if (prevBtn) prevBtn.addEventListener('click', () => {
            currentImgIndex = (currentImgIndex - 1 + images.length) % images.length;
            updateImage();
        });

        if (nextBtn) nextBtn.addEventListener('click', () => {
            currentImgIndex = (currentImgIndex + 1) % images.length;
            updateImage();
        });

        function openModal(projectData) {
            if (projectData) {
                document.getElementById('modal-title').textContent = projectData.title || '';
                document.getElementById('modal-desc').textContent = projectData.desc || '';
                document.getElementById('modal-category').textContent = projectData.cat || 'SELECTED WORK';

                const tagsContainer = document.getElementById('modal-tags');
                tagsContainer.innerHTML = '';
                if (projectData.tags) {
                    projectData.tags.forEach(tag => {
                        const span = document.createElement('span');
                        span.className = 'font-meta-technical text-[12px] px-3 py-1.5 rounded-sm border';
                        span.style.borderColor = 'rgba(10, 41, 71, 0.15)';
                        span.style.backgroundColor = 'rgba(10, 41, 71, 0.05)';
                        span.textContent = tag;
                        tagsContainer.appendChild(span);
                    });
                }

                // Handle project URL button
                const projectUrlBtn = document.getElementById('modal-project-url');
                if (projectData.url) {
                    projectUrlBtn.href = projectData.url;
                    projectUrlBtn.classList.remove('hidden');
                } else {
                    projectUrlBtn.classList.add('hidden');
                }

                // Handle github URL button
                const githubUrlBtn = document.getElementById('modal-github-url');
                if (projectData.github) {
                    githubUrlBtn.href = projectData.github;
                    githubUrlBtn.classList.remove('hidden');
                } else {
                    githubUrlBtn.classList.add('hidden');
                }

                // Images: use thumbnail if provided, else show placeholder
                images = projectData.thumbnail ? [projectData.thumbnail] : [];
                if (!images.length) {
                    modalImg.src = '';
                    modalImg.style.display = 'none';
                } else {
                    modalImg.style.display = '';
                    currentImgIndex = 0;
                    updateImage();
                }
                imgIndexDisplay.textContent = images.length ? `01/0${images.length}` : '—';
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('modal-open');

            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'translate-y-8');
            }, 10);
        }

        function closeModal() {
            overlay.classList.add('opacity-0');
            content.classList.add('opacity-0', 'translate-y-8');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('modal-open');
            }, 300);
        }

        openBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const data = JSON.parse(btn.getAttribute('data-project') || '{}');
                openModal(data);
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (overlay) overlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>
@endpush
