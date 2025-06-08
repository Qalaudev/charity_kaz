<template>
    <Navbar></Navbar>
    <!-- Container -->
    <div class="bg-gray-100 py-10 min-h-screen flex justify-center items-start px-4 sm:px-6">
        <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">


            <button
                class="md:hidden fixed top-4 left-4 z-50 bg-green-100 text-green-900 p-3 rounded-full shadow-lg
         hover:bg-green-200 focus:outline-none focus:ring-4 focus:ring-green-300
         transition duration-300 ease-in-out transform hover:scale-110 active:scale-95"
                @click="showMenu = !showMenu"
            >
                <!-- Иконка: бургер -->
                <svg v-if="!showMenu" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"
                     :class="{'animate-fade-in-down': !showMenu}">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <!-- Иконка: крестик -->
                <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"
                     :class="{'animate-fade-in-up': showMenu}">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Sidebar -->
            <aside
                :class="[
    'bg-gradient-to-b from-green-50 to-green-100 text-green-900 p-8 fixed md:static top-0 left-0 h-full z-40 transform transition-transform duration-500 ease-in-out mt-16 rounded-r-xl shadow-xl',
    showMenu ? 'translate-x-0 w-3/4 sm:w-2/4' : '-translate-x-full',
    'md:translate-x-0 md:w-1/4 md:block mt-0'
  ]"
            >
                <h2 class="text-3xl ml-8 font-extrabold mb-8 tracking-wide drop-shadow-md text-green-700 animate-pulse">
                    {{ $t('menus') }}
                </h2>
                <ul class="space-y-6">
                    <li>
                        <button
                            @click="showSection = 'profile'"
                            :class="showSection === 'profile' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('profile') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="showSection = 'achievements'"
                            :class="showSection === 'achievements' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('achievements') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="showSection = 'donations'"
                            :class="showSection === 'donations' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('history-charity') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="showSection = 'subscriptions'"
                            :class="showSection === 'subscriptions' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('my-records') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="showSection = 'cards'"
                            :class="showSection === 'cards' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('my-card') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="showSection = 'createGroup'"
                            class="w-full text-left hover:text-green-500 transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('help_create_group') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="listGroupHelp"
                            :class="showSection === 'groups' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('group-that-needs-help') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="chats"
                            :class="showSection === 'chats' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            {{ $t('message_chat') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="users"
                            :class="showSection === 'users' ? 'text-green-600 font-bold underline decoration-green-400 underline-offset-4' : 'hover:text-green-500'"
                            class="w-full text-left transition-all duration-300 ease-in-out hover:scale-105"
                        >
                            Қолданушылар
                        </button>
                    </li>
                    <li>
                        <button
                            @click="logout"
                            class="w-full text-left hover:text-red-500 transition-transform duration-300 ease-in-out hover:scale-110 active:scale-95"
                        >
                            {{ $t('logout') }}
                        </button>
                    </li>
                </ul>
            </aside>


            <!-- Main Content -->
            <main class="w-full md:w-3/4 p-6 sm:p-10 bg-gray-50">
                <!-- Profile Section -->
                <section
                    v-show="showSection === 'profile'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100 relative z-20': showSection === 'profile', 'opacity-0 absolute -z-10': showSection !== 'profile' }"
                >
                    <!-- Profile photo -->
                    <div class="flex items-center mb-10">
                        <!-- Avatar -->
                        <div
                            class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-tr from-green-100 via-green-200 to-green-50 flex items-center justify-center relative overflow-hidden cursor-pointer shadow-lg ring-4 ring-green-300 hover:ring-green-400 transition-all duration-400 animate-pulse-slow"
                            @click="triggerFileInput"
                            title="Суретті өзгерту"
                        >
                            <img
                                :src="user.photo_url || photoPreview"
                                alt="User Avatar"
                                class="object-cover w-full h-full rounded-full transform hover:scale-105 transition-transform duration-500"
                            />
                            <div
                                class="absolute bottom-1 right-1 bg-green-600 hover:bg-green-700 p-2 rounded-full text-white shadow-lg text-xl select-none"
                            >
                                📷
                            </div>
                            <input type="file" @change="onPhotoChange" accept="image/*" class="hidden"
                                   ref="photoInput"/>
                        </div>

                        <!-- Name -->
                        <div class="ml-8">
                            <h2 class="text-4xl font-extrabold text-green-900 drop-shadow-md select-text">
                                {{ user.name || 'Атыңыз' }}
                            </h2>
                            <p class="text-green-700 mt-1 italic select-text">{{ $t('personal_profile_info') }}</p>
                        </div>
                    </div>


                    <!-- Donation info -->
                    <div
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white py-5 px-7 rounded-xl text-xl font-semibold shadow-lg mb-8 flex justify-center items-center space-x-2 select-text"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 animate-bounce"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 1.343-3 3 0 1.35 1.58 3.5 3 4 1.42-.5 3-2.65 3-4 0-1.657-1.343-3-3-3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v6"/>
                        </svg>
                        <span>{{ $t('your_contribution') }}<span class="ml-2 font-bold">{{ totalDonated }} ₸</span></span>
                    </div>

                    <!-- Success message -->
                    <transition name="fade" mode="out-in">
                        <div
                            v-if="successMessage"
                            key="success-msg"
                            class="bg-green-100 border border-green-400 text-green-800 p-4 rounded-lg mb-6 shadow-md select-text"
                        >
                            {{ successMessage }}
                        </div>
                    </transition>

                    <!-- Profile form -->
                    <form @submit.prevent="submitProfile" class="space-y-6">
                        <div>
                            <label class="block text-green-900 text-lg font-semibold select-none">{{ $t('nazvanie') }}</label>
                            <input
                                type="text"
                                v-model="form.name"
                                placeholder="Атыңызды енгізіңіз"
                                class="mt-2 w-full border border-green-300 rounded-xl shadow-md p-4 focus:outline-none focus:ring-4 focus:ring-green-400 transition duration-300 placeholder-green-400 text-green-900 font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-green-900 text-lg font-semibold select-none">{{ $t('surname') }}</label>
                            <input
                                type="text"
                                v-model="form.surname"
                                placeholder="Тегіңізді енгізіңіз"
                                class="mt-2 w-full border border-green-300 rounded-xl shadow-md p-4 focus:outline-none focus:ring-4 focus:ring-green-400 transition duration-300 placeholder-green-400 text-green-900 font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-green-900 text-lg font-semibold select-none">{{ $t('gender') }}</label>
                            <select
                                v-model="form.gender"
                                class="mt-2 w-full border border-green-300 rounded-xl shadow-md p-4 focus:outline-none focus:ring-4 focus:ring-green-400 transition duration-300 text-green-900 font-medium"
                            >
                                <option value="female">{{$t('female')}}</option>
                                <option value="male">{{ $t('male')}}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-900 text-lg font-semibold select-none">
                                {{ $t('telephone') }}
                            </label>
                            <input
                                type="text"
                                v-model="form.phone_number"
                                placeholder="+7 777 777 77 77"
                                class="mt-2 w-full border border-green-300 rounded-xl shadow-md p-4 focus:outline-none focus:ring-4 focus:ring-green-400 transition duration-300 placeholder-green-400 text-green-900 font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-green-900 text-lg font-semibold select-none">{{ $t('city') }}</label>
                            <select
                                v-model="form.city"
                                class="mt-2 w-full border border-green-300 rounded-xl shadow-md p-4 focus:outline-none focus:ring-4 focus:ring-green-400 transition duration-300 text-green-900 font-medium"
                            >
                                <option value="almaty">Алматы</option>
                                <option value="astana">Нұр-Сұлтан</option>
                                <option value="shymkent">Шымкент</option>
                                <option value="karaganda">Қарағанды</option>
                                <option value="aktobe">Ақтөбе</option>
                                <option value="pavlodar">Павлодар</option>
                                <option value="uralsk">Орал (Батыс Қазақстан)</option>
                                <option value="atyrau">Атырау</option>
                                <option value="semey">Семей</option>
                                <option value="kostanay">Қостанай</option>
                                <option value="taraz">Тараз</option>
                                <option value="petropavlovsk">Петропавл</option>
                                <option value="ekibastuz">Екібастұз</option>
                                <option value="kokshetau">Көкшетау</option>
                                <option value="kzylorda">Қызылорда</option>
                                <option value="zhanaozen">Жаңаөзен</option>
                                <option value="temirtau">Теміртау</option>
                                <option value="taldykorgan">Талдықорған</option>
                                <option value="kapshagai">Қапшағай</option>

                            </select>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl shadow-lg font-extrabold text-lg transform hover:scale-105 transition-transform duration-300"
                        >
                            Сақтау
                        </button>
                    </form>
                </section>

                <!-- Achievements Section -->
                <section
                    v-show="showSection === 'achievements'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'achievements', 'opacity-0 absolute': showSection !== 'achievements' }"
                >
                    <h2
                        class="text-3xl font-extrabold mb-8 text-green-700 drop-shadow-lg tracking-wide animate-fadeInDown"
                    >
                        Менің жетістіктерім
                    </h2>

                    <!-- Achievement Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                        <div
                            class="bg-gradient-to-tr from-green-100 to-green-300 text-green-900 p-8 rounded-xl text-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-500 ease-in-out animate-pulse-slow"
                        >
                            <h3 class="text-4xl font-bold mb-2 drop-shadow-md">{{ achievements.totalDonations }}</h3>
                            <p class="text-green-800 font-medium">Барлық ауыстырулар</p>
                        </div>
                        <div
                            class="bg-gradient-to-tr from-green-100 to-green-300 text-green-900 p-8 rounded-xl text-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-500 ease-in-out animate-pulse-slow delay-150"
                        >
                            <h3 class="text-4xl font-bold mb-2 drop-shadow-md">{{ achievements.helpedProjects }}</h3>
                            <p class="text-green-800 font-medium">Көмектескен жобалар</p>
                        </div>
                        <div
                            class="bg-gradient-to-tr from-green-100 to-green-300 text-green-900 p-8 rounded-xl text-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-500 ease-in-out animate-pulse-slow delay-300"
                        >
                            <h3 class="text-4xl font-bold mb-2 drop-shadow-md">{{ achievements.volunteeredHours }}</h3>
                            <p class="text-green-800 font-medium">Волонтерлік сағаттар</p>
                        </div>
                    </div>

                    <!-- Badges -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-xl animate-fadeInUp"
                    >
                        <h3 class="text-xl font-semibold mb-6 text-green-700 border-b-2 border-green-300 pb-2">
                            Алған белгілеріңіз
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div
                                v-for="badge in achievements.badges"
                                :key="badge.id"
                                class="text-center p-5 border border-green-200 rounded-lg hover:shadow-xl hover:scale-105 transition-transform duration-300 cursor-pointer bg-green-50"
                            >
                                <div class="text-5xl mb-3 text-green-600 animate-bounce">{{
                                        badge.icon
                                    }}
                                </div>
                                <h4 class="font-semibold text-green-800">{{ badge.name }}</h4>
                                <p class="text-sm text-green-600 mt-1">{{ badge.description }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Donations History Section -->
                <section
                    v-show="showSection === 'donations'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'donations', 'opacity-0 absolute': showSection !== 'donations' }"
                >
                    <h2
                        class="text-3xl font-extrabold mb-8 text-green-700 drop-shadow-lg tracking-wide animate-fadeInDown"
                    >
                        {{ $t('history-charity') }}
                    </h2>

                    <!-- Filter Options -->
                    <div
                        class="bg-white p-5 rounded-xl shadow-lg mb-8 flex flex-wrap gap-4 items-center animate-fadeInUp"
                    >
                        <select
                            v-model="donationFilter.period"
                            class="border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                        >
                            <option value="all">Барлық уақыт</option>
                            <option value="month">Осы ай</option>
                            <option value="year">Осы жыл</option>
                        </select>
                        <select
                            v-model="donationFilter.type"
                            class="border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                        >
                            <option value="all">Барлық түрлері</option>
                            <option value="money">Ақшалай</option>
                            <option value="goods">Тауарлар</option>
                            <option value="time">Уақыт</option>
                        </select>
                    </div>

                    <!-- Donations Table -->
                    <div
                        class="bg-white rounded-xl shadow-xl overflow-hidden animate-fadeInUp"
                    >
                        <table class="w-full text-left">
                            <div>
                                <h2 class="text-lg font-bold mb-4">Мои пожертвования</h2>
<!--                                <ul>-->
<!--                                    <li v-for="don in donations" :key="don.id">-->
<!--                                        {{ don.amount }} KZT - {{ don.card_last_digits }} - {{ new Date(don.created_at).toLocaleString() }}-->
<!--                                    </li>-->
<!--                                </ul>-->
                                <table class="w-full text-sm text-left rtl:text-right text-black-100 dark:text-black">
                                    <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-black-400">
                                        <tr>
                                            <th class="px-6 py-3">ID</th>
                                            <th class="px-6 py-3">User ID</th>
                                            <th class="px-6 py-3">Amount</th>
                                            <th class="px-6 py-3">Card</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="don in donations" :key="don.id">
                                        <th scope="col" class="px-6 py-3">
                                            {{don.id}}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{don.user_id}}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ don.amount }} KZT
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            **** {{ don.card_last_digits }}
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </table>
                        <div
                            v-if="!filteredDonations.length"
                            class="p-10 text-center text-green-400 font-semibold animate-fadeIn"
                        >
                            Қайырымдылық тарихы табылмады
                        </div>
                    </div>
                </section>

                <!-- Subscriptions Section -->
                <section
                    v-show="showSection === 'subscriptions'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'subscriptions', 'opacity-0 absolute': showSection !== 'subscriptions' }"
                >
                    <h2 class="text-3xl font-extrabold mb-8 text-green-700 tracking-wide animate-fadeInDown">
                        Менің жазылмаларым
                    </h2>

                    <!-- Active Subscriptions -->
                    <div class="mb-10">
                        <h3 class="text-xl font-semibold mb-6 text-green-600 border-b border-green-300 pb-2 animate-fadeInLeft">
                            Белсенді жазылмалар
                        </h3>
                        <div class="space-y-6">
                            <div
                                v-for="subscription in activeSubscriptions"
                                :key="subscription.id"
                                class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-center border-2 border-green-200 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-500 animate-popIn"
                            >
                                <div>
                                    <h4 class="font-semibold text-lg text-green-800">{{ subscription.project }}</h4>
                                    <p class="text-green-700/80">{{ subscription.description }}</p>
                                    <p class="text-sm text-green-500 mt-2 italic">
                                        Келесі төлем: {{ formatDate(subscription.nextPayment) }}
                                    </p>
                                </div>
                                <div class="text-right flex flex-col items-end space-y-2">
                                    <p class="font-extrabold text-green-700 text-lg animate-pulse">
                                        {{ subscription.amount }} ₸/ай
                                    </p>
                                    <button
                                        @click="cancelSubscription(subscription.id)"
                                        class="mt-2 px-5 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 active:scale-95 transform transition"
                                    >
                                        Тоқтату
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div v-if="!activeSubscriptions.length"
                             class="text-green-400 text-center py-12 italic select-none animate-fadeIn">
                            Белсенді жазылмалар жоқ
                        </div>
                    </div>

                    <!-- Newsletter Subscriptions -->
                    <div
                        class="bg-white p-6 rounded-xl shadow-lg border-2 border-green-200 animate-fadeInUp"
                    >
                        <h3 class="text-xl font-semibold mb-5 text-green-600 border-b border-green-300 pb-2">
                            Жаңалықтар мен хабарландырулар
                        </h3>
                        <div class="space-y-4">
                            <label
                                class="flex items-center cursor-pointer select-none hover:text-green-700 transition-colors"
                                v-for="(value, key) in newsletterSettings"
                                :key="key"
                            >
                                <input
                                    type="checkbox"
                                    v-model="newsletterSettings[key]"
                                    class="mr-4 w-5 h-5 text-green-600 focus:ring-green-500 border-green-300 rounded transition"
                                />
                                <span class="font-medium text-green-700 capitalize">
          {{
                                        {
                                            weeklyNews: 'Апталық жаңалықтар',
                                            projectUpdates: 'Жоба жаңартулары',
                                            donationReceipts: 'Қайырымдылық түбіртектері',
                                            emergencyAlerts: 'Шұғыл жағдай хабарландырулары'
                                        }[key]
                                    }}
        </span>
                            </label>
                        </div>
                        <button
                            @click="saveNewsletterSettings"
                            class="mt-6 px-8 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-lg hover:bg-green-700 active:scale-95 transform transition"
                        >
                            {{ $t('save') }}
                        </button>
                    </div>
                </section>

                <!-- Cards Section -->
                <section
                    v-show="showSection === 'cards'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'cards', 'opacity-0 absolute': showSection !== 'cards' }"
                >
                    <h2 class="text-3xl font-extrabold mb-8 text-green-700 tracking-wide animate-fadeInDown">
                        Менің карталарым
                    </h2>

                    <!-- Add New Card Button -->
                    <button
                        @click="showAddCardForm = !showAddCardForm"
                        class="mb-8 px-8 py-3 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg shadow-md hover:from-green-500 hover:to-green-700 active:scale-95 transform transition"
                    >
                        + Жаңа карта қосу
                    </button>

                    <!-- Add Card Form -->
                    <div
                        v-if="showAddCardForm"
                        class="bg-white p-6 rounded-xl shadow-lg border-2 border-green-200 mb-8 animate-fadeInUp"
                    >
                        <h3 class="text-xl font-semibold mb-6 text-green-700 border-b border-green-300 pb-2">
                            Жаңа карта қосу
                        </h3>
                        <form @submit.prevent="addCard" class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-green-800">Карта нөмірі</label>
                                <input
                                    type="text"
                                    v-model="newCard.number"
                                    placeholder="1234 5678 9012 3456"
                                    class="mt-2 w-full border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                />
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-green-800">Жарамдылық мерзімі</label>
                                    <input
                                        type="text"
                                        v-model="newCard.expiry"
                                        placeholder="MM/YY"
                                        class="mt-2 w-full border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-green-800">CVV</label>
                                    <input
                                        type="text"
                                        v-model="newCard.cvv"
                                        placeholder="123"
                                        class="mt-2 w-full border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-green-800">Карта иесінің аты</label>
                                <input
                                    type="text"
                                    v-model="newCard.holderName"
                                    placeholder="JOHN DOE"
                                    class="mt-2 w-full border border-green-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                />
                            </div>
                            <div class="flex gap-4">
                                <button
                                    type="submit"
                                    class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 active:scale-95 transform transition"
                                >
                                    Қосу
                                </button>
                                <button
                                    type="button"
                                    @click="showAddCardForm = false"
                                    class="px-8 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 active:scale-95 transform transition"
                                >
                                    Болдырмау
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Saved Cards -->
                    <div class="space-y-6">
                        <div
                            v-for="card in savedCards"
                            :key="card.id"
                            class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-center border-2 border-green-200 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-500 animate-popIn"
                        >
                            <div class="flex items-center">
                                <div
                                    class="w-14 h-10 bg-gradient-to-r from-green-400 to-green-600 rounded-lg mr-6 flex items-center justify-center text-white font-bold text-xs tracking-wide shadow-md"
                                >
                                    {{ getCardType(card.number) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-green-800">**** **** **** {{
                                            card.number.slice(-4)
                                        }}</p>
                                    <p class="text-green-700 text-sm">{{ card.holderName }}</p>
                                    <p class="text-green-500 text-xs italic">Жарамдылық: {{ card.expiry }}</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button
                                    @click="setDefaultCard(card.id)"
                                    :class="card.isDefault ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'"
                                    class="px-4 py-1 rounded-lg text-sm font-semibold shadow-sm hover:shadow-md transition"
                                >
                                    {{ card.isDefault ? 'Негізгі' : 'Негізгі ету' }}
                                </button>
                                <button
                                    @click="removeCard(card.id)"
                                    class="px-4 py-1 bg-red-100 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-200 transition shadow-sm"
                                >
                                    Жою
                                </button>
                            </div>
                        </div>
                        <div v-if="!savedCards.length"
                             class="text-green-400 text-center py-12 italic select-none animate-fadeIn">
                            Сақталған карталар жоқ
                        </div>
                    </div>
                </section>

                <!-- Create Groups Section -->
                <section
                    v-show="showSection === 'createGroup'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'createGroup', 'opacity-0 absolute': showSection !== 'createGroup' }"
                >
                    <charity-group class="animate-fadeInScale"/>
                </section>


                <!-- Chat-->
                <section
                    v-show="showSection === 'chats'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'chats', 'opacity-0 absolute': showSection !== 'chats' }"
                >
                    <chat class="animate-fadeInScale"/>
                </section>

                <!-- Users-->
                <section
                    v-show="showSection === 'users'"
                    class="transition-opacity duration-500 ease-in-out"
                    :class="{ 'opacity-100': showSection === 'users', 'opacity-0 absolute': showSection !== 'users' }"
                >
                    <users class="animate-fadeInScale" />
                </section>

                <!-- Helps Section -->
                <section
                    v-show="showSection === 'groups'"
                    class="mt-6 transition-opacity duration-500 overflow-x-auto"
                    :class="{ 'opacity-100': showSection === 'groups', 'opacity-0 absolute': showSection !== 'groups' }"
                >
                    <h2 class="text-3xl font-extrabold mb-6 text-green-700 tracking-wider animate-slideDown">
                        Көмек керек топ
                    </h2>

                    <!-- Helps Section Table -->
                    <table
                        v-if="helps.length"
                        class="w-full min-w-[600px] bg-white border border-green-300 rounded-xl shadow-lg text-sm md:text-base"
                    >
                        <thead>
                        <tr class="bg-green-100 border-b border-green-200 uppercase tracking-wide text-green-800 select-none animate-fadeIn">
                            <th class="py-3 px-5 border-b border-green-200">Имя группы</th>
                            <th class="py-3 px-5 border-b border-green-200">Тема</th>
                            <th class="py-3 px-5 border-b border-green-200">Описание</th>
                            <th class="py-3 px-5 border-b border-green-200">Документы, файлы, изображение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="help in helps"
                            :key="help.id"
                            class="border-b border-green-100 hover:bg-green-50 transition-colors duration-300 cursor-pointer animate-fadeInUp"
                        >
                            <td class="py-3 px-5 text-green-900 font-medium">{{ help.name }}</td>
                            <td class="py-3 px-5 text-green-800">{{ help.title }}</td>
                            <td class="py-3 px-5 text-green-700">{{ help.description }}</td>
                            <td class="py-3 px-5">
                                <a
                                    :href="`/${help.image}`"
                                    target="_blank"
                                    class="text-green-600 hover:text-green-800 underline font-semibold transition"
                                >
                                    {{ help.image.split('/').pop() }}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <p v-else class="text-green-500 italic mt-12 text-center select-none animate-fadeIn">
                        Тізім бос
                    </p>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Navbar from '../components/Navbar.vue';
