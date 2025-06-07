<template>
    <div class="min-h-screen bg-mint-50 py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-gray-700 mb-2">{{$t('have_question')}}</div>
            <h1 class="text-4xl font-bold text-gray-800 mb-10">
                {{ $t('faq') }}
            </h1>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left side - Image -->
                <div class="bg-mint-100 rounded-lg p-4 overflow-hidden">
                    <img
                        src="/storage/app/public/mainContent/img.png"
                        alt="Children playing with colorful balloons"
                        class="w-full h-full object-cover rounded-lg"
                    />
                </div>

                <!-- Right side - FAQ Accordion -->
                <div class="space-y-4">
                    <div
                        v-for="(item, index) in faqItems"
                        :key="index"
                        class="bg-white rounded-lg shadow-sm"
                    >
                        <div
                            class="flex justify-between items-center p-5 cursor-pointer"
                            @click="toggleItem(index)"
                        >
                            <h3 class="font-medium text-gray-800">{{ item.question }}</h3>
                            <span class="text-xl font-light"
                            >{{ item.isOpen ? '−' : '+' }}</span
                            >
                        </div>
                        <div v-show="item.isOpen" class="p-5 pt-0 border-t border-gray-100">
                            <p class="text-gray-600">{{ item.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FAQComponent',
    data() {
        return {
            faqImage: '/storage/app/public/mainContent/img.png',
            openIndex: 0,
        };
    },
    computed: {
        faqItems() {
            return [
                {
                    question: this.$t('faqs.q1'),
                    answer: this.$t('faqs.a1'),
                    isOpen: this.openIndex === 0,
                },
                {
                    question: this.$t('faqs.q2'),
                    answer: this.$t('faqs.a2'),
                    isOpen: this.openIndex === 1,
                },
                {
                    question: this.$t('faqs.q3'),
                    answer: this.$t('faqs.a3'),
                    isOpen: this.openIndex === 2,
                },
                {
                    question: this.$t('faqs.q4'),
                    answer: this.$t('faqs.a4'),
                    isOpen: this.openIndex === 3,
                },
                {
                    question: this.$t('faqs.q5'),
                    answer: this.$t('faqs.a5'),
                    isOpen: this.openIndex === 4,
                },
            ];
        }
    },
    methods: {
        toggleItem(index) {
            this.openIndex = this.openIndex === index ? null : index;
        },
    },
};

</script>

<style scoped>
.bg-mint-50 {
    background-color: #f0f7f4;
}

.bg-mint-100 {
    background-color: #e0f0ea;
}
</style>
