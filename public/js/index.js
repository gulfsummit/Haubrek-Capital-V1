// Home Page Slider Functionality

// Hero Slider
let currentSlide = 0;
const slides = document.querySelectorAll('#slider > div');
const totalSlides = slides.length;

function goToSlide(index) {
    currentSlide = index;
    const offset = -index * 100;
    document.getElementById('slider').style.transform = `translateX(${offset}%)`;
    
    // Update navigation dots
    const dots = document.querySelectorAll('.mobile-dot, .desktop-dot');
    dots.forEach((dot, i) => {
        dot.classList.toggle('bg-[#D4AF37]', i === index);
        dot.classList.toggle('bg-gray-400', i !== index);
    });
}

function moveSlide(direction) {
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    goToSlide(currentSlide);
}

// Auto-advance slides every 5 seconds
setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    goToSlide(currentSlide);
}, 5000);

// Directors Slider
let currentDirectorSlide = 0;
const directorSlides = document.querySelectorAll('#directors-slider > div');
const totalDirectorSlides = directorSlides.length;

function goToDirectorSlide(index) {
    currentDirectorSlide = index;
    const offset = -index * 100;
    document.getElementById('directors-slider').style.transform = `translateX(${offset}%)`;
    
    // Update navigation dots
    const dots = document.querySelectorAll('.director-dot');
    dots.forEach((dot, i) => {
        dot.classList.toggle('bg-[#D4AF37]', i === index);
        dot.classList.toggle('bg-[#041B44]', i !== index);
    });
}

function moveDirectorsSlide(direction) {
    currentDirectorSlide = (currentDirectorSlide + direction + totalDirectorSlides) % totalDirectorSlides;
    goToDirectorSlide(currentDirectorSlide);
}

// Metrics Slider
let currentMetricsSlide = 0;
const metricsSlides = document.querySelectorAll('#metrics-slider > div');
const totalMetricsSlides = metricsSlides.length;

function goToMetricsSlide(index) {
    currentMetricsSlide = index;
    const offset = -index * 100;
    document.getElementById('metrics-slider').style.transform = `translateX(${offset}%)`;
    
    // Update navigation dots
    const dots = document.querySelectorAll('.metrics-dot');
    dots.forEach((dot, i) => {
        dot.classList.toggle('bg-[#D4AF37]', i === index);
        dot.classList.toggle('bg-gray-400', i !== index);
    });
}

function moveMetricsSlide(direction) {
    currentMetricsSlide = (currentMetricsSlide + direction + totalMetricsSlides) % totalMetricsSlides;
    goToMetricsSlide(currentMetricsSlide);
}

// Mobile Metrics Slider
let currentMobileMetricsSlide = 0;
const mobileMetricsSlides = document.querySelectorAll('#mobile-metrics-slider > div');
const totalMobileMetricsSlides = mobileMetricsSlides.length;

function goToMobileMetricsSlide(index) {
    currentMobileMetricsSlide = index;
    
    // Update navigation dots
    const dots = document.querySelectorAll('.mobile-metrics-dot');
    dots.forEach((dot, i) => {
        dot.classList.toggle('bg-[#D4AF37]', i === index);
        dot.classList.toggle('bg-white', i !== index);
        dot.classList.toggle('opacity-30', i !== index);
    });
}

// Service Buttons Functionality
document.addEventListener('DOMContentLoaded', function() {
    const serviceButtons = document.querySelectorAll('.service-btn');
    const serviceContent = document.getElementById('serviceContent');
    
    if (serviceButtons && serviceContent) {
        serviceButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                serviceButtons.forEach(btn => {
                    btn.classList.remove('bg-[#D4AF37]');
                    btn.classList.add('bg-[#1a1f2e]');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-[#1a1f2e]');
                this.classList.add('bg-[#D4AF37]');
                
                // Update service content based on index
                updateServiceContent(index);
            });
        });
        
        // Initialize with first service
        updateServiceContent(0);
    }
});

function updateServiceContent(index) {
    const serviceContent = document.getElementById('serviceContent');
    if (!serviceContent) return;
    
    // Try to get services from the page data
    let services = [];
    if (window.homeData && window.homeData.services) {
        services = window.homeData.services;
    } else {
        // Fallback to default services
        services = [
            {
                title_en: 'GOVERNANCE ADVISORY',
                description_en: 'The investment offices and Endowment funds for HNWI, Family Offices, and Endowments.',
                image: 'design/images/assist1.png'
            },
            {
                title_en: 'WEALTH PLANNING',
                description_en: 'Comprehensive wealth planning strategies tailored to your unique financial goals.',
                image: 'design/images/assist2.png'
            },
            {
                title_en: 'STRATEGIC INVESTMENT ADVISORY',
                description_en: 'Expert investment guidance to maximize your portfolio returns.',
                image: 'design/images/assist3.png'
            },
            {
                title_en: 'CIO OFFICE SERVICES',
                description_en: 'Outsourced Chief Investment Officer services for institutional clients.',
                image: 'design/images/assist4.png'
            }
        ];
    }
    
    const service = services[index] || services[0];
    
    serviceContent.innerHTML = `
        <div class="relative w-full h-full overflow-hidden rounded-lg">
            <img src="${service.image || 'design/images/assist1.png'}" alt="${service.title_en || service.title || 'Service'}" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="text-2xl font-neue-bold mb-3 text-white">${service.title_en || service.title || 'Service'}</h3>
                <p class="text-white text-lg mb-4 opacity-90">${service.description_en || service.description || 'Service description'}</p>
                <a href="services.html" class="text-[#D4AF37] font-neue-bold text-lg hover:underline">Read More</a>
            </div>
        </div>
    `;
}

// Initialize all sliders when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Initialize hero slider
    if (slides.length > 0) {
        goToSlide(0);
    }
    
    // Initialize directors slider
    if (directorSlides.length > 0) {
        goToDirectorSlide(0);
    }
    
    // Initialize metrics slider
    if (metricsSlides.length > 0) {
        goToMetricsSlide(0);
    }
    
    // Initialize mobile metrics
    if (mobileMetricsSlides.length > 0) {
        goToMobileMetricsSlide(0);
    }
});