import CharityGroup from './CharityGroup.vue';
import Chat from './design/Chat.vue';
import Users from './design/Users.vue';
export default {
    components: {
        CharityGroup,Navbar,Chat,Users
    },
    data() {
        return {
            showMenu: false,
            showSection: 'profile',
            photoPreview: null,
            form: {
                name: '',
                surname: '',
                gender: 'male',
                phone_number: '',
                city: 'almaty',
            },
            successMessage: '',
            helps: [],
            user: {},
            totalDonated: 0,

            // Achievements data
            achievements: {
                totalDonations: 0,
                helpedProjects: 0,
                volunteeredHours: 0,
                badges: [
                    {id: 1, name: 'Алғашқы көмек', description: 'Алғашқы қайырымдылық', icon: '🌟'},
                    {id: 2, name: 'Мейірімді жүрек', description: '10+ қайырымдылық', icon: '❤️'},
                    {id: 3, name: 'Қоғам серіктесі', description: 'Үнемі көмек беруші', icon: '🤝'},
                    {id: 4, name: 'Волонтер', description: '50+ сағат еңбек', icon: '🙌'}
                ]
            },

            // Donations data
            donations: [
                {
                    id: 1,
                    date: '2024-12-01',
                    project: 'Балаларға көмек',
                    type: 'money',
                    amount: 5000,
                    currency: '₸',
                    status: 'completed'
                },
                {
                    id: 2,
                    date: '2024-11-15',
                    project: 'Мектеп құрылысы',
                    type: 'money',
                    amount: 10000,
                    currency: '₸',
                    status: 'completed'
                },
                {
                    id: 3,
                    date: '2024-11-01',
                    project: 'Мүгедектерге қолдау',
                    type: 'goods',
                    amount: 3000,
                    currency: '₸',
                    status: 'pending'
                },
                {
                    id: 4,
                    date: '2024-10-20',
                    project: 'Қарттар үйі',
                    type: 'time',
                    amount: 8,
                    currency: 'сағат',
                    status: 'completed'
                }
            ],
            donationFilter: {
                period: 'all',
                type: 'all'
            },

            // Subscriptions data
            activeSubscriptions: [
                {
                    id: 1,
                    project: 'Балаларға ай сайынғы көмек',
                    description: 'Жетім балаларға тұрақты қолдау көрсету',
                    amount: 2000,
                    nextPayment: '2025-01-01'
                },
                {
                    id: 2,
                    project: 'Экология жобасы',
                    description: 'Табиғатты қорғау жобаларына қолдау',
                    amount: 1500,
                    nextPayment: '2025-01-05'
                }
            ],
            newsletterSettings: {
                weeklyNews: true,
                projectUpdates: true,
                donationReceipts: false,
                emergencyAlerts: true
            },

            // Cards data
            savedCards: [
                {
                    id: 1,
                    number: '4111111111111234',
                    expiry: '12/26',
                    holderName: 'JOHN DOE',
                    isDefault: true
                },
                {
                    id: 2,
                    number: '5555555555554444',
                    expiry: '10/25',
                    holderName: 'JOHN DOE',
                    isDefault: false
                }
            ],
            showAddCardForm: false,
            newCard: {
                number: '',
                expiry: '',
                cvv: '',
                holderName: ''
            },
            donationsPayment:[]
        };
    },

    async mounted() {
        const res = await axios.get('/my-donations');
        this.donations = res.data;
    },

    computed: {
        filteredDonations() {
            let filtered = this.donations;

            if (this.donationFilter.type !== 'all') {
                filtered = filtered.filter(d => d.type === this.donationFilter.type);
            }

            if (this.donationFilter.period !== 'all') {
                const now = new Date();
                const filterDate = new Date();

                if (this.donationFilter.period === 'month') {
                    filterDate.setMonth(now.getMonth() - 1);
                } else if (this.donationFilter.period === 'year') {
                    filterDate.setFullYear(now.getFullYear() - 1);
                }

                filtered = filtered.filter(d => new Date(d.date) >= filterDate);
            }

            return filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
        }
    },

    async created() {
        try {
            const response = await axios.get('/api/user');
            this.user = response.data;
            this.form = response.data;
            this.calculateTotalDonated();
            this.loadAchievements();
        } catch (er) {
            console.log("Қолданушының данныйын алу кезінде қателік туды.", er);
        }
    },

    methods: {
        async submitProfile() {
            try {
                const formData = new FormData();

                // Форм өрістерін қосу
                formData.append('name', this.form.name);
                formData.append('surname', this.form.surname);
                formData.append('gender', this.form.gender);
                formData.append('phone_number', this.form.phone_number);
                formData.append('city', this.form.city);

                // Фото бар болса, оны да қосу
                if (this.form.photo) {
                    formData.append('photo', this.form.photo);
                }

                // POST сұраныс multipart/form-data ретінде
                const response = await axios.post('/profile', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                this.successMessage = response.data.message;

            } catch (e) {
                console.error('Профильді сақтау қатесі:', e);
            }
        },

        onPhotoChange(e) {
            const file = e.target.files[0];
            if (file) {
                this.form.photo = file;

                // preview жасау үшін қажет болса
                const reader = new FileReader();
                reader.onload = event => {
                    this.photoPreview = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        triggerFileInput() {
            this.$refs.photoInput.click();
        },

        createGroup() {
            this.$router.push('/create/group');
        },

        async logout() {
            try {
                // 1. Запрос на logout endpoint (если требуется)
                await axios.post('/logout', {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });

                // 2. Удалить токен и данные пользователя
                localStorage.removeItem('token');
                localStorage.removeItem('isLoggedIn');
                delete axios.defaults.headers.common['Authorization'];

                // 3. Можно также обнулить Vuex (если используешь)
                // this.$store.commit('auth/clearUser');

                // 4. Уведомление и переход на главную
                alert('Сәтті шықтыңыз!');
                this.$router.push('/');
            } catch (error) {
                console.error('Logout қатесі:', error);
                alert('Шығу кезінде қате пайда болды.');
            }
        },


        async listGroupHelp() {
            this.showSection = 'groups';
            try {
                const response = await axios.get('/group');
                this.helps = response.data;
            } catch (error) {
                console.error("Деректерді алу кезінде қате:", error);
            }
        },


        async chats() {
            this.showSection = 'chats';
            try {
                // const response = await axios.get('/chats');
                // this.helps = response.data;
            } catch (error) {
                console.error("Деректерді алу кезінде қате:", error);
            }
        },
        async users() {
            this.showSection = 'users';
            try {
                // const response = await axios.get('/chats');
                // this.helps = response.data;
            } catch (error) {
                console.error("Деректерді алу кезінде қате:", error);
            }
        },

        // Achievement methods
        calculateTotalDonated() {
            this.totalDonated = this.donations
                .filter(d => d.type === 'money' && d.status === 'completed')
                .reduce((sum, d) => sum + d.amount, 0);
        },

        loadAchievements() {
            this.achievements.totalDonations = this.donations.length;
            this.achievements.helpedProjects = new Set(this.donations.map(d => d.project)).size;
            this.achievements.volunteeredHours = this.donations
                .filter(d => d.type === 'time')
                .reduce((sum, d) => sum + d.amount, 0);
        },

        // Donation methods
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('kk-KZ');
        },

        getDonationTypeClass(type) {
            const classes = {
                'money': 'bg-green-100 text-green-800',
                'goods': 'bg-blue-100 text-blue-800',
                'time': 'bg-purple-100 text-purple-800'
            };
            return classes[type] || 'bg-gray-100 text-gray-800';
        },

        getDonationTypeName(type) {
            const names = {
                'money': 'Ақшалай',
                'goods': 'Тауарлар',
                'time': 'Уақыт'
            };
            return names[type] || type;
        },

        getStatusClass(status) {
            const classes = {
                'completed': 'bg-green-100 text-green-800',
                'pending': 'bg-yellow-100 text-yellow-800',
                'failed': 'bg-red-100 text-red-800'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        },

        getStatusName(status) {
            const names = {
                'completed': 'Аяқталды',
                'pending': 'Күтілуде',
                'failed': 'Сәтсіз'
            };
            return names[status] || status;
        },

        // Subscription methods
        async cancelSubscription(id) {
            if (confirm('Жазылманы тоқтатуға сенімдісіз бе?')) {
                try {
                    await axios.delete(`/subscriptions/${id}`);
                    this.activeSubscriptions = this.activeSubscriptions.filter(s => s.id !== id);
                    this.successMessage = 'Жазылма сәтті тоқтатылды';
                } catch (error) {
                    console.error('Жазылманы тоқтату қатесі:', error);
                }
            }
        },

        async saveNewsletterSettings() {
            try {
                await axios.post('/newsletter-settings', this.newsletterSettings);
                this.successMessage = 'Жаңалықтар параметрлері сақталды';
            } catch (error) {
                console.error('Параметрлерді сақтау қатесі:', error);
            }
        },

        // Card methods
        async addCard() {
            if (!this.newCard.number || !this.newCard.expiry || !this.newCard.cvv || !this.newCard.holderName) {
                alert('Барлық өрістерді толтырыңыз');
                return;
            }

            try {
                const response = await axios.post('/cards', this.newCard);
                this.savedCards.push({
                    id: Date.now(),
                    ...this.newCard,
                    isDefault: this.savedCards.length === 0
                });

                this.newCard = {number: '', expiry: '', cvv: '', holderName: ''};
                this.showAddCardForm = false;
                this.successMessage = 'Карта сәтті қосылды';
            } catch (error) {
                console.error('Карта қосу қатесі:', error);
            }
        },

        async removeCard(id) {
            if (confirm('Картаны жоюға сенімдісіз бе?')) {
                try {
                    await axios.delete(`/cards/${id}`);
                    this.savedCards = this.savedCards.filter(c => c.id !== id);
                    this.successMessage = 'Карта сәтті жойылды';
                } catch (error) {
                    console.error('Картаны жою қатесі:', error);
                }
            }
        },

        async setDefaultCard(id) {
            try {
                await axios.post(`/cards/${id}/set-default`);
                this.savedCards.forEach(card => {
                    card.isDefault = card.id === id;
                });
                this.successMessage = 'Негізгі карта өзгертілді';
            } catch (error) {
                console.error('Негізгі картаны орнату қатесі:', error);
            }
        },

        getCardType(number) {
            const firstDigit = number.charAt(0);
            if (firstDigit === '4') return 'VISA';
            if (firstDigit === '5') return 'MC';
            return 'CARD';
        }
    }
};
</script>


<style scoped>
@keyframes fade-in-down {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fade-in-down 0.3s ease forwards;
}
.animate-fade-in-up {
    animation: fade-in-up 0.3s ease forwards;
}

/* Custom slow pulse animation */
@keyframes pulse-slow {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}
.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Fade transition for success message */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

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
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(15px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes pulseSlow {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.animate-fadeInDown {
    animation: fadeInDown 0.6s ease forwards;
}
.animate-fadeInUp {
    animation: fadeInUp 0.6s ease forwards;
}
.animate-pulse-slow {
    animation: pulseSlow 3s ease-in-out infinite;
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fadeInLeft {
    0% {
        opacity: 0;
        transform: translateX(-20px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}
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
@keyframes popIn {
    0% {
        opacity: 0;
        transform: scale(0.95);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fadeInDown {
    animation: fadeInDown 0.5s ease forwards;
}
.animate-fadeInLeft {
    animation: fadeInLeft 0.5s ease forwards;
}
.animate-fadeInUp {
    animation: fadeInUp 0.5s ease forwards;
}
.animate-popIn {
    animation: popIn 0.3s ease forwards;
}


@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(15px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes slideDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fadeInScale {
    0% {
        opacity: 0;
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.6s ease forwards;
}
.animate-fadeInUp {
    animation: fadeInUp 0.5s ease forwards;
}
.animate-slideDown {
    animation: slideDown 0.5s ease forwards;
}
.animate-fadeInScale {
    animation: fadeInScale 0.6s ease forwards;
}
</style>
