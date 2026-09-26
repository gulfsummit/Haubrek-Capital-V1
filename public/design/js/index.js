// ===================================================================
// UTILITY FUNCTIONS
// ===================================================================

// Utility to safely get elements
function safeGetElement(id) {
    return document.getElementById(id);
}

function safeGetElements(selector) {
    return document.querySelectorAll(selector);
}

// ===================================================================
// MAIN HERO SLIDER MODULE
// ===================================================================
const HeroSlider = {
    currentSlide: 0,
    totalSlides: 0,
    slideInterval: null,
    isHovering: false,
    autoPlayEnabled: true,

    init() {
        this.slider = safeGetElement('slider');
        if (!this.slider) return;
        this.totalSlides = this.slider.querySelectorAll('.hero-slide').length || 1;

        this.setupHoverEvents();
        if (this.totalSlides > 1) {
            this.startAutoSlide();
        }
        this.updateDots();
    },

    updateSlider() {
        if (!this.slider) return;
        const translateX = -this.currentSlide * (100 / this.totalSlides);
        this.slider.style.transform = `translateX(${translateX}%)`;
        this.updateDots();
    },

    moveSlide(direction, disableAutoplay = true) {
        if (disableAutoplay) {
            this.stopAutoSlide();
        }
        this.currentSlide = (this.currentSlide + direction + this.totalSlides) % this.totalSlides;
        this.updateSlider();
    },

    goToSlide(slideIndex, disableAutoplay = true) {
        if (slideIndex >= this.totalSlides) return;
        if (disableAutoplay) {
            this.stopAutoSlide();
        }
        this.currentSlide = slideIndex;
        this.updateSlider();
    },

    updateDots() {
        const mobileDots = safeGetElements('.mobile-dot');
        const desktopDots = safeGetElements('.desktop-dot');

        // Update mobile dots
        mobileDots.forEach((dot, index) => {
            dot.classList.toggle('bg-[#D4AF37]', index === this.currentSlide);
            dot.classList.toggle('bg-gray-400', index !== this.currentSlide);
        });

        // Update desktop dots
        desktopDots.forEach((dot, index) => {
            dot.classList.toggle('bg-[#D4AF37]', index === this.currentSlide);
            dot.classList.toggle('bg-gray-400', index !== this.currentSlide);
        });
    },

    setupHoverEvents() {
        if (!this.slider) return;

        this.slider.addEventListener('mouseenter', () => {
            this.isHovering = true;
        });

        this.slider.addEventListener('mouseleave', () => {
            this.isHovering = false;
        });
    },

    startAutoSlide() {
        this.stopAutoSlide(false);
        this.autoPlayEnabled = true;
        this.slideInterval = setInterval(() => {
            if (!this.isHovering) {
                this.moveSlide(1, false);
            }
        }, 5000);
    },

    stopAutoSlide(disable = true) {
        if (this.slideInterval) {
            clearInterval(this.slideInterval);
            this.slideInterval = null;
        }

        if (disable) {
            this.autoPlayEnabled = false;
        }
    }
};

