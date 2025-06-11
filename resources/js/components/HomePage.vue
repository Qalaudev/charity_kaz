<template>
    <!-- ABOUT US SECTION -->
    <section class="py-20 px-4 bg-gradient-to-b from-white via-green-50 to-white">
        <div class="container mx-auto sm:flex items-center max-w-screen-xl gap-8">
            <!-- Left image -->
            <div class="sm:w-1/2 p-6 animate-fade-in">
                <div class="text-center">
                    <video
                        src="/storage/app/public/mainContent/charity.mp4"
                        controls
                        autoplay
                        muted
                        loop
                        class="w-full h-auto rounded-3xl shadow-2xl hover:scale-105 transition-transform duration-500 ease-in-out">
                    </video>
                </div>
            </div>


            <!-- Right text -->
            <div class="sm:w-1/2 p-6 animate-fade-in delay-300">
            <div>
                <span class="text-green-600 border-b-2 border-green-500 uppercase text-2xl tracking-wide">
                  <b>{{ $t('about_us') }}</b>
                </span>
                    <h2 class="my-4 font-bold text-4xl sm:text-5xl text-gray-800 leading-tight">
                        {{ $t('support') }} -
                        <span class="text-green-500 bg-green-100 px-2 py-1 rounded-xl animate-pulse">
                            {{ $t('together_caring') }}
                        </span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mt-4">
                        {{ $t('children_future') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- КӨМЕК ҚАЖЕТ ЕТЕТІН ТОПТАР -->
    <section class="py-20 px-4 md:px-8 bg-green-50 relative">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold mb-14 text-center text-green-700 animate-fade-in-up">
                {{ $t('groups_in_need') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    v-for="group in groups"
                    :key="group.id"
                    @click="openModal(group)"
                    class="group-card bg-white/90 border border-green-200 shadow-xl hover:shadow-green-300 rounded-2xl cursor-pointer transform hover:-translate-y-2 hover:scale-105 transition-all duration-500 p-4 overflow-hidden group relative backdrop-blur-sm"
                >
                    <img :src="'/' + group.image" class="group-image rounded-xl h-48 w-full object-cover mb-4 transition-transform duration-500 group-hover:scale-105" alt="Group Image">
                    <div class="p-2">
                        <span class="text-green-500 text-sm font-semibold tracking-wide uppercase">{{ group.name }}</span>
                        <h3 class="text-xl font-bold mt-2 text-gray-800">{{ group.title }}</h3>
                        <p class="text-gray-600 mt-2">{{ group.description }}</p>
                    </div>
                    <!-- Hover glow effect -->
                    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-10 bg-green-400 transition duration-300"></div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center z-50 animate-fade-in">
            <div class="bg-white p-8 rounded-3xl shadow-2xl w-[90%] max-w-3xl max-h-[90vh] overflow-y-auto relative">
                <img :src="'/' + selectedGroup.image" class="w-full h-64 object-cover rounded-xl mb-6" alt="Group">

                <span class="text-green-600 text-sm font-semibold tracking-wider">{{ selectedGroup.name }}</span>
                <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ selectedGroup.title }}</h3>
                <p class="text-gray-700 mt-4 leading-relaxed">{{ selectedGroup.description }}</p>

                <!-- QR код -->
                <qrcode-vue :value="`https://yourwebsite.com/group/${selectedGroup.id}`" size="200" class="mx-auto my-6" />

                <!-- Close button -->
                <div class="text-right">
                    <button @click="showModal = false" class="bg-green-600 text-white px-6 py-2 rounded-full shadow hover:bg-green-700 transition">
                        Жабу
                    </button>
                    <button @click="charityDonation(true)" class="bg-blue-600 text-white px-6 py-2 mx-2 rounded-full shadow hover:bg-green-700 transition">
                        Қайырымдылық жасау
                    </button>
                </div>
            </div>
        </div>
    </section>


    <!-- КӨМЕК ҚАЖЕТ ЕТЕТІН ЖАНДАР -->
    <section class="py-20 px-4 md:px-8 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold mb-14 text-center text-green-700 animate-fade-in-up">
                {{ $t('people_in_need') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    v-for="group in people"
                    :key="group.id"
                    @click="openModalPeople(group)"
                    class="group-card bg-white/90 border border-green-200 shadow-xl hover:shadow-green-300 rounded-2xl cursor-pointer transform hover:-translate-y-2 hover:scale-105 transition-all duration-500 p-4 overflow-hidden group relative backdrop-blur-sm"
                >
                    <img :src="'/' + group.file" class="group-image rounded-xl h-48 w-full object-cover mb-4 transition-transform duration-500 group-hover:scale-105" alt="Group Image">
                    <div class="p-2">
                        <span class="text-green-500 text-sm font-semibold tracking-wide uppercase">{{ group.name }}</span>
                        <h3 class="text-xl font-bold mt-2 text-gray-800">{{ group.surname }}</h3>
                        <p class="text-gray-600 mt-2">{{ group.info }}</p>
                    </div>
                    <!-- Hover glow effect -->
                    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-10 bg-green-400 transition duration-300"></div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModalPeople" class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center z-50 animate-fade-in">
            <div class="bg-white p-8 rounded-3xl shadow-2xl w-[90%] max-w-3xl max-h-[90vh] overflow-y-auto relative">
                <img :src="'/' + selectedPeople.file" class="w-full h-64 object-cover rounded-xl mb-6" alt="Group">

                <span class="text-green-600 text-sm font-semibold tracking-wider">{{ selectedPeople.name }}</span>
                <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ selectedPeople.surname }}</h3>
                <p class="text-gray-700 mt-4 leading-relaxed">{{ selectedPeople.info }}</p>

                <!-- QR код -->
                <qrcode-vue :value="`https://yourwebsite.com/group/${selectedGroup.id}`" size="200" class="mx-auto my-6" />

                <!-- Close button -->
                <div class="text-right">
                    <button @click="showModalPeople = false" class="bg-green-600 text-white px-6 py-2 rounded-full shadow hover:bg-green-700 transition">
                        Жабу
                    </button>
                    <button @click="charityDonation(true)" class="bg-blue-600 text-white px-6 py-2 mx-2 rounded-full shadow hover:bg-green-700 transition">
                        Қайырымдылық жасау
                    </button>
                </div>
            </div>
        </div>
    </section>


    <!-- Ахмет Байтұрсынұлы -->
    <section class="bg-white py-20 px-4 text-green-800 text-center relative animate-fade-in-up shadow-inner">
        <h1 class="text-4xl font-extrabold mb-12 tracking-wide relative inline-block after:block after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-20 after:h-1 after:bg-green-400">
            Ахмет Байтұрсынұлы
        </h1>

        <div class="relative max-w-4xl mx-auto">
            <div class="text-green-200 text-9xl font-bold absolute -top-20 left-1/2 transform -translate-x-1/2 opacity-30 select-none animate-pulse">
                " "
            </div>

            <p class="text-xl md:text-2xl font-medium leading-relaxed z-10 relative animate-fade-in delay-300">
                {{ $t('quote') }}
            </p>
        </div>
    </section>

    <!-- Бір жүрек өзгеріс әкеледі, ал жүздеген жүрек ғажайып жасайды -->
    <section class="py-20 px-4 md:px-8 bg-green-50 animate-fade-in-up">
        <h2 class="text-3xl font-extrabold mb-16 text-center text-green-900 max-w-4xl mx-auto leading-snug animate-bounce-slow">
            {{ $t('quote1') }}
        </h2>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-500 hover:scale-105 transform animate-zoom-in">
                <h3 class="text-4xl font-extrabold mb-3 text-green-600">109 500+</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{$t('children_with_disabilities_2025')}}
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-500 hover:scale-105 transform animate-zoom-in delay-200">
                <h3 class="text-4xl font-extrabold mb-3 text-green-600">31 000+</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $t('orphans_and_children_without_parents_care_2025') }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-500 hover:scale-105 transform animate-zoom-in delay-400">
                <h3 class="text-4xl font-extrabold mb-3 text-green-600">8,92%</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $t('poverty_level_among_large_families') }}
                </p>
            </div>

        </div>
    </section>


    <news-section></news-section>


