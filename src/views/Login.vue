<template>
  <div
    class="bg-gray-50 flex-1 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <router-link to="/">
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow"
        />
      </router-link>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Sign in to your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form @submit.prevent="login" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email address
            </label>
            <div class="mt-1">
              <input
                v-model="email"
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                class="
                  appearance-none
                  block
                  w-full
                  px-3
                  py-2
                  border border-gray-300
                  rounded-md
                  shadow-sm
                  placeholder-gray-400
                  focus:outline-none
                  focus:ring-indigo-500
                  focus:border-indigo-500
                  sm:text-sm
                "
              />
            </div>
          </div>

          <div>
            <label
              for="password"
              class="block text-sm font-medium text-gray-700"
            >
              Password
            </label>
            <div class="mt-1">
              <input
                v-model="password"
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                class="
                  appearance-none
                  block
                  w-full
                  px-3
                  py-2
                  border border-gray-300
                  rounded-md
                  shadow-sm
                  placeholder-gray-400
                  focus:outline-none
                  focus:ring-indigo-500
                  focus:border-indigo-500
                  sm:text-sm
                "
              />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember_me"
                name="remember_me"
                type="checkbox"
                class="
                  h-4
                  w-4
                  text-transparent
                  bg-clip-text bg-gradient-to-r
                  from-purple-800
                  to-indigo-700
                  hover:from-purple-700 hover:to-indigo-700
                  border-gray-300
                  rounded
                "
              />
              <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                Remember me
              </label>
            </div>

            <div class="text-sm">
              <a
                href="#"
                class="
                  font-medium
                  text-transparent
                  bg-clip-text bg-gradient-to-r
                  from-purple-800
                  to-indigo-700
                  hover:from-purple-700 hover:to-indigo-700 hover:underline
                "
              >
                Forgot your password?
              </a>
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="
                w-full
                flex
                justify-center
                py-2
                px-4
                border border-transparent
                rounded-md
                shadow-sm
                text-sm
                font-medium
                text-white
                bg-gradient-to-r
                from-purple-800
                to-indigo-700
                hover:from-purple-700 hover:to-indigo-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
              "
            >
              Sign in
            </button>
          </div>
        </form>

        <router-link
          to="/register"
          class="
            mt-2
            block
            w-full
            font-medium
            text-transparent text-sm text-center
            bg-clip-text bg-gradient-to-r
            from-purple-800
            to-indigo-700
            hover:from-purple-700 hover:to-indigo-700 hover:underline
          "
        >
          Sign up
        </router-link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'

import { useStore } from '@/store'
import { AuthActionTypes } from '@/store/modules/auth/action-types'
import { NotificationActionTypes } from '@/store/modules/notification/action-types'
import { NotificationType } from '@/types/notification'

export default defineComponent({
  setup() {
    const email = ref('')
    const password = ref('')
    const store = useStore()
    const router = useRouter()

    const login = () => {
      store
        .dispatch(AuthActionTypes.LOGIN, {
          email: email.value,
          password: password.value,
        })
        .then(() => {
          router.push({ name: 'Home' })
        })
        .catch((error) => {
          store.dispatch(NotificationActionTypes.NOTIFY, {
            title: error.response.statusText,
            subtitle: error.response.data.message,
            type: NotificationType.ERROR,
          })
        })
    }

    return { email, password, login }
  },
})
</script>