// ===================================================================
// SERVICE SECTION MODULE
// ===================================================================
const ServiceSection = {
    serviceData: [],

    init(data) {
        if (data && data.length > 0) {
            this.serviceData = data;
        } else if (window.serviceData && window.serviceData.length > 0) {
            this.serviceData = window.serviceData;
        } else if (window.appData && window.appData.services) {
            this.serviceData = window.appData.services;
        }

        if (this.serviceData.length === 0) return;

        this.setupServiceButtons();
        this.updateContent(0); // Initialize with first service
    },

    setupServiceButtons() {
        const serviceButtons = safeGetElements('.service-btn');
        serviceButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.updateContent(index);
                this.updateButtonStates(index);
            });
        });
    },

    updateContent(index) {
        if (!this.serviceData || index >= this.serviceData.length) return;

        const data = this.serviceData[index];
        if (!data) return;

        // Update desktop content
        this.updateDesktopContent(data);

        // Update mobile content
        this.updateMobileContent(data);
    },

    updateDesktopContent(data) {
        const contentContainer = safeGetElement('serviceContent') || safeGetElement('desktop-service-content');
        if (!contentContainer) return;

        const serviceImage = safeGetElement('service-image');
        const serviceTitle = safeGetElement('service-title');
        const serviceDescription = safeGetElement('service-description');
        const serviceLink = safeGetElement('service-link');

        if (serviceImage) serviceImage.src = data.image;
        if (serviceTitle) serviceTitle.textContent = data.title.replace(/<br\s*\/?>/gi, ' ');
        if (serviceDescription) serviceDescription.innerHTML = data.description || '';
        if (serviceLink) serviceLink.href = data.url || data.link || '#';

        // For legacy support with dynamic content
        if (window.innerWidth >= 1024 && !serviceImage) {
            const cleanTitle = data.title.replace(/<br\s*\/?>/gi, ' ');
            contentContainer.innerHTML = `
                <div class="absolute inset-0">
                    <img src="${data.image}" alt="${cleanTitle}" class="w-full h-full object-cover object-top"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 md:p-8 text-white">
                    <div class="flex flex-col">
                        <div class="max-w-xl">
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-neue-extrabold mb-2 md:mb-4">${cleanTitle}</h3>
                            <p class="text-[1rem] font-['Poppins'] text-white">${data.description || ''}</p>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="${data.url || data.link || '#'}" class="text-[#D4AF37] font-neue-bold text-sm hover:opacity-80 transition-all">${data.readMoreText || 'Read More'}</a>
                        </div>
                    </div>
                </div>
            `;
        }
    },

    updateMobileContent(data) {
        // Update mobile service content
        const mobileImage = safeGetElement('mobile-service-image');
        const mobileTitle = safeGetElement('mobile-service-title');
        const mobileDescription = safeGetElement('mobile-service-description');
        const mobileLink = safeGetElement('mobile-service-link');

        if (mobileImage) mobileImage.src = data.image;
        if (mobileTitle) mobileTitle.textContent = data.title.replace(/<br\s*\/?>/gi, ' ');
        if (mobileDescription) mobileDescription.innerHTML = data.description || '';
        if (mobileLink) {
            mobileLink.href = data.url || data.link || '#';
            mobileLink.textContent = data.readMoreText || 'Read More';
        }
    },

    updateButtonStates(activeIndex) {
        const serviceButtons = safeGetElements('.service-btn');
        serviceButtons.forEach((btn, index) => {
            if (index === activeIndex) {
                btn.classList.remove('bg-[#1a1f2e]');
                btn.classList.add('bg-[#D4AF37]');
            } else {
                btn.classList.remove('bg-[#D4AF37]');
                btn.classList.add('bg-[#1a1f2e]');
            }
        });
    }
};

// ===================================================================
// MOBILE NAVIGATION MODULE
// ===================================================================
const MobileNavigation = {
    init() {
        this.setupBurgerMenu();
        this.setupDropdowns();
    },

    setupBurgerMenu() {
        const burgerMenu = safeGetElement('burger-menu');
        const mobileMenu = safeGetElement('mobile-menu') || safeGetElement('mobile-menu1');

        if (!burgerMenu || !mobileMenu) return;

        burgerMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');

            // Toggle burger icon
            const burgerIcon = burgerMenu.querySelector('i');
            if (burgerIcon) {
                burgerIcon.classList.toggle('fa-bars');
                burgerIcon.classList.toggle('fa-times');
            }
        });
    },

    setupDropdowns() {
        // Handle main navigation dropdowns (inside mobile menu)
        const mobileMenuDropdowns = safeGetElements('#mobile-menu .dropdown-toggle');
        mobileMenuDropdowns.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const parentDiv = this.closest('div.border-b');
                const content = parentDiv?.querySelector('.dropdown-content');

                if (content) {
                    content.classList.toggle('hidden');

                    const icon = this.querySelector('i');
                    if (icon) {
                        if (content.classList.contains('hidden')) {
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
                        } else {
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        }
                    }
                }
            });
        });

        // Handle footer dropdowns (separate from mobile menu)
        const footerDropdowns = safeGetElements('footer .dropdown-toggle');
        footerDropdowns.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const parentDiv = this.closest('div.border-b');
                const content = parentDiv?.querySelector('.dropdown-content');

                if (content) {
                    content.classList.toggle('hidden');

                    const icon = this.querySelector('i');
                    if (icon) {
                        if (content.classList.contains('hidden')) {
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
                        } else {
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        }
                    }
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function (event) {
            const mobileMenu = safeGetElement('mobile-menu');
            if (mobileMenu && !mobileMenu.contains(event.target)) {
                const dropdowns = mobileMenu.querySelectorAll('.group > div + div');
                const arrows = mobileMenu.querySelectorAll('.group > div i');

                dropdowns.forEach(dropdown => dropdown.classList.add('hidden'));
                arrows.forEach(arrow => arrow.classList.remove('rotate-180'));
            }
        });
    }
};

