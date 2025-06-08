<template>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">User Management</h1>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-2 text-gray-600">Loading users...</span>
        </div>

        <!-- Error State -->
        <div v-if="error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-800">{{ error }}</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <div v-if="successMessage" class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-800">{{ successMessage }}</p>
                </div>
            </div>
        </div>

        <!-- Users List -->
        <div v-if="!loading && users.length > 0" class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                <li v-for="user in users" :key="user.id" class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700">
                      {{ getUserInitials(user.name) }}
                    </span>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1 min-w-0">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ user.name }}
                                        </p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                              :class="getRoleBadgeClass(user.role)">
                      {{ user.role }}
                    </span>
                                    </div>
                                    <p class="text-sm text-gray-500 truncate">{{ user.email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="ml-4 flex-shrink-0">
                            <div class="flex items-center space-x-4">
                                <div class="min-w-0 flex-1">
                                    <label :for="`role-${user.id}`" class="sr-only">Change role for {{ user.name }}</label>
                                    <select
                                        :id="`role-${user.id}`"
                                        v-model="user.role"
                                        @change="updateUserRole(user)"
                                        :disabled="updatingUsers.includes(user.id)"
                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    >
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="moderator">Moderator</option>
                                        <option value="editor">Editor</option>
                                    </select>
                                </div>

                                <div v-if="updatingUsers.includes(user.id)" class="flex-shrink-0">
                                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Empty State -->
        <div v-if="!loading && users.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
            <p class="mt-1 text-sm text-gray-500">No users are currently available.</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'UserRoleManager',
    data() {
        return {
            users: [],
            loading: false,
            error: '',
            successMessage: '',
            updatingUsers: []
        }
    },
    methods: {
        fetchUsers() {
            this.loading = true
            this.error = ''
            axios
                .get('/users')
                .then(response => {
                    this.users = response.data.data || []
                })
                .catch(err => {
                    this.error = `Failed to fetch users: ${err.message}`
                    console.error('Error fetching users:', err)
                })
                .finally(() => {
                    this.loading = false
                })
        },

        updateUserRole(user) {
            this.updatingUsers.push(user.id)
            this.error = ''
            this.successMessage = ''

            axios
                .patch(`/users/${user.id}/role`, {
                    role: user.role
                })
                .then(() => {
                    this.successMessage = `Successfully updated ${user.name}'s role to ${user.role}`
                    setTimeout(() => {
                        this.successMessage = ''
                    }, 3000)
                })
                .catch(async err => {
                    this.error = `Failed to update user role: ${err.response?.data?.message || err.message}`
                    console.error('Error updating user role:', err)
                    await this.fetchUsers()
                })
                .finally(() => {
                    this.updatingUsers = this.updatingUsers.filter(id => id !== user.id)
                })
        },

        getUserInitials(name) {
            if (!name || typeof name !== 'string') return '';

            return name
                .split(' ')
                .map(n => n[0])
                .join('')
                .substring(0, 2)
                .toUpperCase();
        },

        getRoleBadgeClass(role) {
            const classes = {
                admin: 'bg-red-100 text-red-800',
                moderator: 'bg-yellow-100 text-yellow-800',
                editor: 'bg-blue-100 text-blue-800',
                user: 'bg-gray-100 text-gray-800'
            }
            return classes[role] || classes.user
        }
    },
    mounted() {
        this.fetchUsers()
    }
}
</script>
<style scoped>
/* Additional custom styles if needed */
</style>
