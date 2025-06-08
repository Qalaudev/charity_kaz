<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 p-6 bg-gray-50 min-h-screen">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Управление ролями и правами</h1>
            <p class="text-gray-600">Создавайте и управляйте ролями пользователей и их правами доступа</p>
        </div>

        <!-- Уведомления -->
        <div v-if="notification.show"
             :class="notification.type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'"
             class="border-l-4 p-4 mb-6 rounded">
            <p>{{ notification.message }}</p>
        </div>

        <!-- Табы -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap sm:flex-nowrap -mb-px px-4 sm:px-6 lg:px-8">
                    <button
                        @click="activeTab = 'roles'"
                        :class="activeTab === 'roles' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="w-full sm:w-auto whitespace-nowrap py-4 px-3 sm:px-1 border-b-2 font-medium text-sm text-center sm:text-left"
                    >
                        Роли
                    </button>
                    <button
                        @click="activeTab = 'permissions'"
                        :class="activeTab === 'permissions' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="w-full sm:w-auto whitespace-nowrap py-4 px-3 sm:px-1 border-b-2 font-medium text-sm text-center sm:text-left"
                    >
                        Права
                    </button>
                </nav>
            </div>

            <!-- Контент табов -->
            <div class="p-4 sm:p-6">
                <!-- Роли -->
                <div v-if="activeTab === 'roles'">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <h2 class="text-xl font-semibold text-gray-900">Роли пользователей</h2>
                        <button
                            @click="openRoleModal()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                />
                            </svg>
                            Добавить роль
                        </button>
                    </div>

                    <!-- Список ролей -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div
                            v-for="role in roles"
                            :key="role.id"
                            class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow"
                        >
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-semibold text-gray-900">{{ role.name }}</h3>
                                <div class="flex space-x-2">
                                    <button @click="openRoleModal(role)"
                                            class="text-blue-600 hover:text-blue-800 text-sm p-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            aria-label="Редактировать">
                                        <!-- Иконка карандаша (редактировать) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h6m-3 0v6m0 6h6m-6 0v-6M9 15l-4 4m0 0l4-4m-4 4V9a2 2 0 012-2h5" />
                                        </svg>
                                    </button>
                                    <button @click="deleteRole(role.id)"
                                            class="text-red-600 hover:text-red-800 text-sm p-1 rounded focus:outline-none focus:ring-2 focus:ring-red-500"
                                            aria-label="Удалить">
                                        <!-- Иконка корзины (удалить) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5-4h4m-4 0v4m4-4v4M9 11h6" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                            <div class="text-sm text-gray-600">
                                <p class="mb-2">Права ({{ role.permissions.length }}):</p>
                                <div v-if="role.permissions.length > 0" class="flex flex-wrap gap-1">
                  <span v-for="permission in role.permissions.slice(0, 3)" :key="permission.id"
                        class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                    {{ permission.name }}
                  </span>
                                    <span v-if="role.permissions.length > 3"
                                          class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                    +{{ role.permissions.length - 3 }}
                  </span>
                                </div>
                                <span v-else class="text-gray-400">Нет прав</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Права -->
                <div v-if="activeTab === 'permissions'">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <h2 class="text-xl font-semibold text-gray-900">Права доступа</h2>
                        <button
                            @click="openPermissionModal()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                />
                            </svg>
                            Добавить право
                        </button>
                    </div>

                    <!-- Список прав -->
                    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Название права
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Используется в ролях
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="permission in permissions" :key="permission.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ permission.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ permission.roles_count || 0 }} ролей
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="openPermissionModal(permission)"
                                            class="text-blue-600 hover:text-blue-900 mr-4">
                                        Редактировать
                                    </button>
                                    <button @click="deletePermission(permission.id)"
                                            class="text-red-600 hover:text-red-900">
                                        Удалить
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для ролей -->
        <div
            v-if="roleModal.show"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-start sm:items-center justify-center p-4"
        >
            <div
                class="relative mx-auto p-5 border w-full max-w-lg sm:max-w-2xl shadow-lg rounded-md bg-white"
            >   <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ roleModal.editing ? 'Редактировать роль' : 'Создать новую роль' }}
                    </h3>

                    <form @submit.prevent="saveRole">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Название роли</label>
                            <input v-model="roleModal.form.name"
                                   type="text"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Права доступа</label>
                            <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-md p-3">
                                <div v-for="permission in permissions" :key="permission.id" class="flex items-center mb-2">
                                    <input :id="'perm-' + permission.id"
                                           v-model="roleModal.form.permissions"
                                           :value="permission.id"
                                           type="checkbox"
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label :for="'perm-' + permission.id" class="ml-2 text-sm text-gray-700">
                                        {{ permission.name }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button @click="closeRoleModal"
                                    type="button"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                                Отмена
                            </button>
                            <button type="submit"
                                    :disabled="loading"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md disabled:opacity-50">
                                {{ loading ? 'Сохранение...' : 'Сохранить' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Модальное окно для прав -->
        <div
            v-if="permissionModal.show"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-start sm:items-center justify-center p-4"
        >
            <div
                class="relative mx-auto p-5 border w-full max-w-md sm:max-w-lg shadow-lg rounded-md bg-white"
            >
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ permissionModal.editing ? 'Редактировать право' : 'Создать новое право' }}
                    </h3>

                    <form @submit.prevent="savePermission">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Название права</label>
                            <input v-model="permissionModal.form.name"
                                   type="text"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button @click="closePermissionModal"
                                    type="button"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                                Отмена
                            </button>
                            <button type="submit"
                                    :disabled="loading"
                                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md disabled:opacity-50">
                                {{ loading ? 'Сохранение...' : 'Сохранить' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'RolesPermissionsManager',
    data() {
        return {
            loading: false,
            activeTab: 'roles',
            roles: [],
            permissions: [],
            notification: {
                show: false,
                type: 'success',
                message: ''
            },
            roleModal: {
                show: false,
                editing: false,
                form: {
                    id: null,
                    name: '',
                    permissions: []
                }
            },
            permissionModal: {
                show: false,
                editing: false,
                form: {
                    id: null,
                    name: ''
                }
            }
        }
    },
    async mounted() {
        await this.fetchData()
    },
    methods: {
        async fetchData() {
            this.loading = true
            try {
                const [rolesResponse, permissionsResponse] = await Promise.all([
                    axios.get('/api/roles'),
                    axios.get('/api/permissions')
                ])
                this.roles = rolesResponse.data.data
                this.permissions = permissionsResponse.data.data
            } catch (error) {
                this.showNotification('Ошибка загрузки данных', 'error')
                console.error('Fetch error:', error)
            } finally {
                this.loading = false
            }
        },

        // Управление ролями
        openRoleModal(role = null) {
            this.roleModal.editing = !!role
            this.roleModal.form = {
                id: role?.id || null,
                name: role?.name || '',
                permissions: role?.permissions?.map(p => p.id) || []
            }
            this.roleModal.show = true
        },

        closeRoleModal() {
            this.roleModal.show = false
            this.roleModal.form = { id: null, name: '', permissions: [] }
        },

        async saveRole() {
            this.loading = true
            try {
                const data = {
                    name: this.roleModal.form.name,
                    permissions: this.roleModal.form.permissions
                }

                if (this.roleModal.editing) {
                    await axios.put(`/api/roles/${this.roleModal.form.id}`, data)
                    this.showNotification('Роль успешно обновлена', 'success')
                } else {
                    await axios.post('/api/roles', data)
                    this.showNotification('Роль успешно создана', 'success')
                }

                this.closeRoleModal()
                await this.fetchData()
            } catch (error) {
                const message = error.response?.data?.message || 'Ошибка сохранения роли'
                this.showNotification(message, 'error')
                console.error('Save role error:', error)
            } finally {
                this.loading = false
            }
        },

        async deleteRole(roleId) {
            if (!confirm('Вы уверены, что хотите удалить эту роль?')) return

            this.loading = true
            try {
                await axios.delete(`/api/roles/${roleId}`)
                this.showNotification('Роль успешно удалена', 'success')
                await this.fetchData()
            } catch (error) {
                const message = error.response?.data?.message || 'Ошибка удаления роли'
                this.showNotification(message, 'error')
                console.error('Delete role error:', error)
            } finally {
                this.loading = false
            }
        },

        // Управление правами
        openPermissionModal(permission = null) {
            this.permissionModal.editing = !!permission
            this.permissionModal.form = {
                id: permission?.id || null,
                name: permission?.name || ''
            }
            this.permissionModal.show = true
        },

        closePermissionModal() {
            this.permissionModal.show = false
            this.permissionModal.form = { id: null, name: '' }
        },

        async savePermission() {
            this.loading = true
            try {
                const data = { name: this.permissionModal.form.name }

                if (this.permissionModal.editing) {
                    await axios.put(`/api/permissions/${this.permissionModal.form.id}`, data)
                    this.showNotification('Право успешно обновлено', 'success')
                } else {
                    await axios.post('/api/permissions', data)
                    this.showNotification('Право успешно создано', 'success')
                }

                this.closePermissionModal()
                await this.fetchData()
            } catch (error) {
                const message = error.response?.data?.message || 'Ошибка сохранения права'
                this.showNotification(message, 'error')
                console.error('Save permission error:', error)
            } finally {
                this.loading = false
            }
        },

        async deletePermission(permissionId) {
            if (!confirm('Вы уверены, что хотите удалить это право?')) return

            this.loading = true
            try {
                await axios.delete(`/api/permissions/${permissionId}`)
                this.showNotification('Право успешно удалено', 'success')
                await this.fetchData()
            } catch (error) {
                const message = error.response?.data?.message || 'Ошибка удаления права'
                this.showNotification(message, 'error')
                console.error('Delete permission error:', error)
            } finally {
                this.loading = false
            }
        },

        // Уведомления
        showNotification(message, type = 'success') {
            this.notification = { show: true, message, type }
            setTimeout(() => {
                this.notification.show = false
            }, 5000)
        }
    }
}
</script>