<!--    <div id="chat-widget" class="fixed bottom-4 right-4 z-50">-->
<!--        <button @click="toggleChat" class="bg-gradient-to-r from-indigo-500 to-blue-600 text-white p-3 rounded-full shadow-2xl hover:scale-110 transition transform duration-300">-->
<!--            🤖-->
<!--        </button>-->
<!--    </div>-->

<!--    <div v-show="chatVisible" id="chat-window" class="fixed bottom-24 right-4 w-80 max-w-sm h-[480px] bg-white shadow-2xl rounded-2xl flex flex-col z-50 border border-gray-200 overflow-hidden animate__animated animate__fadeInUp">-->
<!--        <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center py-3 px-4 font-semibold text-lg">-->
<!--            {{ $t('ai_chat') }}-->
<!--            <button @click="toggleChat" class="absolute right-3 top-3 text-white hover:text-gray-300 text-sm">✖</button>-->
<!--        </div>-->

<!--        <div ref="messages" class="flex-1 px-4 py-3 overflow-y-auto text-sm space-y-3 bg-gray-50">-->
<!--            <div v-for="(message, index) in messages" :key="index" :class="message.sender === 'user' ? 'text-right' : 'text-left'">-->
<!--                <span :class="message.sender === 'user' ? 'inline-block bg-gray-200 px-3 py-2 rounded' : 'inline-block bg-blue-100 px-3 py-2 rounded'">-->
<!--                    {{ message.text }}-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="p-3 bg-white border-t border-gray-200 flex items-center space-x-2">-->
<!--            <input v-model="inputText" placeholder="Хабарлама жаз..." class="flex-1 text-sm px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400" @keydown.enter="sendMessage" />-->
<!--            <button @click="sendMessage" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-full transition">-->
<!--                {{ $t('send') }}-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->

    <f-a-q/>


    <footer class="bg-gray-900 text-white py-12 px-4 md:px-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- Column 1: Навигация -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">{{ $t('about_fund') }}</h3>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="#" @click.prevent="downloadOffer" class="hover:underline hover:text-white">{{ $t('offer') }}</a></li>
                    <li><a href="#" @click.prevent="downloadReport" class="hover:underline hover:text-white">{{ $t('report') }}</a></li>
                    <li><a href="#" class="hover:underline hover:text-white">{{ $t('groups_in_need') }}</a></li>
                </ul>
            </div>

            <!--  offer modal  -->
            <div v-if="showModalOffer" class="fixed inset-0 backdrop-blur-sm bg-white/10 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-xl shadow-xl text-center max-w-sm w-full">

                    <p class="text-lg font-semibold mb-4 text-gray-800">⏳ {{ $t('loadingMessage') }}</p>

                    <div v-if="loading" class="flex justify-center">
                        <svg class="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!--  download report  -->
            <div v-if="showModalReport" class="fixed inset-0 backdrop-blur-sm bg-white/10 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-xl shadow-xl text-center max-w-sm w-full">

                    <p class="text-lg font-semibold mb-4 text-gray-800">⏳ {{ $t('loadingMessage') }}</p>

                    <div v-if="loadingReport" class="flex justify-center">
                        <svg class="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>



            <!-- Column 2: Көмек және Instagram -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">{{ $t('help') }}</h3>
                <ul class="space-y-3 text-gray-300 mb-4">
                    <li><a href="/help" class="hover:underline hover:text-white">{{ $t('get_help') }}</a></li>
                    <li><a href="/making-donation" class="hover:underline hover:text-white">{{ $t('help') }}</a></li>
                </ul>
                <div class="mt-4">
                    <h4 class="text-sm text-gray-400 mb-2">Бізді әлеуметтік желіден табыңыз:</h4>
                    <a href="#" class="text-white text-2xl hover:text-green-400 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Column 3: Мекен-жай -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">Мекен Жай</h3>
                <p class="text-gray-300 mb-2">Аудан-1 ышқы Ауыл, 119/225</p>
                <h3 class="text-xl font-bold text-white mt-6 mb-2">Байланыс</h3>
                <p class="text-gray-300">+7 747 062 30 72</p>
            </div>

        </div>
    </footer>