// ===================================================================
// METRICS SLIDER MODULE (Desktop)
// ===================================================================
const MetricsSlider = {
    currentSlide: 0,
    totalSlides: 1,
    isSliding: false,
    autoSlideInterval: null,

    init() {
        this.slider = safeGetElement('metrics-slider');
        if (!this.slider) return;

        this.calculateSlides();
        this.updateSlider();
        this.startAutoSlide();
        this.setupKeyboardNavigation();
    },

    calculateSlides() {
        const slideElements = this.slider.querySelectorAll('.min-w-full');
        this.totalSlides = slideElements.length;
    },

    updateSlider() {
        if (this.totalSlides === 0) return;

        // Ensure current slide is within bounds
        if (this.currentSlide >= this.totalSlides) {
            this.currentSlide = 0;
        }

        const translateX = -this.currentSlide * 100;
        this.slider.style.transform = `translateX(${translateX}%)`;
        this.updateDots();
    },

    moveSlide(direction) {
        if (this.isSliding || this.totalSlides <= 1) return;

        this.isSliding = true;
        this.currentSlide = (this.currentSlide + direction + this.totalSlides) % this.totalSlides;
        this.updateSlider();
        this.resetAutoSlide();

        setTimeout(() => {
            this.isSliding = false;
        }, 500);
    },

    goToSlide(slideIndex) {
        if (this.isSliding || slideIndex === this.currentSlide) return;

        this.isSliding = true;
        this.currentSlide = slideIndex;
        this.updateSlider();
        this.resetAutoSlide();

        setTimeout(() => {
            this.isSliding = false;
        }, 500);
    },

    updateDots() {
        const dots = safeGetElements('.metrics-dot');
        dots.forEach((dot, index) => {
            if (index === this.currentSlide) {
                dot.classList.remove('bg-gray-400');
                dot.classList.add('bg-[#D4AF37]');
            } else {
                dot.classList.remove('bg-[#D4AF37]');
                dot.classList.add('bg-gray-400');
            }
        });
    },

    startAutoSlide() {
        if (this.totalSlides <= 1) return;

        this.autoSlideInterval = setInterval(() => {
            if (!this.isSliding) {
                this.moveSlide(1);
            }
        }, 5000);
    },

    resetAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
            this.startAutoSlide();
        }
    },

    setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                this.moveSlide(-1);
            } else if (e.key === 'ArrowRight') {
                this.moveSlide(1);
            }
        });
    }
};

