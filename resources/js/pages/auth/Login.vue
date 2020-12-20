<template>
  <div >
    <div class="mx-auto max-w-md">
      <card title="Login">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="mb-3">
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="E-Mail" class="border w-full p-3" type="email" name="email">
              <has-error :form="form" field="email"/>
            </div>
          </div>

          <!-- Password -->
          <div class="mb-6">
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="border w-full p-3" type="password" name="password" placeholder="**************">
              <has-error :form="form" field="password"/>
            </div>
          </div>

          <!-- Remember Me -->
          <div class="mb-9">
            <div class="col-md-3"/>
            <div class="col-md-7 d-flex">
              <checkbox v-model="remember" name="remember">
                Remember Me
              </checkbox>

<!--              <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">-->
<!--                Forgot Password-->
<!--              </router-link>-->
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                Login
              </v-button>

            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'

export default {
  components: {},

  middleware: 'guest',

  metaInfo() {
    return {title: "Login"}
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login() {
      // Submit the form.
      const {data} = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect() {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({path: intendedUrl})
      } else {
        this.$router.push({name: 'home'})
      }
    }
  }
}
</script>
