<template>
  <div class="row">
    <div class="mx-auto max-w-md">
      <card v-if="mustVerifyEmail" title="Registration Success">
        <div class="alert alert-success" role="alert">
          Please check your email inbox to verify your email address.
        </div>
      </card>
      <card v-else title="Register">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="mb-3">
            <div class="col-md-7">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name" class="border w-full p-3" type="text"
                     name="name">
              <has-error :form="form" field="name"/>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'border border-red rounded py-3 px-4 mb-3': form.errors.has('email') }" placeholder="E-Mail"
                     class="border w-full p-3" type="email" name="email">
              <has-error :form="form" field="email"/>
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'border border-red rounded py-3 px-4 mb-3': form.errors.has('password') }" placeholder="Password"
                     class="border w-full p-3" type="password" name="password">
              <has-error :form="form" field="password"/>
            </div>
          </div>


          <!-- Password Confirmation -->
          <div class="mb-3">
            <div class="col-md-7">
              <input v-model="form.password_confirmation" :class="{ 'border border-red rounded py-3 px-4 mb-3': form.errors.has('password_confirmation') }"
                     placeholder="Password Confirmation"
                     class="border w-full p-3" type="password" name="password_confirmation">
              <has-error :form="form" field="password_confirmation"/>
            </div>
          </div>


          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy" @click='register()'>
                register
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

export default {
  name: "Register",
  components: {},
  middleware: 'guest',
  metaInfo() {
    return {title: "Register"}
  },
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),
  props: {
    title: "Register"
  },
  methods: {
    async register() {
      // Register the user.
      const {data} = await this.form.post('/api/register')
      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        alert("Fail");
      }
    }
  }
}
</script>