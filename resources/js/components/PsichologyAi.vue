<script>
import axios from 'axios';
import Navbar from './Navbar.vue';
export default {

    name: "PsichologyAi",
    data() {
        return {
            userMessage: '',
            messages: [],
            loading: false,
            sessionId: null
        };
    },
    components: {
        Navbar,
    },
    methods: {
        async sendMessage() {
            if (!this.userMessage.trim()) return;

            // Қолданушы хабарламасын қосу
            const userMessageText = this.userMessage.trim();
            this.messages.push({ role: 'user', content: userMessageText });
            this.userMessage = '';
            this.loading = true;

            try {
                // Laravel API арқылы хабарлама жіберу
                const response = await axios.post('/api/chat', {
                    message: userMessageText
                });

                // Жауапты өңдеу
                if (response.data &&
                    response.data.candidates &&
                    response.data.candidates.length > 0 &&
                    response.data.candidates[0].content &&
                    response.data.candidates[0].content.parts &&
                    response.data.candidates[0].content.parts.length > 0) {

                    const aiResponse = response.data.candidates[0].content.parts[0].text;
                    this.messages.push({ role: 'assistant', content: aiResponse });

                } else {
                    throw new Error('Жауап форматы дұрыс емес');
                }

            } catch (error) {
                console.error('Қате:', error);
                this.messages.push({
                    role: 'assistant',
                    content: 'Кешіріңіз, сұранысты өңдеу кезінде қате орын алды. Кейінірек қайталап көріңіз.'
                });
            } finally {
                this.loading = false;
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
            }
        },

        scrollToBottom() {
            if (this.$refs.messagesContainer) {
                this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
            }
        },
        clearChat() {
            this.messages = [{
                role: 'assistant',
                content: this.$t('greeting')
            }];
            this.sessionId = null;
        }
    },
    mounted() {
        // Приветственное сообщение при загрузке чата
        const welcomeMessage = this.$t('greeting');
        this.messages.push({
            role: 'assistant',
            content: welcomeMessage,
            isGreeting: true
        });
    },
    watch: {
        '$i18n.locale'(newLocale, oldLocale) {
            const welcomeIndex = this.messages.findIndex(m => m.role === 'assistant' && m.isGreeting);
            if (welcomeIndex !== -1) {
                this.messages[welcomeIndex].content = this.$t('greeting');
            }
        }
    },
    updated() {
        this.scrollToBottom();
    }
};
</script>

<template>

    <navbar />
    <div class="bg-white min-h-screen p-6">
        <h2 class="text-2xl font-bold text-center mb-4 text-green-600 animate-fade-in-up">
            {{ $t('askQuestion.title') }}
        </h2>

        <div class="bg-white border-2 border-green-500 rounded-lg p-6 max-w-4xl mx-auto shadow-xl min-h-[800px] flex flex-col justify-between animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-green-700">{{ $t('askQuestion.chat') }}</h3>
                <button
                    @click="clearChat"
                    class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1 rounded text-sm transition duration-200 group"
                    :disabled="messages.length <= 1"
                    title="Clear chat"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform transition-transform duration-300 group-hover:rotate-180"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L6 7m6 11V7m6 11V7M4 7h16M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z"
                        />
                    </svg>
                </button>

            </div>

            <!-- Сообщения -->
            <div class="overflow-y-auto h-[600px] space-y-4 mb-6 pr-2 scroll-smooth" ref="messagesContainer">
                <div v-if="messages.length === 0" class="text-center text-gray-400 italic animate-pulse">
                    {{ $t('askQuestion.start') }}
                </div>

                <transition-group name="fade" tag="div">
                    <div
                        v-for="(msg, index) in messages"
                        :key="index"
                        :class="[
                            msg.role === 'user' ? 'bg-green-100 text-right ml-auto animate-pop-in' : 'bg-green-50 text-left animate-pop-in',
                            'rounded px-4 py-2 max-w-sm break-words shadow'
                        ]"
                    >
                        {{ msg.content }}
                    </div>
                </transition-group>

                <div v-if="loading" class="bg-green-50 rounded px-4 py-2 max-w-sm animate-pulse">
                    <span class="loading-animation text-green-600">
                        {{ $t('askQuestion.typing') }}<span>.</span><span>.</span><span>.</span>
                    </span>
                </div>
            </div>

            <form @submit.prevent="sendMessage" class="flex flex-col sm:flex-row w-full mt-4">
                <input
                    type="text"
                    v-model="userMessage"
                    :placeholder="$t('askQuestion.input')"
                    class="w-full sm:flex-1 px-4 py-2 rounded-t sm:rounded-l sm:rounded-tr-none border border-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                    maxlength="255"
                    :disabled="loading"
                />
                <button
                    type="submit"
                    class="w-full sm:w-auto bg-green-500 text-white px-6 py-2 rounded-b sm:rounded-r sm:rounded-bl-none hover:bg-green-600 disabled:bg-green-300 transition duration-300 transform hover:scale-105 hover:shadow-lg"
                    :disabled="loading || !userMessage.trim()"
                >
                    {{ $t('askQuestion.send') }}
                </button>
            </form>

        </div>
    </div>
</template>


<style scoped>

@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pop-in {
    0% {
        opacity: 0;
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out both;
}

.animate-fade-in {
    animation: fade-in-up 0.5s ease-out both;
}

.animate-pop-in {
    animation: pop-in 0.3s ease-out both;
}

</style>
