<template>

    <Navbar/>
    <div class="flex justify-center min-h-screen bg-gradient-to-br from-lime-100 to-green-200 py-16">
        <div
            class="w-full max-w-lg p-10 bg-white rounded-3xl border-2 border-green-300 shadow-lg
             transition-shadow duration-500 hover:shadow-green-400"
        >
            <h2
                class="text-3xl font-extrabold text-green-700 mb-8 text-center
               animate-fadeInDown"
            >
                Форма для получение помощи
            </h2>

            <div
                v-if="status"
                class="mb-6 p-4 bg-green-100 text-green-900 rounded-lg font-semibold
               animate-fadeIn"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label
                        for="name"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Имя
                    </label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        placeholder="Введите ваше имя"
                        required
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    />
                    <span
                        v-if="errors.name"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.name[0] }}
          </span>
                </div>

                <div>
                    <label
                        for="surname"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Фамилия
                    </label>
                    <input
                        type="text"
                        id="surname"
                        v-model="form.surname"
                        placeholder="Введите вашу фамилию"
                        required
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    />
                    <span
                        v-if="errors.surname"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.surname[0] }}
          </span>
                </div>

                <div>
                    <label
                        for="number"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Номер телефона
                    </label>
                    <input
                        type="tel"
                        id="number"
                        v-model="form.number"
                        placeholder="+7 777 777 77 77"
                        required
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    />
                    <span
                        v-if="errors.number"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.number[0] }}
          </span>
                </div>

                <div>
                    <label
                        for="email"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Электронная почта
                    </label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        placeholder="example@mail.com"
                        required
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    />
                    <span
                        v-if="errors.email"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.email[0] }}
          </span>
                </div>

                <div>
                    <label
                        for="file"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Документы
                    </label>
                    <input
                        type="file"
                        id="file"
                        @change="handleFileChange"
                        name="file"
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    />
                    <span
                        v-if="errors.file"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.file[0] }}
          </span>
                </div>

                <div>
                    <label
                        for="info"
                        class="block text-green-800 font-semibold mb-1 tracking-wide"
                    >
                        Информация о себе
                    </label>
                    <textarea
                        id="info"
                        v-model="form.info"
                        rows="4"
                        placeholder="Расскажите немного о себе"
                        class="w-full rounded-xl border-2 border-green-300 p-4 text-green-900
                   shadow-sm placeholder-green-400
                   focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-300
                   transition duration-300 ease-in-out
                   hover:shadow-md hover:scale-[1.02]"
                    ></textarea>
                    <span
                        v-if="errors.info"
                        class="text-red-600 text-sm mt-1 block animate-fadeIn"
                    >
            {{ errors.info[0] }}
          </span>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-lime-400
                 text-white font-extrabold py-4 rounded-xl
                 shadow-lg hover:from-green-600 hover:to-lime-500
                 transition duration-300 ease-in-out transform hover:scale-105
                 active:scale-95"
                >
                    Отправить
                </button>
            </form>
        </div>
    </div>
</template>

<script>

import Navbar from './Navbar.vue';
export default {

    components: {
        Navbar,
    },

    data() {
        return {
            form: {
                name: '',
                surname: '',
                number: '',
                email: '',
                file: null,
                info: ''
            },
            status: '',
            errors: {}
        };
    },
    methods: {
        handleFileChange(e) {
            this.form.file = e.target.files[0];
        },
        async submitForm() {
            try {
                const formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('surname', this.form.surname);
                formData.append('number', this.form.number);
                formData.append('email', this.form.email);
                formData.append('file', this.form.file);
                formData.append('info', this.form.info);

                const response = await axios.post('/gethelp', formData);

                this.status = 'Успешно сохранен!';

                this.form = {
                    name: '',
                    surname: '',
                    number: '',
                    email: '',
                    file: null,
                    info: ''
                };
                this.errors = {};

                setTimeout(() => this.status = '', 2000);

            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    this.status = 'Произошла ошибка при сохранении данных.';
                }
            }
        }
    }
};
</script>

<style scoped>
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-15px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.animate-fadeInDown {
    animation: fadeInDown 0.7s ease forwards;
}

.animate-fadeIn {
    animation: fadeIn 0.8s ease forwards;
}
</style>
