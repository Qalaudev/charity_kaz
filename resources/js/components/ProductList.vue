<template>
    <div class="font-sans ">
        <navbar/>

        <!-- Main container -->
        <div class="w-full max-w-7xl mx-auto px-4">
            <!-- Carousel container -->
            <div class="carousel-container relative rounded-2xl shadow-xl overflow-hidden border border-green-200 bg-gradient-to-br from-white via-green-50 to-white">

                <!-- Progress bar -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-green-100 rounded-full overflow-hidden z-20">
                    <div class="progress-bar absolute top-0 left-0 h-full w-1/3 bg-gradient-to-r from-green-400 via-lime-400 to-green-500 animate-pulse transition-all duration-1000 ease-in-out"></div>
                </div>

                <!-- Navigation buttons -->
                <button class="nav-button absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-green-700 bg-white/70 backdrop-blur-md hover:bg-green-100 transition duration-300 shadow-md" onclick="prevSlide()" title="Previous slide">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button class="nav-button absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-green-700 bg-white/70 backdrop-blur-md hover:bg-green-100 transition duration-300 shadow-md" onclick="nextSlide()" title="Next slide">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Carousel track -->
                <div class="carousel-track relative h-[400px] sm:h-[500px] md:h-[600px] w-full overflow-hidden">
                    <!-- Carousel items -->
                    <div class="carousel-item active absolute top-0 left-0 w-full h-full transition-all duration-700 ease-in-out">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-3xl overflow-hidden relative group shadow-2xl">
                                <img src="/storage/app/public/navbarImage/photo1.jpg" alt="Geometric art installation" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute  from-green-200/30 to-white/20 mix-blend-overlay backdrop-blur-sm"></div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item next absolute top-0 left-0 w-full h-full transition-all duration-700 ease-in-out">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-3xl overflow-hidden relative group shadow-2xl">
                                <img src="/storage/app/public/navbarImage/photo2.jpg" alt="Futuristic tech setup" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute from-emerald-300/30 to-white/30 mix-blend-overlay backdrop-blur-sm"></div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item hidden absolute top-0 left-0 w-full h-full transition-all duration-700 ease-in-out">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-3xl overflow-hidden relative group shadow-2xl">
                                <img src="/storage/app/public/navbarImage/photo3.jpg" alt="Abstract digital art" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute  from-lime-300/30 to-green-200/30 mix-blend-overlay backdrop-blur-sm"></div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item hidden absolute top-0 left-0 w-full h-full transition-all duration-700 ease-in-out">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-3xl overflow-hidden relative group shadow-2xl">
                                <img src="/storage/app/public/navbarImage/photo4.jpg" alt="Abstract digital art" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute  from-lime-300/30 to-green-200/30 mix-blend-overlay backdrop-blur-sm"></div>
                            </div>
                        </div>
                    </div>


                    <div class="carousel-item hidden absolute top-0 left-0 w-full h-full transition-all duration-700 ease-in-out">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-3xl overflow-hidden relative group shadow-2xl">
                                <img src="/storage/app/public/navbarImage/photo5.jpg" alt="Abstract digital art" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute  from-lime-300/30 to-green-200/30 mix-blend-overlay backdrop-blur-sm"></div>
                            </div>
                        </div>
                    </div>



                    <!-- Cards at the bottom -->
                    <div class="absolute bottom-0 left-0 right-0 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 py-6 px-4">
                        <a href="/charity-help" class="bg-white/80 text-green-800 px-6 py-4 rounded-2xl shadow-lg text-center text-lg font-semibold hover:bg-green-100 hover:-translate-y-1 transition duration-300 backdrop-blur-sm">
                            Қайырымдылық Көмек
                        </a>
                        <a href="/ai" class="bg-white/80 text-green-800 px-6 py-4 rounded-2xl shadow-lg text-center text-lg font-semibold hover:bg-green-100 hover:-translate-y-1 transition duration-300 backdrop-blur-sm">
                            Психологиялық Көмек
                        </a>
                        <a href="/volunteer-service" class="bg-white/80 text-green-800 px-6 py-4 rounded-2xl shadow-lg text-center text-lg font-semibold hover:bg-green-100 hover:-translate-y-1 transition duration-300 backdrop-blur-sm">
                            Еріктілік Қызметі
                        </a>
                    </div>
                </div>

                <!-- Indicators -->
                <div class="absolute bottom-3 sm:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                    <button class="w-8 sm:w-12 h-1.5 rounded-full bg-green-500/60 hover:bg-green-600 transition-colors duration-300"></button>
                    <button class="w-8 sm:w-12 h-1.5 rounded-full bg-green-300/50 hover:bg-green-500 transition-colors duration-300"></button>
                    <button class="w-8 sm:w-12 h-1.5 rounded-full bg-green-300/50 hover:bg-green-500 transition-colors duration-300"></button>
                </div>
            </div>
        </div>

    </div>
    <HomePage></HomePage>
