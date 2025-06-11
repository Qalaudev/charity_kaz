<!--<template>-->
<!--    <Navbar></Navbar>-->
<!--    <div class="p-4 max-w-7xl mx-auto">-->
<!--        <div class="text-center mb-8">-->
<!--            <h1 class="text-3xl font-bold">{{ $t('support_us') }}</h1>-->
<!--            <hr class="my-4 border-t-2 border-gray-300" />-->

<!--            <div class="flex justify-center space-x-6">-->
<!--                <button-->
<!--                    :class="{-->
<!--            'bg-emerald-600 text-white': selectedMethod === 'Kaspi',-->
<!--            'text-orange-500 border-2 border-orange-500': selectedMethod !== 'Kaspi'-->
<!--          }"-->
<!--                    @click="selectedMethod = 'Kaspi'"-->
<!--                    class="px-6 py-2 rounded-md font-semibold"-->
<!--                >-->
<!--                    Kaspi-->
<!--                </button>-->
<!--                <button-->
<!--                    :class="{-->
<!--            'bg-emerald-600 text-white': selectedMethod === 'Other',-->
<!--            'text-orange-500 border-2 border-orange-500': selectedMethod !== 'Other'-->
<!--          }"-->
<!--                    @click="selectedMethod = 'Other'"-->
<!--                    class="px-6 py-2 rounded-md font-semibold"-->
<!--                >-->
<!--                    {{ $t('other_method') }}-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div v-if="selectedMethod === 'Kaspi'" class="flex justify-center">-->
<!--            <a href="https://qr.kaspi.kz/1149833385352419322050630802373033036147" target="_blank" rel="noopener noreferrer">-->
<!--                <img-->
<!--                    src="/storage/app/public/kaspi/kaspi-qr.png"-->
<!--                    alt="Kaspi QR"-->
<!--                    class="max-w-xs mx-auto hover:scale-105 transition duration-300"-->
<!--                />-->
<!--            </a>-->
<!--        </div>-->

<!--        <div v-else>-->
<!--            <p class="text-center text-xl font-semibold mb-4">Төлейтін ақша сомасы</p>-->
<!--            <div class="max-w-sm mx-auto p-4">-->
<!--                &lt;!&ndash; Дайын сома батырмалары &ndash;&gt;-->
<!--                <div class="flex space-x-2 mb-4">-->
<!--                    <button-->
<!--                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"-->
<!--                        @click="setAmount(100)"-->
<!--                    >100</button>-->
<!--                    <button-->
<!--                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"-->
<!--                        @click="setAmount(200)"-->
<!--                    >200</button>-->
<!--                    <button-->
<!--                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"-->
<!--                        @click="setAmount(500)"-->
<!--                    >500</button>-->
<!--                    <button-->
<!--                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"-->
<!--                        @click="setAmount(1000)"-->
<!--                    >1000</button>-->
<!--                    <button-->
<!--                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"-->
<!--                        @click="setAmount(2000)"-->
<!--                    >2000</button>-->
<!--                </div>-->

<!--                <input-->
<!--                    v-model="amount"-->
<!--                    type="number"-->
<!--                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4"-->
<!--                    placeholder="Соманы енгізіңіз"-->
<!--                />-->

<!--                <button @click.prevent="paymentCharity(true)" class="w-full bg-white text-orange-500 border border-orange-500 font-bold py-2 px-4 rounded">-->
<!--                    Төлем жасау-->
<!--                </button>-->

<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
<template>
    <Navbar></Navbar>
    <div class="p-4 max-w-7xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">{{ $t('support_us') }}</h1>
            <hr class="my-4 border-t-2 border-gray-300" />

            <!-- Төлем әдістерінің табтары -->
            <div class="flex justify-center space-x-4 flex-wrap">
                <button
                    v-for="method in methods"
                    :key="method"
                    :class="{
            'bg-emerald-600 text-white': selectedMethod === method,
            'text-orange-500 border-2 border-orange-500': selectedMethod !== method
          }"
                    @click="selectedMethod = method"
                    class="px-6 py-2 rounded-md font-semibold"
                >
                    {{ method }}
                </button>
            </div>
        </div>

        <!-- QR суреттер -->
        <div v-if="selectedMethod === 'Kaspi'" class="flex justify-center">
            <img
                src="/storage/app/public/kaspi/kaspi-qr.png"
                alt="Kaspi QR"
                class="max-w-xs mx-auto hover:scale-105 transition duration-300"
            />
        </div>

        <div v-else-if="selectedMethod === 'Halyk'" class="flex justify-center">
            <img
                src="/storage/app/public/kaspi/halyk.png"
                alt="Halyk QR"
                class="max-w-xs mx-auto hover:scale-105 transition duration-300"
            />
        </div>

        <div v-else-if="selectedMethod === 'Forte'" class="flex justify-center">
            <img
                src="/storage/app/public/kaspi/forte.png"
                alt="Forte QR"
                class="max-w-xs mx-auto hover:scale-105 transition duration-300"
            />
        </div>

        <!-- Басқа әдіс арқылы төлеу -->
        <div v-else>
            <p class="text-center text-xl font-semibold mb-4">Төлейтін ақша сомасы</p>
            <div class="max-w-sm mx-auto p-4">
                <div class="flex space-x-2 mb-4">
                    <button
                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                        @click="setAmount(100)"
                    >100</button>
                    <button
                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                        @click="setAmount(200)"
                    >200</button>
                    <button
                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                        @click="setAmount(500)"
                    >500</button>
                    <button
                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                        @click="setAmount(1000)"
                    >1000</button>
                    <button
                        class="bg-emerald-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                        @click="setAmount(2000)"
                    >2000</button>
                </div>

                <input
                    v-model="amount"
                    type="number"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                    placeholder="Соманы енгізіңіз"
                />

                <button
                    @click.prevent="paymentCharity(true)"
                    class="w-full bg-white text-orange-500 border border-orange-500 font-bold py-2 px-4 rounded"
                >
                    Төлем жасау
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";

export default {
    components: { Navbar },
    data() {
        return {
            amount: 0,
            selectedMethod: 'Kaspi',
            methods: ['Kaspi', 'Halyk', 'Forte', 'Other']
        };
    },
    methods: {
        setAmount(val) {
            this.amount = val;
        },
        async paymentCharity() {
            const usdAmount = (this.amount / 500).toFixed(2);
            const response = await axios.post('/paypal', {
                amount: usdAmount
            });

            if (response.data.links) {
                const approvalUrl = response.data.links.find(link => link.rel === 'approve');
                if (approvalUrl) {
                    window.location.href = approvalUrl.href;
                }
            }
        }
    }
}
</script>


