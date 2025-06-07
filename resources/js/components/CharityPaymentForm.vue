<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Заказ №1</h2>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ amount }} KZT</div>
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <span>Комиссия</span>
                    <span>{{ commission }} KZT</span>
                </div>
            </div>

            <div class="flex justify-center gap-2 mb-6">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='25' viewBox='0 0 40 25'%3E%3Crect width='40' height='25' rx='4' fill='%231A1F71'/%3E%3Ctext x='20' y='16' text-anchor='middle' fill='white' font-size='8' font-weight='bold'%3EVISA%3C/text%3E%3C/svg%3E" alt="Visa" class="h-8">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='25' viewBox='0 0 40 25'%3E%3Crect width='40' height='25' rx='4' fill='%23EB001B'/%3E%3Ccircle cx='15' cy='12.5' r='8' fill='%23EB001B'/%3E%3Ccircle cx='25' cy='12.5' r='8' fill='%23FF5F00'/%3E%3C/svg%3E" alt="Mastercard" class="h-8">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='25' viewBox='0 0 40 25'%3E%3Crect width='40' height='25' rx='4' fill='%230066CC'/%3E%3Ctext x='20' y='16' text-anchor='middle' fill='white' font-size='6' font-weight='bold'%3EUnionPay%3C/text%3E%3C/svg%3E" alt="UnionPay" class="h-8">
            </div>

            <form @submit.prevent="processPayment" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Номер карты
                    </label>
                    <input
                        v-model="cardNumber"
                        type="text"
                        placeholder="•••• •••• •••• ••••"
                        maxlength="19"
                        @input="formatCardNumber"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Действует до
                    </label>
                    <div class="flex gap-2">
                        <input
                            v-model="expiryMonth"
                            type="text"
                            placeholder="ММ"
                            maxlength="2"
                            @input="formatMonth"
                            class="w-16 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-center"
                            required
                        >
                        <span class="flex items-center text-gray-500">/</span>
                        <input
                            v-model="expiryYear"
                            type="text"
                            placeholder="ГГ"
                            maxlength="2"
                            @input="formatYear"
                            class="w-16 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-center"
                            required
                        >
                    </div>
                </div>

                <div>
                    <input
                        v-model="cvv"
                        type="password"
                        placeholder="CVV"
                        maxlength="3"
                        class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required
                    >
                </div>

                <button
                    type="submit"
                    :disabled="isProcessing || isSuccess"
                    :class="[
                    'w-full font-semibold py-3 px-4 rounded-md transition-colors duration-200',
                    isSuccess
                        ? 'bg-green-500 hover:bg-green-600 text-white'
                        : isProcessing
                            ? 'bg-orange-300 text-white'
                            : 'bg-orange-500 hover:bg-orange-600 text-white'
                ]"
                >
                    {{ isSuccess ? 'Успешно оплачено!' : (isProcessing ? 'Обработка...' : `Оплатить ${amount} KZT`) }}
                </button>


                <!-- Cancel Button -->
                <button
                    type="button"
                    @click="cancelPayment"
                    class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-md transition-colors duration-200"
                >
                    Назад
                </button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaymentForm',
    data() {
        return {
            amount: 0,
            commission: 0,
            cardNumber: '',
            expiryMonth: '',
            expiryYear: '',
            cvv: '',
            isProcessing: false,
            isSuccess: false
        }
    },
    mounted() {
        const params = new URLSearchParams(window.location.search);
        const amt = parseInt(params.get("amount"));
        this.amount = isNaN(amt) ? 0 : amt;
        this.calculateCommission();
    },
    methods: {
        calculateCommission() {
            this.commission = Math.round(this.amount * 0.03);
        },
        formatCardNumber() {
            let value = this.cardNumber.replace(/\D/g, '');

            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');

            this.cardNumber = value;
        },
        formatMonth() {
            let value = this.expiryMonth.replace(/\D/g, '');
            if (parseInt(value) > 12) {
                value = '12';
            }
            if (value.length === 1 && parseInt(value) > 1) {
                value = '0' + value;
            }
            this.expiryMonth = value;
        },
        formatYear() {
            this.expiryYear = this.expiryYear.replace(/\D/g, '');
        },
        async processPayment() {
            this.isProcessing = true;

            try {
                await new Promise(resolve => setTimeout(resolve, 2000));

                // console.log('Payment data:', {
                //     amount: this.amount,
                //     commission: this.commission,
                //     cardNumber: this.cardNumber.replace(/\s/g, ''),
                //     expiryMonth: this.expiryMonth,
                //     expiryYear: this.expiryYear,
                //     cvv: this.cvv
                // });

                await axios.post('/donations', {
                    amount: this.amount,
                    card_number: this.cardNumber.replace(/\s/g, '')
                });


                this.isSuccess = true;
                this.resetForm();

                setTimeout(() => {
                    this.isSuccess = false;
                }, 3000);

            } catch (error) {
                console.error('Payment error:', error);
                alert('Ошибка при обработке платежа. Попробуйте снова.');
            } finally {
                this.isProcessing = false;
            }
        },
        cancelPayment() {
            if (confirm('Вы уверены, что хотите отменить платеж?')) {
                this.resetForm();
                this.$emit('cancel');
            }
        },
        resetForm() {
            this.cardNumber = '';
            this.expiryMonth = '';
            this.expiryYear = '';
            this.cvv = '';
        }
    }
}
</script>

<style scoped>
input::placeholder {
    color: #9CA3AF;
}

input:focus {
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}
</style>
