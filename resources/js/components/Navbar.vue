<template>
    <div class="relative z-50">
        <!-- Фон анимациялары -->
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-emerald-100 via-white to-emerald-50 animate-fade-in-slow"></div>
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-emerald-300/20 rounded-full filter blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-emerald-400/20 rounded-full filter blur-3xl animate-pulse-slower"></div>

        <!-- Навигация -->
        <nav class="bg-white shadow-md py-4 border-b border-emerald-100">
            <div class="container mx-auto flex justify-between items-center px-4">
                <!-- Лого және мәзір -->
                <div class="flex items-center gap-6">
                    <a href="/" class="text-3xl font-extrabold tracking-wide text-emerald-700 hover:text-emerald-500 transition-transform duration-500 hover:scale-110 drop-shadow-md uppercase">
                        QOLDAU
                    </a>
                    <ul class="flex gap-6 text-sm font-semibold text-emerald-700">
                        <li><a href="/" class="hover:text-emerald-500 transition">{{$t('menu')}}</a></li>
                        <li><a href="/help" class="hover:text-emerald-500 transition">{{$t('get_help')}}</a></li>
                        <li><a href="/contact-us" class="hover:text-emerald-500 transition">{{$t('contact_uss')}}</a></li>
                    </ul>
                </div>

                <!-- Кнопкалар -->
                <div class="flex items-center gap-3">
                    <a href="/making-donation">
                    <button class="bg-emerald-400 hover:bg-emerald-500 text-white font-medium py-2 px-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105">
                        {{ $t('help') }}
                    </button>
                    </a>

                    <button v-if="!isLoggedIn" @click="showModal = 'login'"
                            class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2 px-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105">
                        {{ $t('login') }}
                    </button>

                    <button v-else @click="goToProfile"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105">
                        {{ $t('profile') }}
                    </button>

                    <!-- Тілдер -->
                    <div class="flex items-center gap-2">
                        <button>
                            <img @click="changeLanguage('kz')" src="https://flagcdn.com/w40/kz.png" alt="KZ" class="h-5 w-5 rounded-full" />
                        </button>
                        <button>
                            <img @click="changeLanguage('en')" src="https://flagcdn.com/w40/gb.png" alt="EN" class="h-5 w-5 rounded-full" />
                        </button>
                        <button>
                            <img @click="changeLanguage('ru')" src="https://flagcdn.com/w40/ru.png" alt="RU" class="h-5 w-5 rounded-full" />
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Login Modal -->
        <div v-if="showModal === 'login'" class="fixed inset-0 z-50 flex items-center justify-center">
            <!-- Фон (жабу үшін) -->
            <div @click="closeModal" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

            <!-- Модаль терезесі -->
            <div class="relative bg-white rounded-3xl w-96 p-8 shadow-2xl z-10 animate-fadeInUp transition-all duration-500">
                <h2 class="text-center text-3xl font-extrabold mb-6 text-green-600 animate-fadeIn">{{ $t('sign_in') }}</h2>

                <div class="mb-4 relative group">
                    <input type="email" v-model="email" placeholder="hello@example.com"
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300 shadow-inner" />
                </div>

                <div class="mb-4 relative group">
                    <input :type="isVisible ? 'text' : 'password'" v-model="password" placeholder="Введите пароль"
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300 shadow-inner" />
                    <span @click="toggleVisibility"
                          class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-green-500 transition-colors">
                <component :is="isVisible ? 'eye-off-icon' : 'eye-icon'" class="w-5 h-5" />
            </span>
                </div>

                <button @click="submitLogin"
                        class="w-full py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                    {{ $t('sign_in') }}
                </button>

                <button @click="showModal = 'register'"
                        class="w-full mt-3 py-3 border-2 border-green-400 text-green-500 hover:bg-green-50 font-bold rounded-xl transition-all duration-300">
                    {{ $t('sign_up') }}
                </button>

                <p class="text-xs text-center text-gray-500 mt-4">
                    Нажимая на кнопку «Зарегистрироваться», вы соглашаетесь с условиями
                    <a href="#" class="text-green-500 underline">договора-оферты</a> и даете согласие на обработку
                    <a href="#" class="text-green-500 underline">персональных данных</a>.
                </p>

                <a href="#" class="text-center block mt-4 text-green-500 hover:underline transition-colors">
                    {{$t('forgot_password')}}
                </a>
            </div>
        </div>


        <!-- Register Modal -->
        <div v-if="showModal === 'register'" class="fixed inset-0 flex items-center justify-center z-50 animate-fadeInUp">
            <div @click="closeModal" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-3xl w-96 p-8 shadow-2xl z-10 animate-fadeIn transition-all duration-500">
                <h2 class="text-center text-3xl font-extrabold mb-6 text-green-600">{{ $t('sign_up') }}</h2>

                <div v-if="step === 1" class="mb-4">
                    <input v-model="email" @input="validateEmail" placeholder="Введите email" type="email" name="email"
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300 shadow-inner" />
                    <button :disabled="!validEmail" @click="sendCode"
                            class="w-full mt-4 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl disabled:opacity-50 transition-all duration-300 shadow-md hover:shadow-lg">
                        {{ $t('get_code') }}
                    </button>
                </div>

                <div v-if="step === 2" class="mb-4">
                    <input v-model="code" @input="validateCode" maxlength="6" placeholder="Введите код" name="code"
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300 shadow-inner" />
                    <button :disabled="code.length !== 6" @click="verifyCode"
                            class="w-full mt-4 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl disabled:opacity-50 transition-all duration-300 shadow-md hover:shadow-lg">
                        {{ $t('next') }}
                    </button>
                </div>

                <div v-if="step === 3" class="mb-4">
                    <input v-model="password" type="password" placeholder="Создайте пароль" name="password"
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300 shadow-inner" />
                    <button @click="submitRegistration"
                            class="w-full py-3 mt-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                        {{ $t('sign_up') }}
                    </button>
                </div>

                <button @click="closeModal"
                        class="w-full mt-4 py-3 border-2 border-green-400 text-green-500 hover:bg-green-50 font-bold rounded-xl transition-all duration-300">
                    {{ $t('cancel') }}
                </button>
            </div>
        </div>


    </div>