// ===================================================================
// MOBILE METRICS SLIDER MODULE
// ===================================================================
const MobileMetricsSlider = {
    currentSlide: 0,
    totalSlides: 3,
    isSliding: false,
    touchStartX: 0,
    touchEndX: 0,
    autoSlideInterval: null,

    init() {
        this.slider = safeGetElement('mobile-metrics-slider');
        if (!this.slider) return;

        this.calculateSlides();
        this.updateSlider();
        this.setupTouchEvents();
        this.setupDotNavigation();
        this.startAutoSlide();
    },

    calculateSlides() {
        // For mobile metrics, we now have 3 slides with 3 metrics each
        const slideElements = this.slider.querySelectorAll('[data-slide]');
        this.totalSlides = slideElements.length;
    },

    updateSlider() {
        if (this.totalSlides === 0) return;

        // Ensure current slide is within bounds
        if (this.currentSlide >= this.totalSlides) {
            this.currentSlide = 0;
        }

        // Translate the slider to show the current slide
        // Since each slide is 1/3 of the container width, we need to translate by 1/3 for each slide
        const translateX = -this.currentSlide * (100 / this.totalSlides);
        this.slider.style.transform = `translateX(${translateX}%)`;
        this.updateDots();
    },

    moveSlide(direction) {
        if (this.isSliding) return;

        this.isSliding = true;
        this.currentSlide = (this.currentSlide + direction + this.totalSlides) % this.totalSlides;
        this.updateSlider();
        this.resetAutoSlide();

        setTimeout(() => {
            this.isSliding = false;
        }, 500);
    },

    goToSlide(slideIndex) {
        if (this.isSliding || slideIndex === this.currentSlide || slideIndex >= this.totalSlides) return;

        this.isSliding = true;
        this.currentSlide = slideIndex;
        this.updateSlider();
        this.resetAutoSlide();

        setTimeout(() => {
            this.isSliding = false;
        }, 500);
    },

    updateDots() {
        const dots = safeGetElements('.mobile-metrics-dot');
        dots.forEach((dot, index) => {
            if (index === this.currentSlide) {
                dot.classList.remove('bg-white', 'opacity-30');
                dot.classList.add('bg-[#D4AF37]');
            } else {
                dot.classList.remove('bg-[#D4AF37]');
                dot.classList.add('bg-white', 'opacity-30');
            }
        });
    },

    setupTouchEvents() {
        this.slider.addEventListener('touchstart', (e) => {
            if (this.isSliding) return;
            this.touchStartX = e.changedTouches[0].screenX;
            this.pauseAutoSlide();
        }, { passive: true });

        this.slider.addEventListener('touchend', (e) => {
            if (this.isSliding) return;

            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
            this.resumeAutoSlide();
        }, { passive: true });
    },

    handleSwipe() {
        const swipeThreshold = 50;
        const swipeDistance = this.touchStartX - this.touchEndX;

        if (Math.abs(swipeDistance) < swipeThreshold) return;

        if (swipeDistance > 0) {
            // Swiped left -> next slide
            this.moveSlide(1);
        } else {
            // Swiped right -> previous slide
            this.moveSlide(-1);
        }
    },

    setupDotNavigation() {
        const dots = safeGetElements('.mobile-metrics-dot');
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                if (!this.isSliding) {
                    this.goToSlide(index);
                    this.resetAutoSlide();
                }
            });
        });
    },

    startAutoSlide() {
        if (this.totalSlides <= 1) return;

        this.autoSlideInterval = setInterval(() => {
            if (!this.isSliding) {
                this.moveSlide(1);
            }
        }, 5000);
    },

    pauseAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
        }
    },

    resumeAutoSlide() {
        this.startAutoSlide();
    },

    resetAutoSlide() {
        this.pauseAutoSlide();
        this.resumeAutoSlide();
    }
};

