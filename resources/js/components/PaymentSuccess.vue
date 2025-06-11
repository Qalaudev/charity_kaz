<template>
    <Navbar />
    <div class="flex flex-col items-center justify-center min-h-screen bg-white">
        <!-- Loader немесе галочка -->
        <div class="mb-6">
            <div v-if="loading" class="loader"></div>
            <div v-else class="checkmark-wrapper">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16" />
                </svg>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-green-600">Төлем сәтті өтті!</h1>
        <p class="text-gray-500 mt-2">Рахмет! Төлеміңіз қабылданды.</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Navbar from '../components/Navbar.vue'

const loading = ref(true)
const router = useRouter()

onMounted(() => {
    setTimeout(() => {
        loading.value = false

        // Галочка шыққаннан кейін 1.5 секунд күтіп, making-donation-ға қайта бағыттау
        setTimeout(() => {
            router.push('/making-donation')
        }, 1500)
    }, 2000) // Алдымен 2 сек — loader
})
</script>

<style scoped>
.loader {
    width: 60px;
    height: 60px;
    border: 6px solid #e5e7eb;
    border-top: 6px solid #10b981;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.checkmark-wrapper {
    width: 60px;
    height: 60px;
}

.checkmark {
    width: 60px;
    height: 60px;
    stroke: #10b981;
    stroke-width: 4;
    stroke-miterlimit: 10;
    animation: stroke 0.5s ease-in-out forwards;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke: #10b981;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke: #10b981;
    animation: stroke 0.3s 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

@keyframes stroke {
    to {
        stroke-dashoffset: 0;
    }
}
</style>
