<template>
    <div class="charity-help min-h-screen bg-gradient-to-br from-green-50 via-green-100 to-green-200">

        <!-- Navbar placeholder -->
        <Navbar></Navbar>

        <!-- Header Section -->
        <div class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-6 py-10">
                <div class="text-center max-w-3xl mx-auto animate-fadeInUp">
                    <h1 class="text-5xl font-extrabold text-green-800 mb-5 drop-shadow-md tracking-wide">
                        {{ $t('charity_help') }}
                    </h1>
                    <p class="text-lg text-green-700 leading-relaxed">
                        {{ $t('mission_statement')}}
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-14">

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
                <div
                    class="bg-white rounded-xl p-8 text-center shadow-xl hover:shadow-2xl transition-shadow duration-500 cursor-default relative overflow-hidden group"
                >
                    <div
                        class="text-4xl font-extrabold text-green-700 mb-3 animate-countUp"
                    >
                        1,234
                    </div>
                    <div class="text-green-600 font-semibold tracking-wide">{{ $t('helped_families') }}</div>
                    <span
                        class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-green-300 opacity-40 animate-ping-slow group-hover:opacity-60 transition-opacity"
                    ></span>
                </div>

                <div
                    class="bg-white rounded-xl p-8 text-center shadow-xl hover:shadow-2xl transition-shadow duration-500 cursor-default relative overflow-hidden group"
                >
                    <div
                        class="text-4xl font-extrabold text-green-600 mb-3 animate-countUp"
                    >
                        ₸2.5М
                    </div>
                    <div class="text-green-600 font-semibold tracking-wide">{{ $t('collected_funds') }}</div>
                    <span
                        class="absolute -top-6 -left-6 w-24 h-24 rounded-full bg-green-400 opacity-40 animate-ping-slow group-hover:opacity-60 transition-opacity"
                    ></span>
                </div>

                <div
                    class="bg-white rounded-xl p-8 text-center shadow-xl hover:shadow-2xl transition-shadow duration-500 cursor-default relative overflow-hidden group"
                >
                    <div
                        class="text-4xl font-extrabold text-green-700 mb-3 animate-countUp"
                    >
                        856
                    </div>
                    <div class="text-green-600 font-semibold tracking-wide">{{ $t('active_donors') }}</div>
                    <span
                        class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-green-300 opacity-40 animate-ping-slow group-hover:opacity-60 transition-opacity"
                    ></span>
                </div>

                <div
                    class="bg-white rounded-xl p-8 text-center shadow-xl hover:shadow-2xl transition-shadow duration-500 cursor-default relative overflow-hidden group"
                >
                    <div
                        class="text-4xl font-extrabold text-green-600 mb-3 animate-countUp"
                    >
                        45
                    </div>
                    <div class="text-green-600 font-semibold tracking-wide">{{ $t('active_projects') }}</div>
                    <span
                        class="absolute -bottom-6 -left-6 w-24 h-24 rounded-full bg-green-400 opacity-40 animate-ping-slow group-hover:opacity-60 transition-opacity"
                    ></span>
                </div>
            </div>

            <!-- Active Projects -->
            <div class="mb-16">
                <h2 class="text-4xl font-extrabold text-green-800 mb-12 text-center drop-shadow-md animate-fadeIn">
                    {{ $t('active_projects') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div
                        v-for="project in activeProjects"
                        :key="project.id"
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-500 transform hover:-translate-y-1 cursor-pointer"
                    >
                        <div
                            class="h-48 bg-gradient-to-br"
                            :class="project.gradient"
                            style="animation: bgGradientShift 8s ease-in-out infinite alternate;"
                        ></div>
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-green-900 mb-4 tracking-wide">{{ project.title }}</h3>
                            <p class="text-green-700 mb-6 leading-relaxed">{{ project.description }}</p>

                            <div class="mb-6">
                                <div class="flex justify-between text-sm mb-3 font-medium text-green-800">
                                    <span>{{ project.raised.toLocaleString() }} ₸</span>
                                    <span>{{ project.goal.toLocaleString() }} ₸</span>
                                </div>
                                <div class="w-full bg-green-200 rounded-full h-3 overflow-hidden shadow-inner">
                                    <div
                                        class="bg-green-600 h-3 rounded-full transition-all duration-700 ease-in-out"
                                        :style="`width: ${(project.raised / project.goal) * 100}%`"
                                    ></div>
                                </div>
                            </div>
                            <button
                                @click="donateToProject(project.id)"
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-semibold tracking-wide shadow-lg hover:shadow-xl hover:scale-105 transform transition"
                            >
                                {{ $t('help') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation Form -->
<!--            <div class="bg-white rounded-3xl shadow-2xl p-10 mb-16 max-w-3xl mx-auto animate-fadeInUp">-->
<!--                <h2 class="text-4xl font-extrabold text-green-900 mb-10 text-center drop-shadow-md">-->
<!--                    {{ $t('charity_help') }}-->
<!--                </h2>-->
<!--                <form @submit.prevent="submitDonation">-->
<!--                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">-->
<!--                        <div>-->
<!--                            <label class="block text-green-700 font-semibold mb-2">{{ $t('nazvanie')}}</label>-->
<!--                            <input-->
<!--                                v-model="donationForm.name"-->
<!--                                type="text"-->
<!--                                required-->
<!--                                class="w-full px-5 py-4 border border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 focus:border-transparent transition"-->
<!--                            />-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-green-700 font-semibold mb-2">{{ $t('email') }}</label>-->
<!--                            <input-->
<!--                                v-model="donationForm.email"-->
<!--                                type="email"-->
<!--                                required-->
<!--                                class="w-full px-5 py-4 border border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 focus:border-transparent transition"-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="mb-8">-->
<!--                        <label class="block text-green-700 font-semibold mb-3">{{ $t('aid_amount') }}</label>-->
<!--                        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-6">-->
<!--                            <button-->
<!--                                v-for="amount in presetAmounts"-->
<!--                                :key="amount"-->
<!--                                type="button"-->
<!--                                @click="donationForm.amount = amount"-->
<!--                                :class="donationForm.amount === amount-->
<!--                  ? 'bg-green-600 text-white shadow-lg'-->
<!--                  : 'bg-green-100 text-green-700 hover:bg-green-200'"-->
<!--                                class="py-3 px-5 rounded-xl font-semibold transition"-->
<!--                            >-->
<!--                                {{ amount.toLocaleString() }}-->
<!--                            </button>-->
<!--                        </div>-->
<!--                        <input-->
<!--                            v-model.number="donationForm.amount"-->
<!--                            type="number"-->
<!--                            min="100"-->
<!--                            required-->
<!--                            placeholder="Басқа сома енгізіңіз"-->
<!--                            class="w-full px-5 py-4 border border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 focus:border-transparent transition"-->
<!--                        />-->
<!--                    </div>-->

<!--                    <div class="mb-8">-->
<!--                        <label class="block text-green-700 font-semibold mb-3">{{ $t('select_project') }}</label>-->
<!--                        <select-->
<!--                            v-model="donationForm.projectId"-->
<!--                            class="w-full px-5 py-4 border border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 focus:border-transparent transition"-->
<!--                        >-->
<!--                            <option value="">Жалпы қор</option>-->
<!--                            <option v-for="project in activeProjects" :key="project.id" :value="project.id">-->
<!--                                {{ project.title }}-->
<!--                            </option>-->
<!--                        </select>-->
<!--                    </div>-->

<!--                    <div class="mb-8">-->
<!--                        <label class="block text-green-700 font-semibold mb-3">{{ $t('message_optional') }}</label>-->
<!--                        <textarea-->
<!--                            v-model="donationForm.message"-->
<!--                            rows="5"-->
<!--                            placeholder="Сіздің хабарламаңыз немесе тілектеріңіз"-->
<!--                            class="w-full px-5 py-4 border border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 focus:border-transparent transition resize-none"-->
<!--                        ></textarea>-->
<!--                    </div>-->

<!--                    <button-->
<!--                        type="submit"-->
<!--                        :disabled="isSubmitting"-->
<!--                        class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-5 rounded-2xl text-xl font-extrabold tracking-wide shadow-lg hover:from-green-700 hover:to-green-800 hover:shadow-2xl transition disabled:opacity-70 disabled:cursor-not-allowed"-->
<!--                    >-->
<!--                        {{ isSubmitting ? 'Жіберілуде...' : 'Жіберу' }}-->
<!--                    </button>-->
<!--                </form>-->
<!--            </div>-->

            <!-- Success Stories -->
        </div>
    </div>
</template>


<script>
import Navbar from '../Navbar.vue';
export default {
    name: 'CharityHelp',
    components: {
        Navbar,
    },
    data() {
        return {
            isSubmitting: false,
            donationForm: {
                name: '',
                email: '',
                amount: 5000,
                projectId: '',
                message: ''
            },
            presetAmounts: [1000, 2500, 5000, 10000, 25000, 50000],
            activeProjects: [
                {
                    id: 1,
                    title: 'Әлеуметтік аз қамтылған отбасылар',
                    description: 'Әлеуметтік аз қамтылған отбасылардың балаларына білім беру мен медициналық көмек көрсету',
                    raised: 180000,
                    goal: 500000,
                    gradient: 'from-pink-400 to-red-500'
                },
                {
                    id: 2,
                    title: 'Жетім және Ата-анасының қамқорлығынсыз қалған балалар',
                    description: 'Жетім және қамқорлығынсыз қалған балалардың өмір сүру сапасын жақсарту және қолдау көрсету',
                    raised: 320000,
                    goal: 600000,
                    gradient: 'from-purple-400 to-pink-500'
                },
                {
                    id: 3,
                    title: 'Мүмкіндігі шектеулі балалар',
                    description: 'Мүмкіндігі шектеулі балаларға сапалы білім мен арнайы күтім көрсетуге қолдау білдіру',
                    raised: 450000,
                    goal: 800000,
                    gradient: 'from-blue-400 to-purple-500'
                }

            ],
            successStories: [
                {
                    id: 1,
                    name: 'Айгүл Серікова',
                    date: '2024 жылдың қазаны',
                    story: 'Сіздердің көмегіңізбен менің балам қажетті операцияны жасатып, қазір сау-саламат. Рақмет сайсыз!'
                },
                {
                    id: 2,
                    name: 'Мұрат Қасымов',
                    date: '2024 жылдың қыркүйегі',
                    story: 'Отбасымыз қиын кезеңнен өтіп жатқанда, сіздердің қолдауыңыз бізге үлкен көмек болды. Барлығына алғыс!'
                }
            ]
        }
    },
    methods: {
        async submitDonation() {
            this.isSubmitting = true;
            try {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 2000));

                // Show success message
                alert(`Рақмет сайсыз! Сіздің ${this.donationForm.amount.toLocaleString()} ₸ көмегіңіз қабылданды.`);

                // Reset form
                this.donationForm = {
                    name: '',
                    email: '',
                    amount: 5000,
                    projectId: '',
                    message: ''
                };
            } catch (error) {
                alert('Қате пайда болды. Қайталап көріңіз.');
            } finally {
                this.isSubmitting = false;
            }
        },

        donateToProject(projectId) {
            this.donationForm.projectId = projectId;
            // Scroll to donation form
            window.location.href = `/making-donation`;
        }
    }
}
</script>

<style scoped>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fadeInUp {
    animation: fadeInUp 1s ease forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.animate-fadeIn {
    animation: fadeIn 1.2s ease forwards;
}

@keyframes ping-slow {
    0% {
        transform: scale(1);
        opacity: 0.4;
    }
    75% {
        transform: scale(1.5);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}
.animate-ping-slow {
    animation: ping-slow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Gradient background shift for project cards */
@keyframes bgGradientShift {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

/* Count-up number animation */
@keyframes countUp {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-countUp {
    animation: countUp 1.5s ease forwards;
}

/* Scrollbar styles for form textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}
textarea::-webkit-scrollbar-thumb {
    background-color: #4ade80; /* Tailwind green-400 */
    border-radius: 3px;
}
textarea::-webkit-scrollbar-track {
    background: #dcfce7; /* Tailwind green-50 */
}
</style>