// ===================================================================
// DIRECTORS SLIDER MODULE (Desktop)
// ===================================================================
const DirectorsSlider = {
    currentSlide: 0,
    totalSlides: 1,

    init() {
        this.slider = safeGetElement('directors-slider');
        if (!this.slider) return;

        // Calculate total slides based on actual slides in DOM
        const slides = this.slider.querySelectorAll('.min-w-full');
        this.totalSlides = slides.length;
        
        // Only initialize if there are multiple slides
        if (this.totalSlides > 1) {
            this.setupNavigation();
            this.updateSlider();
        }
    },

    setupNavigation() {
        const prevBtn = safeGetElement('prev-slide');
        const nextBtn = safeGetElement('next-slide');
        const dots = safeGetElements('.pagination-dot');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.moveSlide(-1));
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.moveSlide(1));
        }

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const directorIndex = parseInt(dot.getAttribute('data-director'));
                this.goToDirector(directorIndex);
            });
        });
    },

    updateSlider() {
        if (this.totalSlides <= 1) return;
        
        this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;
        this.updateDots();
        this.updateNavigationButtons();
    },

    moveSlide(direction) {
        if (this.totalSlides <= 1) return;
        
        this.currentSlide = (this.currentSlide + direction + this.totalSlides) % this.totalSlides;
        this.updateSlider();
    },

    goToSlide(slideIndex) {
        if (this.totalSlides <= 1) return;
        
        this.currentSlide = slideIndex;
        this.updateSlider();
    },

    goToDirector(directorIndex) {
        if (this.totalSlides <= 1) return;
        
        // Calculate which slide contains this director (3 directors per slide)
        const directorsPerSlide = 3;
        const targetSlide = Math.floor(directorIndex / directorsPerSlide);
        
        this.currentSlide = targetSlide;
        this.updateSlider();
    },

    updateDots() {
        const dots = safeGetElements('.pagination-dot');
        const directorsPerSlide = 3;
        
        dots.forEach((dot) => {
            const directorIndex = parseInt(dot.getAttribute('data-director'));
            const directorSlide = Math.floor(directorIndex / directorsPerSlide);
            
            if (directorSlide === this.currentSlide) {
                dot.classList.remove('bg-white/30');
                dot.classList.add('bg-[#D4AF37]');
            } else {
                dot.classList.remove('bg-[#D4AF37]');
                dot.classList.add('bg-white/30');
            }
        });
    },

    updateNavigationButtons() {
        const prevBtn = safeGetElement('prev-slide');
        const nextBtn = safeGetElement('next-slide');

        if (prevBtn) {
            if (this.currentSlide === 0) {
                prevBtn.style.opacity = '0.5';
                prevBtn.style.cursor = 'not-allowed';
                prevBtn.disabled = true;
            } else {
                prevBtn.style.opacity = '1';
                prevBtn.style.cursor = 'pointer';
                prevBtn.disabled = false;
            }
        }

        if (nextBtn) {
            if (this.currentSlide >= this.totalSlides - 1) {
                nextBtn.style.opacity = '0.5';
                nextBtn.style.cursor = 'not-allowed';
                nextBtn.disabled = true;
            } else {
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
                nextBtn.disabled = false;
            }
        }
    }
};

// ===================================================================
// MOBILE DIRECTORS SLIDER MODULE
// ===================================================================
const MobileDirectorsSlider = {
    currentSlide: 0,
    totalSlides: 1,

    init() {
        this.slider = safeGetElement('mobile-slider');
        if (!this.slider) return;

        // Calculate total slides based on actual slides in DOM
        const slides = this.slider.querySelectorAll('.mobile-slide');
        this.totalSlides = slides.length;
        
        // Only initialize if there are multiple slides
        if (this.totalSlides > 1) {
            this.setupNavigation();
            this.updateSlider();
        }
    },

    setupNavigation() {
        const prevBtn = safeGetElement('mobile-prev-slide');
        const nextBtn = safeGetElement('mobile-next-slide');
        const dots = safeGetElements('.pagination-dot');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.moveSlide(-1));
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.moveSlide(1));
        }

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const directorIndex = parseInt(dot.getAttribute('data-director'));
                this.goToDirector(directorIndex);
            });
        });
    },

    updateSlider() {
        if (this.totalSlides <= 1) return;
        
        this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;
        this.updateDots();
        this.updateNavigationButtons();
    },

    moveSlide(direction) {
        if (this.totalSlides <= 1) return;
        
        this.currentSlide = (this.currentSlide + direction + this.totalSlides) % this.totalSlides;
        this.updateSlider();
    },

    goToSlide(slideIndex) {
        if (this.totalSlides <= 1) return;
        
        this.currentSlide = slideIndex;
        this.updateSlider();
    },

    goToDirector(directorIndex) {
        if (this.totalSlides <= 1) return;
        
        // For mobile, each director is its own slide
        this.currentSlide = directorIndex;
        this.updateSlider();
    },

    updateDots() {
        const dots = safeGetElements('.pagination-dot');
        
        dots.forEach((dot) => {
            const directorIndex = parseInt(dot.getAttribute('data-director'));
            
            if (directorIndex === this.currentSlide) {
                dot.classList.remove('bg-white/30');
                dot.classList.add('bg-[#D4AF37]');
            } else {
                dot.classList.remove('bg-[#D4AF37]');
                dot.classList.add('bg-white/30');
            }
        });
    },

    updateNavigationButtons() {
        const prevBtn = safeGetElement('mobile-prev-slide');
        const nextBtn = safeGetElement('mobile-next-slide');

        if (prevBtn) {
            if (this.currentSlide === 0) {
                prevBtn.style.opacity = '0.5';
                prevBtn.style.cursor = 'not-allowed';
                prevBtn.disabled = true;
            } else {
                prevBtn.style.opacity = '1';
                prevBtn.style.cursor = 'pointer';
                prevBtn.disabled = false;
            }
        }

        if (nextBtn) {
            if (this.currentSlide >= this.totalSlides - 1) {
                nextBtn.style.opacity = '0.5';
                nextBtn.style.cursor = 'not-allowed';
                nextBtn.disabled = true;
            } else {
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
                nextBtn.disabled = false;
            }
        }
    }
};