</template>

<script>
import axios from 'axios';
import HomePage from './HomePage.vue';
import Navbar from './Navbar.vue';
import VueTheMask from 'vue-the-mask';
import { ref } from 'vue';
import { Eye, EyeOff } from 'lucide-vue-next';

export default {
    directives: {
      mask:VueTheMask.mask,
    },
    data() {
        return {
            products: [],
            currentSlide: 0,
            slides: [],
            indicators: [],
            progressBar: null,
            autoAdvanceTimer: null,
            touchStartX: 0,
            touchEndX: 0,

            showModal: false,
            step:1,
            email:"",
            validEmail: true,
            code:"",
            password: "",
            loading: false,
            isLoggedIn: false,
            isVisible: false,

        };
    },

    components: {
        HomePage,
        Navbar,
        'eye-icon': Eye,
        'eye-off-icon': EyeOff
    },


    setup() {
        const showModal = ref('');
        const isVisible = ref(false);
        const phone = ref('+7 ');
        const email = ref('');
        const verificationCode = ref('');
        const verificationSent = ref(false);
        const isVerified = ref(false);

        const closeModal = () => (showModal.value = '');
        const toggleVisibility = () => (isVisible.value = !isVisible.value);
        const sendVerificationCode = () => (verificationSent.value = true);
        const verifyCode = () => (isVerified.value = true);

        return { showModal, isVisible, phone, email, verificationCode, verificationSent, isVerified, closeModal, toggleVisibility, sendVerificationCode, verifyCode };
    },

    created() {
        this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'
    },

    mounted() {
        this.slides = document.querySelectorAll('.carousel-item');
        this.indicators = document.querySelectorAll('.bottom-2 button, .bottom-4 button');
        this.progressBar = document.querySelector('.progress-bar');
        const carousel = document.querySelector('.carousel-track');

        carousel.addEventListener('touchstart', e => {
            this.touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carousel.addEventListener('touchend', e => {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        }, { passive: true });

        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                this.currentSlide = index;
                this.updateSlides();
                this.resetAutoAdvance();
            });
        });

        this.updateSlides();
        this.resetAutoAdvance();
    },

    methods: {
        openRegister(){
          this.showModal = 'register';
          this.step=1;
          this.email = this.code = this.password = '';
          this.validEmail = false
        },
        closeModal() {
            this.showModal = false;
            this.showModal = false;
            this.step = 1;
            this.email = "";
            this.code = "";
            this.password = "";
        },
        validateEmail() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            this.validEmail = emailPattern.test(this.email);
        },
        validateCode() {
            this.code = this.code.replace(/[^0-9]/g, "").slice(0, 6);
        },
        handleSwipe() {
            const swipeThreshold = 50;
            const diff = this.touchStartX - this.touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    this.nextSlide();
                } else {
                    this.prevSlide();
                }
            }
        },
        updateSlides() {
            this.slides.forEach((slide, index) => {
                slide.className = 'carousel-item absolute top-0 left-0 w-full h-full';
                if (index === this.currentSlide) {
                    slide.classList.add('active');
                } else if (index === (this.currentSlide + 1) % this.slides.length) {
                    slide.classList.add('next');
                } else if (index === (this.currentSlide - 1 + this.slides.length) % this.slides.length) {
                    slide.classList.add('prev');
                } else {
                    slide.classList.add('hidden');
                }
            });

            this.indicators.forEach((indicator, index) => {
                indicator.className = `w-8 sm:w-12 h-1 sm:h-1.5 rounded-full transition-colors ${
                    index === this.currentSlide ? 'bg-white/40' : 'bg-white/20'
                } hover:bg-white/60`;
            });

            if (this.progressBar) {
                this.progressBar.style.width = `${((this.currentSlide + 1) / this.slides.length) * 100}%`;
            }
        },
        resetAutoAdvance() {
            clearInterval(this.autoAdvanceTimer);
            this.autoAdvanceTimer = setInterval(this.nextSlide, 5000);
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            this.updateSlides();
            this.resetAutoAdvance();
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.updateSlides();
            this.resetAutoAdvance();
        },



        async sendCode(){
            this.loading = true;
            try{
                await axios.post('/send-code',{email: this.email});
                this.step = 2;
            }catch (e){
                alert(e.response?.data?.message || 'Ошибка при отправке кода!');
            } finally {
                this.loading = false;
            }
        },
        async verifyCode(){
            this.loading = true;
            try{
                const res = await axios.post('/verify-code', {
                   email:this.email,
                    code:this.code.trim()
                });
                if(res.data.success){
                    this.step = 3;
                }else {
                    alert('Неверный код или истек срок действия');
                }
            }catch (e) {
                alert(e.response?.dark?.message || 'Ошибка при входе кода');
            } finally {
                this.loading = false;
            }
        },
        async submitRegistration(){
            this.loading = true;
            try {
                const response = await axios.post('/register', {
                    email: this.email,
                    password: this.password
                });

                if (response.data.success)
                {
                    alert(response.data.message);
                    window.location.href = '/';
                }
            } catch (e) {
                alert(e.response?.data?.message || 'Ошибка при регистрации');
            } finally {
                this.loading = false;
            }
        },
        async submitLogin(){
            try{
                const response = await axios.post('/login',{
                    email:this.email,
                    password: this.password
                });
                this.isLoggedIn = true
                localStorage.setItem('isLoggedIn', 'true')
                this.closeModal()
                alert(response.data.message || "Сәтті кірдіңіз");
                this.showModal = '';
            }catch (e){
                if (e.response?.data?.message) {
                    alert(e.response.data.error || 'Ошибка при логин');
                } else {
                    alert('Қате! Кейінірек байқап көріңіз')
                }
            }
        },
        goToProfile() {
            this.$router.push( '/profile/user' )
        },
        changeLanguage(lang){
            this.$i18n.locale = lang;
        },

        toggleVisibility() {
            this.isVisible = !this.isVisible
        },
    },
};
</script>

<style>
.carousel-container {
    perspective: 1000px;
    touch-action: pan-y pinch-zoom;
}

.carousel-track {
    transform-style: preserve-3d;
    transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}

.carousel-item {
    backface-visibility: hidden;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}

.carousel-item.active {
    opacity: 1;
    transform: scale(1) translateZ(0);
}

@media (max-width: 640px) {
    .carousel-item.prev {
        opacity: 0;
        transform: scale(0.8) translateX(-50%) translateZ(-100px);
    }

    .carousel-item.next {
        opacity: 0;
        transform: scale(0.8) translateX(50%) translateZ(-100px);
    }
}

@media (min-width: 641px) {
    .carousel-item.prev {
        opacity: 0.7;
        transform: scale(0.9) translateX(-100%) translateZ(-100px);
    }

    .carousel-item.next {
        opacity: 0.7;
        transform: scale(0.9) translateX(100%) translateZ(-100px);
    }
}

.carousel-item.hidden {
    opacity: 0;
    transform: scale(0.8) translateZ(-200px);
}

.nav-button {
    transition: all 0.3s;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

@media (hover: hover) {
    .nav-button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }
}

.nav-button:active {
    transform: scale(0.95);
}

.progress-bar {
    transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}
</style>
