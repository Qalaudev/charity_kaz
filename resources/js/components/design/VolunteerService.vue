<template>
    <div class="volunteer-service min-h-screen bg-gradient-to-br from-green-50 via-green-100 to-teal-100 selection:bg-green-300 selection:text-white">

        <!-- Navbar placeholder -->
        <Navbar></Navbar>

        <!-- Header Section -->
        <div class="bg-white shadow-md rounded-b-3xl">
            <div class="max-w-7xl mx-auto px-6 py-10">
                <div class="text-center animate-fadeInUp">
                    <h1 class="text-5xl font-extrabold text-green-800 mb-5 tracking-wide drop-shadow-md">Еріктілік Қызметі</h1>
                    <p class="text-xl text-green-700 max-w-3xl mx-auto leading-relaxed tracking-wide">
                        Еріктілер болып қызмет ету арқылы қоғамға пайдалы жұмыс істеп, адамдарға көмек көрсетіңіз. Сіздің уақытыңыз бен қабілетіңіз арқылы біз көп нәрсеге жете аламыз.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-14">

            <!-- Volunteer Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl border border-green-200 hover:shadow-2xl transition-transform transform hover:-translate-y-2 animate-fadeIn">
                    <div class="text-4xl font-extrabold text-green-600 mb-3 animate-pulse">{{
                            342
                        }}</div>
                    <div class="text-green-700 font-semibold tracking-wide">Белсенді еріктілер</div>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl border border-blue-200 hover:shadow-2xl transition-transform transform hover:-translate-y-2 animate-fadeIn delay-150">
                    <div class="text-4xl font-extrabold text-blue-600 mb-3 animate-pulse">{{
                            1,856
                        }}</div>
                    <div class="text-blue-700 font-semibold tracking-wide">Жасалған жұмыс сағаты</div>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl border border-purple-200 hover:shadow-2xl transition-transform transform hover:-translate-y-2 animate-fadeIn delay-300">
                    <div class="text-4xl font-extrabold text-purple-600 mb-3 animate-pulse">{{
                            28
                        }}</div>
                    <div class="text-purple-700 font-semibold tracking-wide">Белсенді жобалар</div>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl border border-orange-200 hover:shadow-2xl transition-transform transform hover:-translate-y-2 animate-fadeIn delay-450">
                    <div class="text-4xl font-extrabold text-orange-500 mb-3 animate-pulse">{{
                            '95%'
                        }}</div>
                    <div class="text-orange-600 font-semibold tracking-wide">Қанағаттану деңгейі</div>
                </div>
            </div>

            <!-- Volunteer Opportunities -->
            <div class="mb-16">
                <h2 class="text-4xl font-extrabold text-green-900 mb-12 text-center tracking-wide animate-fadeInUp">Еріктілік Мүмкіндіктері</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div
                        v-for="opportunity in opportunities"
                        :key="opportunity.id"
                        class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-300 cursor-pointer animate-fadeIn"
                    >
                        <div
                            class="h-48 flex items-center justify-center text-7xl"
                            :class="[opportunity.bgColor, 'bg-opacity-20']"
                            style="animation: pulseBackground 4s infinite alternate;"
                        >
                            {{ opportunity.icon }}
                        </div>
                        <div class="p-7">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-bold text-green-900 tracking-tight">{{ opportunity.title }}</h3>
                                <span
                                    class="px-4 py-1 text-xs font-semibold rounded-full"
                                    :class="[opportunity.categoryColor, 'bg-opacity-20']"
                                >
                  {{ opportunity.category }}
                </span>
                            </div>
                            <p class="text-green-700 mb-6 leading-relaxed">{{ opportunity.description }}</p>
                            <div class="space-y-3 mb-6 text-green-600 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-green-500 animate-bounce">📅</span> {{ opportunity.schedule }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-green-500 animate-bounce delay-150">📍</span> {{ opportunity.location }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-green-500 animate-bounce delay-300">👥</span> {{ opportunity.spots }} орын қажет
                                </div>
                            </div>
                            <button
                                @click="applyForOpportunity(opportunity.id)"
                                class="w-full bg-gradient-to-r from-green-600 to-teal-600 text-white py-4 rounded-xl font-semibold hover:from-green-700 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                Қатысу
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 mb-16 animate-fadeInUp">
                <h2 class="text-4xl font-extrabold text-green-900 mb-10 text-center tracking-wide">Еріктілікке Тіркелу</h2>
                <div class="max-w-3xl mx-auto">
                    <form @submit.prevent="submitVolunteerApplication" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-green-900 font-semibold mb-3 tracking-wide">Аты-жөні</label>
                                <input
                                    v-model="volunteerForm.name"
                                    type="text"
                                    required
                                    class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm"
                                />
                            </div>
                            <div>
                                <label class="block text-green-900 font-semibold mb-3 tracking-wide">Жасы</label>
                                <input
                                    v-model.number="volunteerForm.age"
                                    type="number"
                                    min="16"
                                    max="80"
                                    required
                                    class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-green-900 font-semibold mb-3 tracking-wide">Телефон</label>
                                <input
                                    v-model="volunteerForm.phone"
                                    type="tel"
                                    required
                                    class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm"
                                />
                            </div>
                            <div>
                                <label class="block text-green-900 font-semibold mb-3 tracking-wide">Электрондық пошта</label>
                                <input
                                    v-model="volunteerForm.email"
                                    type="email"
                                    required
                                    class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-green-900 font-semibold mb-4 tracking-wide">Қызығушылық саласы</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 text-green-700">
                                <label
                                    v-for="interest in interests"
                                    :key="interest"
                                    class="flex items-center cursor-pointer select-none"
                                >
                                    <input
                                        v-model="volunteerForm.interests"
                                        :value="interest"
                                        type="checkbox"
                                        class="rounded border-green-400 text-green-600 focus:ring-green-500"
                                    />
                                    <span class="ml-3 text-lg font-medium">{{ interest }}</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-green-900 font-semibold mb-3 tracking-wide">Қол жетімді уақыт</label>
                            <select
                                v-model="volunteerForm.availability"
                                required
                                class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm"
                            >
                                <option value="" disabled>Таңдаңыз</option>
                                <option value="weekdays">Жұмыс күндері</option>
                                <option value="weekends">Демалыс күндері</option>
                                <option value="evenings">Кешкі уақыт</option>
                                <option value="flexible">Икемді уақыт</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-900 font-semibold mb-3 tracking-wide">Тәжірибе мен дағдылар</label>
                            <textarea
                                v-model="volunteerForm.experience"
                                rows="5"
                                placeholder="Сіздің алдыңғы тәжірибеңіз, дағдыларыңыз және мотивацияңыз туралы жазыңыз"
                                class="w-full px-5 py-4 border border-green-300 rounded-2xl focus:ring-4 focus:ring-green-400 focus:outline-none transition shadow-sm resize-none"
                            ></textarea>
                        </div>

                        <div class="flex items-start space-x-3">
                            <input
                                v-model="volunteerForm.agreement"
                                type="checkbox"
                                required
                                class="rounded border-green-400 text-green-600 focus:ring-green-500 mt-1"
                            />
                            <label class="text-green-800 text-sm font-medium leading-relaxed">
                                Мен еріктілік қызмет шарттарымен келісемін және жеке деректерімді өңдеуге рұқсат беремін
                            </label>
                        </div>

                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-full bg-gradient-to-r from-green-600 to-teal-600 text-white py-5 rounded-3xl font-bold hover:from-green-700 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            {{ isSubmitting ? 'Жіберілуде...' : 'Тіркелу' }}
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Footer placeholder -->
        <footer class="bg-green-900 text-white text-center py-8">
            &copy; 2025 Еріктілік Қызметі. Барлық құқықтар қорғалған.
        </footer>
    </div>
</template>

<script>


import Navbar from '../Navbar.vue'

export default {
    name: 'VolunteerService',
    components: {
        Navbar,
    },
    data() {
        return {
            isSubmitting: false,
            volunteerForm: {
                name: '',
                age: '',
                phone: '',
                email: '',
                interests: [],
                availability: '',
                experience: '',
                agreement: false
            },
            interests: [
                'Балалармен жұмыс',
                'Кәрілерге қамқорлық',
                'Білім беру',
                'Медициналық көмек',
                'Экология',
                'Спорт',
                'Мәдениет',
                'Технология',
                'Аудару қызметі'
            ],
            opportunities: [
                {
                    id: 1,
                    title: 'Балаларға оқыту',
                    description: 'Қиын жағдайдағы балаларға сабақ беру және үй жұмыстарына көмек көрсету',
                    category: 'Білім беру',
                    categoryColor: 'bg-blue-100 text-blue-800',
                    schedule: 'Аптасына 2-3 рет',
                    location: 'Алматы қаласы',
                    spots: 5,
                    icon: '📚',
                    bgColor: 'bg-blue-100'
                },
                {
                    id: 2,
                    title: 'Кәрілерге көмек',
                    description: 'Жалғыз кәрілерге азық-түлік сатып алу және үй жұмыстарына көмек',
                    category: 'Қамқорлық',
                    categoryColor: 'bg-purple-100 text-purple-800',
                    schedule: 'Дүйсенбі-жұма',
                    location: 'Нұр-Сұлтан қаласы',
                    spots: 8,
                    icon: '👵',
                    bgColor: 'bg-purple-100'
                },
                {
                    id: 3,
                    title: 'Экологиялық тазалау',
                    description: 'Саябақтар мен көшелерді тазалау, ағаш отырғызу жобаларына қатысу',
                    category: 'Экология',
                    categoryColor: 'bg-green-100 text-green-800',
                    schedule: 'Сенбі таңертең',
                    location: 'Шымкент қаласы',
                    spots: 12,
                    icon: '🌱',
                    bgColor: 'bg-green-100'
                },
                {
                    id: 4,
                    title: 'Ас үй көмекшісі',
                    description: 'Қайырымдылық ас үйінде ас дайындау және таратуға көмек көрсету',
                    category: 'Тамақ беру',
                    categoryColor: 'bg-orange-100 text-orange-800',
                    schedule: 'Күн сайын кеш',
                    location: 'Алматы қаласы',
                    spots: 6,
                    icon: '🍲',
                    bgColor: 'bg-orange-100'
                },
                {
                    id: 5,
                    title: 'Медициналық көмек',
                    description: 'Дәрігерлерге ауруханада немесе емханада көмек көрсету',
                    category: 'Медицина',
                    categoryColor: 'bg-red-100 text-red-800',
                    schedule: 'Икемді уақыт',
                    location: 'Қарағанды қаласы',
                    spots: 3,
                    icon: '🏥',
                    bgColor: 'bg-red-100'
                },
                {
                    id: 6,
                    title: 'Аудару қызметі',
                    description: 'Шетелдік қонақтар мен мұқтаж адамдарға аудармашы ретінде көмек',
                    category: 'Тіл білім',
                    categoryColor: 'bg-indigo-100 text-indigo-800',
                    schedule: 'Қажеттілік бойынша',
                    location: 'Онлайн/Офлайн',
                    spots: 4,
                    icon: '🗣️',
                    bgColor: 'bg-indigo-100'
                }
            ],
            testimonials: [
                {
                    id: 1,
                    name: 'Асем Нұрғалиева',
                    role: 'Еріктілік тәжірибесі: 2 жыл',
                    quote: 'Еріктілік қызмет арқылы көптеген адамдарға көмек көрсетіп, өз-өзімді де дамыттым. Бұл тамаша тәжірибе!'
                },
                {
                    id: 2,
                    name: 'Данияр Әбдіқадыров',
                    role: 'Еріктілік тәжірибесі: 1.5 жыл',
                    quote: 'Балаларға сабақ беру арқылы олардың өсуіне үлес қосу өте қуантады. Ұсынамын!'
                },
                {
                    id: 3,
                    name: 'Гүлнар Сейітова',
                    role: 'Еріктілік тәжірибесі: 3 жыл',
                    quote: 'Кәрілерге көмек көрсету менің жүрегімді жылытады. Олардың алғыс сөздері - ең үлкен сыйақы.'
                }
            ]
        }
    },
    methods: {
        async submitVolunteerApplication() {
            this.isSubmitting = true;
            try {
                // Validate form
                if (!this.volunteerForm.name || !this.volunteerForm.email || !this.volunteerForm.phone) {
                    throw new Error('Барлық міндетті өрістерді толтырыңыз');
                }

                if (this.volunteerForm.interests.length === 0) {
                    throw new Error('Кем дегенде бір қызығушылық саласын таңдаңыз');
                }

                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 2000));

                // Show success message
                alert(`Рақмет, ${this.volunteerForm.name}! Сіздің өтінімді қабылдадық. Біз жақын арада сізбен байланысамыз.`);

                // Reset form
                this.volunteerForm = {
                    name: '',
                    age: '',
                    phone: '',
                    email: '',
                    interests: [],
                    availability: '',
                    experience: '',
                    agreement: false
                };
            } catch (error) {
                alert(error.message || 'Қате пайда болды. Қайталап көріңіз.');
            } finally {
                this.isSubmitting = false;
            }
        },

        applyForOpportunity(opportunityId) {
            // Find the opportunity
            const opportunity = this.opportunities.find(op => op.id === opportunityId);
            if (opportunity) {
                // Pre-fill form with related interest
                const relatedInterests = {
                    1: 'Балалармен жұмыс',
                    2: 'Кәрілерге қамқорлық',
                    3: 'Экология',
                    4: 'Балалармен жұмыс',
                    5: 'Медициналық көмек',
                    6: 'Аудару қызметі'
                };

                if (relatedInterests[opportunityId] && !this.volunteerForm.interests.includes(relatedInterests[opportunityId])) {
                    this.volunteerForm.interests.push(relatedInterests[opportunityId]);
                }
            }

            // Scroll to registration form
            document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
        }
    }
}
</script>

<style scoped>
/* Additional custom styles */
.volunteer-service {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

/* Smooth hover transitions */
.bg-white:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}

/* Custom checkbox styles */
input[type="checkbox"]:checked {
    background-color: #059669;
    border-color: #059669;
}

/* Form focus states */
input:focus, select:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

/* Loading animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(25px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes pulseBackground {
    0% {
        background-color: rgba(34,197,94, 0.15);
    }
    100% {
        background-color: rgba(34,197,94, 0.4);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.7s ease forwards;
}

.animate-fadeIn {
    animation: fadeIn 1s ease forwards;
}

.animate-pulse {
    animation: pulse 2.5s infinite;
}

.animate-bounce {
    animation: bounce 2s infinite;
    animation-timing-function: ease-in-out;
    will-change: transform;
}

.delay-150 {
    animation-delay: 0.15s !important;
}

.delay-300 {
    animation-delay: 0.3s !important;
}

.delay-450 {
    animation-delay: 0.45s !important;
}
</style>
