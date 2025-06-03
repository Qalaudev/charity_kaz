<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <!-- Navbar placeholder -->
        <navbar/>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-5 py-2.5 bg-green-100 text-green-800 text-sm font-semibold rounded-full mb-6 animate-pulse shadow-md hover:scale-105 transition-transform duration-300">
                    <svg class="w-4 h-4 mr-2 animate-bounce text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    Байланысқа шығыңыз
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 relative inline-block">
                    Бізбен
                    <span class="bg-gradient-to-r from-green-500 to-emerald-600 bg-clip-text text-transparent animate-text-flicker">
            Хабарласыңыз
        </span>
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-green-400 rounded-full animate-pulse delay-500"></span>
                </h1>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto animate-fade-in-up delay-200">
                    Сіздің пікіріңіз бізге маңызды. Сұрақтарыңыз бен ұсыныстарыңызды бізге жіберіңіз, біз тез арада жауап береміз.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl border border-green-100 p-8 md:p-12 transition-all duration-300 hover:shadow-2xl hover:scale-[1.01]">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-green-700 mb-3">Хабарлама жіберу</h2>
                            <p class="text-green-600">Төмендегі форманы толтырып, бізге хабарласа аласыз</p>
                        </div>

                        <form @submit.prevent="submitForm" class="space-y-6">
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-green-800 mb-2">
                                        Аты <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="form.first_name"
                                            type="text"
                                            class="w-full px-4 py-4 bg-white border-2 border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105"
                                            placeholder="Сіздің атыңыз"
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <p v-if="errors.first_name" class="text-red-500 text-sm mt-2 font-medium">{{ errors.first_name[0] }}</p>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-green-800 mb-2">
                                        Тегі <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="form.last_name"
                                            type="text"
                                            class="w-full px-4 py-4 bg-white border-2 border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105"
                                            placeholder="Сіздің тегіңіз"
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <p v-if="errors.last_name" class="text-red-500 text-sm mt-2 font-medium">{{ errors.last_name[0] }}</p>
                                </div>
                            </div>

                            <!-- Email & Phone -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-green-800 mb-2">
                                        Электрондық пошта <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            class="w-full px-4 py-4 bg-white border-2 border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105"
                                            placeholder="example@email.com"
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <p v-if="errors.email" class="text-red-500 text-sm mt-2 font-medium">{{ errors.email[0] }}</p>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-green-800 mb-2">
                                        Телефон нөмірі
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="form.phone"
                                            type="tel"
                                            class="w-full px-4 py-4 bg-white border-2 border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105"
                                            placeholder="+7 (___) ___-__-__"
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <p v-if="errors.phone" class="text-red-500 text-sm mt-2 font-medium">{{ errors.phone[0] }}</p>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-green-800 mb-2">
                                    Хабарлама <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
            <textarea
                v-model="form.message"
                rows="6"
                class="w-full px-4 py-4 bg-white border-2 border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-[1.01] resize-none"
                placeholder="Сіздің хабарламаңызды осы жерге жазыңыз..."
            ></textarea>
                                    <div class="absolute top-4 right-4">
                                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <p v-if="errors.message" class="text-red-500 text-sm mt-2 font-medium">{{ errors.message[0] }}</p>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button
                                    type="submit"
                                    :disabled="loading"
                                    class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-green-400 to-green-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none"
                                >
            <span v-if="loading" class="flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Жіберілуде...
            </span>
                                    <span v-else class="flex items-center justify-center">
              Хабарлама жіберу
              <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </span>
                                </button>

                                <p v-if="success" class="text-green-600 font-semibold mt-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Хабарламаңыз сәтті жіберілді!
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <!-- Contact Card -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-100 p-8 hover:shadow-green-200 transition-shadow duration-500">
                        <h3 class="text-3xl font-bold text-green-700 mb-6 animate-fade-in-up">Байланыс ақпараты</h3>

                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="flex items-start space-x-4 group transition-all duration-300 hover:scale-[1.01]">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:rotate-6 transition-transform duration-500">
                                    <svg class="w-6 h-6 text-white animate-pulse-slow" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-800 mb-1">Мекенжайымыз</h4>
                                    <p class="text-gray-600">Алматы қаласы, Жандосов көшесі, 55</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start space-x-4 group hover:scale-[1.01] transition-all duration-300">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-md group-hover:rotate-6 transition-transform duration-500">
                                    <svg class="w-6 h-6 text-white animate-pulse-slow" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-800 mb-1">Телефон</h4>
                                    <a href="+7 747 062 03 72" class="text-gray-600 hover:text-green-600 transition-colors">+7 747 062 03 72</a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4 group hover:scale-[1.01] transition-all duration-300">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-lime-500 rounded-xl flex items-center justify-center shadow-md group-hover:rotate-6 transition-transform duration-500">
                                    <svg class="w-6 h-6 text-white animate-pulse-slow" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-800 mb-1">Электрондық пошта</h4>
                                    <a href="mailto:Givelifecharity@Gmail.Com" class="text-gray-600 hover:text-green-600 transition-colors">qoldau@gmail.com</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-100 p-8 hover:shadow-green-200 transition-shadow duration-500">
                        <h3 class="text-3xl font-bold text-green-700 mb-6 animate-fade-in-up">Жұмыс уақыты</h3>

                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between items-center py-2 border-b border-dashed border-gray-200">
                                <span>Дүйсенбі - Жұма</span>
                                <span class="font-semibold text-green-700">09:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-dashed border-gray-200">
                                <span>Сенбі</span>
                                <span class="font-semibold text-green-700">10:00 - 16:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span>Жексенбі</span>
                                <span class="font-semibold text-red-500">Демалыс</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-100 p-8 hover:shadow-green-200 transition-shadow duration-500">
                        <h3 class="text-3xl font-bold text-green-700 mb-6 animate-fade-in-up">Әлеуметтік желілер</h3>

                        <div class="flex space-x-4">
                            <a href="#" aria-label="Twitter" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-md">
                                <!-- Twitter -->
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775
                         1.014-.608 1.794-1.574 2.163-2.724-.949.564-2.005.974-3.127 1.195
                         -.897-.959-2.178-1.559-3.594-1.559-2.717 0-4.92 2.203-4.92 4.917
                         0 .39.045.765.127 1.124-4.083-.205-7.702-2.158-10.126-5.134
                         -.422.722-.664 1.561-.664 2.457 0 1.69.86 3.179 2.168 4.054
                         -.8-.026-1.555-.245-2.212-.612v.061c0 2.362 1.678 4.333 3.91 4.778
                         -.409.11-.839.171-1.284.171-.314 0-.615-.03-.916-.086
                         .631 1.953 2.445 3.377 4.6 3.417-1.68 1.317-3.809 2.105-6.102 2.105
                         -.396 0-.788-.023-1.17-.067 2.179 1.397 4.768 2.209 7.557 2.209
                         9.054 0 14-7.496 14-13.986 0-.21 0-.423-.015-.633
                         .962-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                                </svg>
                            </a>

                            <a href="#" aria-label="Facebook" class="w-12 h-12 bg-green-600 hover:bg-green-700 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-md">
                                <!-- Facebook -->
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22.675 0h-21.35C.595 0 0 .594 0 1.326v21.348C0 23.406.595 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413
                         c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.466.099 2.797.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.31h3.587
                         l-.467 3.622h-3.12V24h6.116c.73 0 1.325-.594 1.325-1.326V1.326C24 .594 23.405 0 22.675 0z"/>
                                </svg>
                            </a>

                            <a href="#" aria-label="Instagram" class="w-12 h-12 bg-gradient-to-br from-green-400 to-lime-500 hover:from-green-500 hover:to-lime-600 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-md">
                                <!-- Instagram -->
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zm0 2h8.5A3.75 3.75 0 0120 7.75v8.5a3.75 3.75 0 01-3.75 3.75h-8.5A3.75 3.75 0 014 16.25v-8.5A3.75 3.75 0 017.75 4zm8.406 1.563a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Partners Section -->
            <div class="mt-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold text-lime-600 drop-shadow-md animate-fade-in-up duration-1000">Серіктестеріміз</h2>
                    <p class="text-gray-500 text-lg animate-fade-in-up delay-200 duration-1000">Біз сенімді серіктестермен бірге жұмыс істейміз</p>
                </div>

                <div class="bg-gradient-to-br from-white to-lime-50/40 backdrop-blur-xl rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-lime-100/50 p-8 animate-fade-in duration-1000">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                        <div class="flex justify-center group">
                            <img src="/storage/app/public/images/1.png" alt="Partner 1" class="h-16 opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-125 transition-all duration-500 ease-out hover:rotate-1">
                        </div>
                        <div class="flex justify-center group">
                            <img src="/storage/app/public/images/2.png" alt="Partner 2" class="h-16 opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-125 transition-all duration-500 ease-out hover:-rotate-1">
                        </div>
                        <div class="flex justify-center group">
                            <img src="/storage/app/public/images/3.png" alt="Partner 3" class="h-16 opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-125 transition-all duration-500 ease-out hover:rotate-2">
                        </div>
                        <div class="flex justify-center group">
                            <img src="/storage/app/public/images/4.png" alt="Partner 4" class="h-16 opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-125 transition-all duration-500 ease-out hover:-rotate-2">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Navbar from './Navbar.vue';


export default {
    name: 'ContactForm',
    components: {
        Navbar,
    },

    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                message: ''
            },
            errors: {},
            loading: false,
            success: false
        }
    },
    methods: {
        async submitForm() {
            this.loading = true;
            this.errors = {};
            this.success = false;

            try {
                const params = this.form;
                 axios.post('/contact',params).then(response => {
                     if (response.data.success) {
                         setTimeout(() => {
                             this.success = true;
                         }, 2000);
                     }
                     this.resetForm();
                 });

            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Error submitting form:', error);
                }
            } finally {
                this.loading = false;
            }
        },
        resetForm() {
            this.form = {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                message: ''
            };
        }
    }
}
</script>

<style scoped>

</style>
