<script lang="ts">
import { defineComponent } from 'vue'
import axios from "axios";

export default defineComponent({
    name: "Volunteer",
    data () {
        return {
            volunteer: [],
        }
    },
    methods: {
        async listGroupHelp() {
            try {
                const response = await axios.get('/volunteer');
                this.volunteer = response.data;
            } catch (error) {
                console.error("Деректерді алу кезінде қате:", error);
            }
        }
    },

    created() {
        this.listGroupHelp();
    }
})
</script>

<template>
    <div>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-4 sm:mb-6 text-green-700 tracking-wider animate-slideDown text-center sm:text-left">
            Сайт хабарламалары
        </h2>

        <table v-if="volunteer.length" border="1" class="small-text">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Пошта</th>
                <th>Номер телефона</th>
                <th>Дата</th>
                <th>Сообщения</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in volunteer" :key="contact.id">
                <td class="py-3 px-5 text-green-700">{{ contact.first_name }}</td>
                <td class="py-3 px-5 text-green-700" >{{ contact.last_name }}</td>
                <td class="py-3 px-5 text-green-700">{{ contact.email }}</td>
                <td class="py-3 px-5 text-green-700">{{ contact.phone }}</td>
                <td class="py-3 px-5 text-green-700">{{ contact.created_at }}</td>
                <td class="py-3 px-5 text-green-700">{{ contact.message }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
.small-text {
    font-size: 14px;
}
</style>
