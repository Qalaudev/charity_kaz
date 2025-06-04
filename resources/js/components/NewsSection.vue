<template>
    <section class="py-16 px-4 md:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-4xl font-extrabold text-green-600 animate-fade-in-down">{{ $t('news') }}</h2>
                <div class="flex gap-2 items-center">
                    <!-- Add News Button -->
                    <button
                        @click="openModal"
                        class="bg-green-500 hover:bg-green-600 transition duration-300 text-white font-semibold rounded-xl px-5 py-2 flex items-center gap-2 shadow-md hover:scale-105 transform"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-pulse" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ $t('add_news') }}
                    </button>
                    <button @click="back()" class="bg-green-100 hover:bg-green-200 rounded-full p-3 transition transform hover:rotate-[-10deg]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button @click="front()" class="bg-green-100 hover:bg-green-200 rounded-full p-3 transition transform hover:rotate-[10deg]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    v-for="newsItem in news"
                    :key="newsItem.id"
                    class="bg-white shadow-xl rounded-xl overflow-hidden border border-green-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group"
                >
                    <div class="h-56 bg-gray-200 relative overflow-hidden">
                        <img
                            v-if="newsItem.image_url"
                            :src="newsItem.image_url"
                            :alt="newsItem.title"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-8 text-gray-500 text-sm mb-3">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ newsItem.author }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ formatDate(newsItem.created_at) }}</span>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-green-700 mb-2 group-hover:text-green-600 transition-colors">{{ newsItem.title }}</h3>
                        <p class="text-gray-600 mb-4">{{ truncateText(newsItem.content, 120) }}</p>

                        <div class="flex justify-start gap-4 mt-4">
                            <button
                                @click="readMore(newsItem)"
                                class="border border-green-500 text-green-500 hover:bg-green-500 hover:text-white px-5 py-2 rounded-full transition duration-200"
                            >
                                {{ $t('read_more') }}
                            </button>
                            <button
                                @click="deleteNews(newsItem.id)"
                                class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white p-2 rounded-full transition duration-200"
                                title="Delete"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal"
             class="fixed inset-0 z-50  bg-opacity-40 backdrop-blur-sm flex items-center justify-center px-4 py-8 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-y-auto animate-slide-up">
                <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
                    <h3 class="text-2xl font-bold text-green-600">{{ $t('add_news') }}</h3>
                    <button @click="closeModal" class="text-gray-400 hover:text-gray-600 transition transform hover:rotate-90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitNews" class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1" for="title">{{ $t('title') }}</label>
                        <input v-model="form.title" id="title" type="text"
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title[0] }}</p>
                    </div>

                    <!-- Author -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1" for="author">{{ $t('author') }}</label>
                        <input v-model="form.author" id="author" type="text"
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <p v-if="errors.author" class="text-red-500 text-sm">{{ errors.author[0] }}</p>
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1" for="content">{{ $t('content') }}</label>
                        <textarea v-model="form.content" id="content" rows="6"
                                  class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
                        <p v-if="errors.content" class="text-red-500 text-sm">{{ errors.content[0] }}</p>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1" for="image">{{ $t('image') }}</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center relative">
                            <input @change="handleImageUpload" id="image" type="file" accept="image/*"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div v-if="!form.image" class="space-y-1">
                                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-500">{{ $t('drag_and_drop') }}</p>
                            </div>
                            <div v-else>
                                <img :src="previewImage" class="mx-auto h-32 object-cover rounded">
                                <p class="text-sm mt-2 text-gray-700">{{ form.image.name }}</p>
                            </div>
                        </div>
                        <p v-if="errors.image" class="text-red-500 text-sm">{{ errors.image[0] }}</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="closeModal"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg">
                            {{ $t('cancel') }}
                        </button>
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg transition duration-200 flex items-center gap-2"
                                :disabled="loading">
                            <svg v-if="loading" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span>{{ $t('add') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="selectedNews"  class="fixed inset-0 backdrop-blur-sm bg-transparent flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 relative">
                <button @click="selectedNews = null" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
                    &times;
                </button>

                <h2 class="text-2xl font-bold mb-4">{{ selectedNews.title }}</h2>
                <p class="text-sm text-gray-500 mb-2">{{ formatDate(selectedNews.created_at) }} | {{ selectedNews.author }}</p>

                <img v-if="selectedNews.image_url" :src="selectedNews.image_url" alt="" class="w-full h-64 object-cover rounded mb-4">

                <p class="text-gray-700 leading-relaxed">{{ selectedNews.content }}</p>
            </div>
        </div>

    </section>
</template>


<script>
import axios from 'axios';

export default {
    name: 'NewsSection',
    data() {
        return {
            showModalButton:false,
            news: [],
            showModal: false,
            loading: false,
            user: null, // Данные пользователя
            loadingData: true, // Статус загрузки
            previewImage: null,
            selectedNews: null,
            currentPage: 1,
            lastPage: 1,
            form: {
                title: '',
                author: '',
                content: '',
                image: null
            },
            errors: {}
        };
    },
    created() {
        this.fetchNews();
    },
    mounted() {
      //  this.getUserData();
    },
    methods: {
        async getUserData() {
            try {
                const response = await axios.get('/api/user'); // Запрос к API для получения данных о пользователе
                this.user = response.data; // Данные пользователя
            } catch (error) {
                console.error('Ошибка при получении данных пользователя:', error);
            } finally {
                this.loadingData = false;
            }
        },
        readMore(newsItem) {
            this.selectedNews = newsItem;
        },
        deleteNews(id) {
            if (confirm('Вы уверены, что хотите удалить эту новость?')) {
                axios.delete(`/api/news/${id}`)
                    .then(response => {
                        this.news = this.news.filter(n => n.id !== id);
                        alert(response.data.message); // Можно заменить на красивый toast
                    })
                    .catch(error => {
                        console.error('Ошибка при удалении новости:', error);
                        alert('Произошла ошибка при удалении новости.');
                    });
            }
        },
        fetchNews(page = 1) {
            axios.get(`/api/news?page=${page}`)
                .then(response => {
                    this.news = response.data.data;
                    this.currentPage = page;
                    // Доступ к meta, если вернули с помощью ResourceCollection
                    if (response.data.meta) {
                        this.lastPage = response.data.meta.last_page;
                    }
                })
                .catch(error => {
                    console.error('Error fetching news:', error);
                });
        },
        openModal() {
            this.showModal = true;
            this.resetForm();
        },
        closeModal() {
            this.showModal = false;
            this.resetForm();
        },
        resetForm() {
            this.form = {
                title: '',
                author: '',
                content: '',
                image: null
            };
            this.previewImage = null;
            this.errors = {};
        },
        back() {
            if (this.currentPage > 1) {
                this.fetchNews(this.currentPage - 1);
            }
        },
        front() {
            if (this.currentPage < this.lastPage) {
                this.fetchNews(this.currentPage + 1);
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Проверка типа файла
            if (!file.type.match('image.*')) {
                alert(this.$t('image_format_error'));
                return;
            }

            // Проверка размера файла (5MB)
            if (file.size > 25 * 1024 * 1024) {
                alert(this.$t('image_size_error'));
                return;
            }

            this.form.image = file;

            // Создаем превью
            const reader = new FileReader();
            reader.onload = e => {
                this.previewImage = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        submitNews() {
            this.loading = true;
            this.errors = {};

            const formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('author', this.form.author);
            formData.append('content', this.form.content);

            if (this.form.image) {
                formData.append('image', this.form.image);
            }

            axios.post('/api/news', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.loading = false;
                    this.closeModal();
                    this.fetchNews(); // Обновляем список новостей

                    // Показываем уведомление об успехе
                    // Здесь можно добавить ваш код для отображения уведомлений
                    alert(this.$t('news_added_success'));
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error('Error adding news:', error);
                        alert(this.$t('news_added_error'));
                    }
                });
        },
        truncateText(text, length) {
            if (!text) return '';
            return text.length > length ? text.substring(0, length) + '...' : text;
        },
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString(this.$i18n.locale, {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }
    }
};
</script>
