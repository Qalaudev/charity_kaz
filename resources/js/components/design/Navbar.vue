<template>
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between animate-fade-in-down">

            <!-- Сол жақ: Logo + Navigation бірге -->
            <div class="flex items-center space-x-12">
                <!-- Logo -->
                <a href="#" class="text-green-500 text-3xl font-bold tracking-wide hover:scale-105 transition-transform duration-300">Qoldau</a>

                <!-- Navigation -->
                <nav class="flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-green-500 relative group transition-colors duration-300 whitespace-nowrap">
                        <span>Басты бет</span>
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-green-400 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="/" class="text-gray-700 hover:text-green-500 relative group transition-colors duration-300 whitespace-nowrap">
                        <span>Мәзір</span>
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-green-400 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="/help" class="text-gray-700 hover:text-green-500 relative group transition-colors duration-300 whitespace-nowrap">
                        <span>Көмек алу</span>
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-green-400 transition-all group-hover:w-full"></span>
                    </a>
                </nav>
            </div>

            <!-- Оң жақ: Actions -->
            <div class="flex items-center space-x-4">
                <router-link
                    to="/contact-us"
                    class="bg-green-400 text-white px-5 py-2 rounded-full shadow-md hover:bg-green-500 transition-all duration-300 hover:scale-105 whitespace-nowrap animate-bounce-slow"
                >
                    Байланыс
                </router-link>

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
    </header>
</template>

<script>
export default {
    name: "Navbar",

    methods: {
        changeLanguage(lang){
            this.$i18n.locale = lang;
        },
    }
}

</script>

<style scoped>
@keyframes fade-in-down {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fade-in-down 0.6s ease-out;
}

@keyframes bounce-slow {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-4px);
    }
}
.animate-bounce-slow {
    animation: bounce-slow 2.5s infinite;
}
</style>