// ===================================================================
// ARTICLES/BLOG FILTERING MODULE
// ===================================================================
const ArticlesFilter = {
    activeTab: 'all',

    init() {
        this.tabButtons = safeGetElements('#articles-tabs .tab-btn-articles');
        this.cards = safeGetElements('#articles-cards .article-card-articles');

        if (this.tabButtons.length === 0) return;

        this.setupTabEvents();
        this.updateTabs(this.activeTab);
    },

    setupTabEvents() {
        this.tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                this.activeTab = btn.getAttribute('data-tab');
                this.updateTabs(this.activeTab);
            });
        });
    },

    updateTabs(tab) {
        // Update button states
        this.tabButtons.forEach(btn => {
            if (btn.getAttribute('data-tab') === tab) {
                btn.classList.add('bg-[#D4AF37]', 'text-white');
                btn.classList.remove('bg-white', 'text-[#041B44]');
            } else {
                btn.classList.remove('bg-[#D4AF37]', 'text-white');
                btn.classList.add('bg-white', 'text-[#041B44]');
            }
        });

        // Update card visibility
        this.cards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            if (tab === 'all') {
                // Show all cards when "All" tab is selected
                card.style.display = '';
            } else {
                // Show only cards matching the selected category
                card.style.display = (cardCategory === tab) ? '' : 'none';
            }
        });
    }
};

// ===================================================================
// CAROUSEL MODULE
// ===================================================================
const Carousel = {
    currentIndex: 0,
    totalItems: 0,

    init() {
        this.container = safeGetElement('carousel-container');
        this.prevBtn = safeGetElement('prev-btn');
        this.nextBtn = safeGetElement('next-btn');
        this.items = safeGetElements('.carousel-item');

        if (!this.container || !this.prevBtn || !this.nextBtn) return;

        this.totalItems = this.items.length;
        this.setupEvents();
        this.setupCarousel();

        window.addEventListener('resize', () => this.setupCarousel());
    },

    setupEvents() {
        this.prevBtn.addEventListener('click', () => {
            if (window.innerWidth < 768 && this.currentIndex > 0) {
                this.currentIndex--;
                this.setupCarousel();
            }
        });

        this.nextBtn.addEventListener('click', () => {
            if (window.innerWidth < 768 && this.currentIndex < this.totalItems - 1) {
                this.currentIndex++;
                this.setupCarousel();
            }
        });
    },

    setupCarousel() {
        if (window.innerWidth < 768) {
            // Mobile: show only one item
            this.items.forEach((item, index) => {
                item.style.display = index === this.currentIndex ? 'block' : 'none';
            });

            this.prevBtn.style.opacity = this.currentIndex === 0 ? '0.5' : '1';
            this.nextBtn.style.opacity = this.currentIndex === this.totalItems - 1 ? '0.5' : '1';
        } else {
            // Desktop: show all items
            this.items.forEach(item => {
                item.style.display = 'block';
            });
            this.prevBtn.style.opacity = '0.5';
            this.nextBtn.style.opacity = '0.5';
        }
    }
};