</template>

<script>
import {ref} from "vue";
import axios from "axios";

export default {
    name: "Navbar",

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
        async submitRegistration() {
            this.loading = true;
            try {
                const response = await axios.post('/register', {
                    email: this.email,
                    password: this.password
                });

                if (response.data.success) {
                    alert(response.data.message || 'Тіркеу сәтті өтті!');
                    window.location.href = '/';
                }
            } catch (e) {
                alert(e.response?.data?.message || 'Тіркелу кезінде қате орын алды');
            } finally {
                this.loading = false;
            }
        },

        async submitLogin() {
            try {
                const captchaToken = await grecaptcha.execute('6Lfxm00rAAAAAHK2Qegt6PPfC1Stu4D42Pg1QvSR', { action: 'login' });

                const response = await axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    token: captchaToken
                });

                const token = response.data.token;

                localStorage.setItem('token', token);
                localStorage.setItem('isLoggedIn', 'true');

                this.isLoggedIn = true;
                this.closeModal();
                this.showModal = '';
                alert(response.data.message || 'Сәтті кірдіңіз');
            } catch (e) {
                if (e.response?.data?.message) {
                    alert(e.response.data.message || 'Кіру кезінде қате');
                } else {
                    alert('Қате! Кейінірек байқап көріңіз');
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
}
</script>


<style scoped>
/* Optional: қосымша анимациялар Tailwind config ішінде болмаса, мына жерде жаза аласың */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}
.animate-fade-in-slow {
    animation: fadeIn 2s ease-out forwards;
}
.animate-pulse-slow {
    animation: pulse 4s infinite;
}
.animate-pulse-slower {
    animation: pulse 6s infinite;
}
</style>
