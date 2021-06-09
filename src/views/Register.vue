<template>
  <div
    class="
      min-h-screen
      bg-gray-50
      flex flex-col
      justify-center
      py-12
      sm:px-6
      lg:px-8
    "
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
        Create your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form @submit.prevent="register" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
              Name
            </label>

            <div class="mt-1">
              <input
                v-model="name"
                id="name"
                name="name"
                type="text"
                required=""
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
                required=""
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
                required=""
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
              for="password_confirmation"
              class="block text-sm font-medium text-gray-700"
            >
              Password Confirmation
            </label>

            <div class="mt-1">
              <input
                v-model="passwordConfirmation"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="current-password"
                required=""
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
                bg-indigo-600
                hover:bg-indigo-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
              "
            >
              Sign up
            </button>
          </div>
        </form>

        <router-link
          to="/login"
          class="
            mt-2
            block
            w-full
            font-medium
            text-sm text-center text-indigo-600
            hover:text-indigo-500 hover:underline
          "
        >
          Already have an account?
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
import { NotificationType } from '@/types'

export default defineComponent({
  setup() {
    const name = ref('')
    const email = ref('')
    const password = ref('')
    const passwordConfirmation = ref('')
    const store = useStore()
    const router = useRouter()

    const register = () => {
      store
        .dispatch(AuthActionTypes.REGISTER, {
          name: name.value,
          email: email.value,
          password: password.value,
          passwordConfirmation: passwordConfirmation.value,
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

    return {
      name,
      email,
      password,
      passwordConfirmation,
      register,
    }
  },
})
</script>