</template>
<script>

document.addEventListener("DOMContentLoaded", () => {
    const fadeElements = document.querySelectorAll(".fade-in");
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );
    fadeElements.forEach((element) => {
        observer.observe(element);
    });
});
import axios from "axios";
import NewsSection from "@/components/NewsSection.vue";
import FAQ from "@/components/design/FAQ.vue";
import GroupDetails from "@/components/GroupDetails.vue";
import QRCodeVue from 'qrcode.vue';


// const toggleChat = () => {
//     const chatWindow = document.getElementById('chat-window');
//     chatWindow.classList.toggle('hidden');
// };
const sendMessage = () => {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if (!message) return;

    const messagesDiv = document.getElementById('chat-messages');

    const userMsg = document.createElement('div');
    userMsg.className = 'text-right';
    userMsg.innerHTML = `<span class="inline-block bg-gray-200 px-3 py-2 rounded">${message}</span>`;
    messagesDiv.appendChild(userMsg);

    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    input.value = '';

    fetch('/ai-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ message: message })
    })
        .then(res => res.json())
        .then(data => {
            const botMsg = document.createElement('div');
            botMsg.className = 'text-left';
            botMsg.innerHTML = `<span class="inline-block bg-blue-100 px-3 py-2 rounded">${data.reply}</span>`;
            messagesDiv.appendChild(botMsg);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        })
        .catch(err => {
            console.error('AI жауап қатпады', err);
        });
};
export default {
    components:{NewsSection,FAQ,GroupDetails,QRCodeVue},
    mounted() {
        // Fade Up
        const cards = document.querySelectorAll(".fade-up");
        const fadeUpObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        fadeUpObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.7 }
        );
        cards.forEach((card) => fadeUpObserver.observe(card));

        // Fade In Scale
        const section = document.querySelector(".fade-in-scale");
        const scaleObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        scaleObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );
        if (section) scaleObserver.observe(section);

        // Stat Cards
        const statCards = document.querySelectorAll(".stat-card");
        const statCardObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        statCardObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );
        statCards.forEach((card) => statCardObserver.observe(card));

        // News Cards
        const newsCards = document.querySelectorAll(".news-card");
        const newsCardObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        newsCardObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.6 }
        );
        newsCards.forEach((card) => newsCardObserver.observe(card));
    },

    data() {
        return {
            groups:[],
            people:[],
            isVisible: false,
            chatVisible: false,
            inputText: '',
            messages: [],
            showModal: false,
            showModalPeople: false,
            selectedGroup: {},
            selectedPeople: {},
            showModalOffer:false,
            loading:false,
            showModalReport:false,
            loadingReport:false
        };
    },
    created() {
        this.fetchGroups();
        this.fetchPeople();
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    methods:{
      async fetchGroups(){
        try{
            const response = await axios.get('/group');
            this.groups = response.data;
        }  catch (e)
        {
            console.error('Error fetching groups:', e);
        }
      },
        async fetchPeople(){
        try{
            const response = await axios.get('/get-helps-approved');
            this.people = response.data;
        }  catch (e)
        {
            console.error('Error fetching groups:', e);
        }
      },
        handleScroll() {
            const windowHeight = window.innerHeight;
            const elements = document.querySelectorAll(".fade-up");
            elements.forEach((el) => {
                const rect = el.getBoundingClientRect();
                if (rect.top < windowHeight - 100) {
                    el.classList.add("show");
                }
            });
        },
        goToDetails(id) {
            this.$router.push(`/group/${id}`);
        },
        toggleChat() {
            this.chatVisible = !this.chatVisible;
        },
        openModal(group) {
            this.selectedGroup = group;
            this.showModal = true;
        },
        openModalPeople(people) {
            this.selectedPeople = people;
            this.showModalPeople = true;
        },
        async sendMessage() {
            if (!this.inputText.trim()) return;

            // Add user message
            this.messages.push({ sender: 'user', text: this.inputText.trim() });
            this.inputText = '';

            // Simulate AI response (replace this with real API call)
            setTimeout(() => {
                this.messages.push({ sender: 'bot', text: 'Сәлем! Мен саған қалай көмектесе аламын?' });
                this.$nextTick(() => {
                    const messagesRef = this.$refs.messages;
                    messagesRef.scrollTop = messagesRef.scrollHeight;
                });
            }, 500);
        },
        charityDonation(value){
            if (value){
                this.$router.push('/making-donation');
            }
        },
        downloadOffer(){
          this.showModalOffer = true;
          this.loading = true;

          setTimeout(()=>{
              this.loading = false;
              this.showModalOffer = false;

              const link = document.createElement('a');
              link.href = '/offerta/offerta.docx';
              link.download = 'Қайырымдылық көмегі туралы ұсыныс шарты.docx';
              link.click();
          },2000);
        },
        downloadReport(){
            this.loadingReport = true;
            this.showModalReport = true;

            setTimeout(()=>{
                this.loadingReport = false;
                this.showModalReport = false;

                const link = document.createElement('a');
                link.href = '/report/report.docx';
                link.download = 'reportCharity.docx';
                link.click();
            },2000)
        }
    },
};
</script>
<style>

    .group-card {
        background-color: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .group-card:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
    }

    .group-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
        border-radius: 0.5rem;
    }

    .group-card:hover .group-image {
        transform: scale(1.05);
    }

    .fade-in-scale {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s ease-out;
    }

    .fade-in-scale.show {
        opacity: 1;
        transform: scale(1);
    }

    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease-out;
    }

    .fade-in.show {
        opacity: 1;
        transform: translateY(0);
    }


    .stat-card {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease-out;
    }

    .stat-card.show {
        opacity: 1;
        transform: translateY(0);
    }

    .news-card {
        transform: translateY(40px);
        transition: all 0.8s ease-out;
    }

    .news-card.show {
        opacity: 1;
        transform: translateY(0);
    }

    .btn-ripple {
        position: relative;
        overflow: hidden;
    }

    .btn-ripple::after {
        content: "";
        position: absolute;
        width: 300%;
        height: 300%;
        top: 50%;
        left: 50%;
        background: rgba(76, 175, 80, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0.6s;
    }

    .btn-ripple:hover::after {
        transform: translate(-50%, -50%) scale(1);
    }



</style>