// ===================================================================
// STEPS CAROUSEL MODULE
// ===================================================================
const StepsCarousel = {
    currentSlideIndex: 0,
    totalSlides: 0,

    init() {
        this.prevBtn = safeGetElement('steps-prev-btn');
        this.nextBtn = safeGetElement('steps-next-btn');
        this.slides = safeGetElements('.steps-slide');

        if (!this.prevBtn || !this.nextBtn || this.slides.length === 0) return;

        this.totalSlides = this.slides.length;
        this.addStyles();
        this.setupEvents();
        this.updateCarousel();

        window.addEventListener('resize', () => {
            if (this.currentSlideIndex >= this.totalSlides) {
                this.currentSlideIndex = this.totalSlides - 1;
            }
            this.updateCarousel();
        });
    },

    addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .steps-slide {
                transition: all 0.3s ease-in-out;
            }
            .number-badge {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        `;
        document.head.appendChild(style);
    },

    setupEvents() {
        this.prevBtn.addEventListener('click', () => {
            if (this.currentSlideIndex > 0) {
                this.currentSlideIndex--;
                this.updateCarousel();
            }
        });

        this.nextBtn.addEventListener('click', () => {
            if (this.currentSlideIndex < this.totalSlides - 1) {
                this.currentSlideIndex++;
                this.updateCarousel();
            }
        });
    },

    updateCarousel() {
        this.slides.forEach((slide, index) => {
            if (index === this.currentSlideIndex) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });

        // Update navigation buttons
        this.prevBtn.style.opacity = this.currentSlideIndex === 0 ? '0.5' : '1';
        this.prevBtn.style.cursor = this.currentSlideIndex === 0 ? 'default' : 'pointer';

        this.nextBtn.style.opacity = this.currentSlideIndex >= this.totalSlides - 1 ? '0.5' : '1';
        this.nextBtn.style.cursor = this.currentSlideIndex >= this.totalSlides - 1 ? 'default' : 'pointer';
    }
};

// ===================================================================
// GLOBAL FUNCTIONS (for legacy HTML onclick handlers and external access)
// ===================================================================
window.moveSlide = (direction) => HeroSlider.moveSlide(direction);
window.goToSlide = (slideIndex) => HeroSlider.goToSlide(slideIndex);
window.updateServiceContent = (index) => ServiceSection.updateContent(index);
window.changeServiceContent = (index) => ServiceSection.updateContent(index);
window.moveMetricsSlide = (direction) => MetricsSlider.moveSlide(direction);
window.goToMetricsSlide = (slideIndex) => MetricsSlider.goToSlide(slideIndex);
window.moveDirectorsSlide = (direction) => DirectorsSlider.moveSlide(direction);
window.goToDirectorSlide = (slideIndex) => DirectorsSlider.goToSlide(slideIndex);
window.goToMobileMetricsSlide = (slideIndex) => MobileMetricsSlider.goToSlide(slideIndex);
window.moveMobileMetricsSlide = (direction) => MobileMetricsSlider.moveSlide(direction);
window.toggleDropdown = function (element) {
    event.stopPropagation();
    const dropdownContent = element.parentElement.nextElementSibling;
    dropdownContent.classList.toggle('hidden');
    element.classList.toggle('rotate-180');
};

// Make modules globally accessible
window.HeroSlider = HeroSlider;
window.ServiceSection = ServiceSection;
window.MetricsSlider = MetricsSlider;
window.MobileMetricsSlider = MobileMetricsSlider;
window.DirectorsSlider = DirectorsSlider;

// ===================================================================
// INITIALIZATION
// ===================================================================
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all modules
    HeroSlider.init();
    ServiceSection.init();
    MobileNavigation.init();
    MetricsSlider.init();
    MobileMetricsSlider.init();
    DirectorsSlider.init();
    MobileDirectorsSlider.init();
    ArticlesFilter.init();
    Carousel.init();
    StepsCarousel.init();
});

// Handle window resize events
window.addEventListener('resize', () => {
    MetricsSlider.updateSlider();
    if (window.innerWidth < 1024) {
        MetricsSlider.currentSlide = 0;
        MetricsSlider.updateSlider();
    }
});