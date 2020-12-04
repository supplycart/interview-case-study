<template>
  <div class="w-full flex flex-wrap">

    <!-- Register Section -->
    <div class="w-full md:w-1/2 flex flex-col">

      <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-12">
        <a href="#" class="bg-black text-white font-bold text-xl p-4">Logo</a>
      </div>

      <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
        <p class="text-center text-3xl">Join Us.</p>
        <form class="flex flex-col pt-3 md:pt-8">
          <div class="flex flex-col pt-4">
            <label for="name" class="text-lg">Name</label>
            <input v-model="name" type="text" placeholder="Name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="name">
          </div>

          <div class="flex flex-col pt-4">
            <label for="email" class="text-lg">Email</label>
            <input v-model="email" type="email" placeholder="your@email.com" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="email">
          </div>

          <div class="flex flex-col pt-4">
            <label for="password" class="text-lg">Password</label>
            <input v-model="password" type="password" placeholder="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="password">
          </div>

          <div class="flex flex-col pt-4">
            <label for="confirm-password" class="text-lg">Confirm Password</label>
            <input v-model="password_confirmation" type="password" placeholder="Confirm password" id="confirm-password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation">
          </div>
          <p id="text" style="color:green; margin-left:100px;">{{output}}</p>
          <input type="submit" value="Register" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8" @click="handleSubmit">
        </form>
        <div class="text-center pt-12 pb-12">
          <p>Already have an account? <a href="/login" class="underline font-semibold">Log in here.</a></p>
        </div>
      </div>
    </div>

    <!-- Image Section -->
    <div class="w-1/2 shadow-2xl">
      <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/IXUM4cJynP0">
    </div>
  </div>
</template>


<script>
export default {
  props : ['nextUrl'],
  data(){
    return {
      name : "",
      email : "",
      password : "",
      password_confirmation : "",
      output: ""
    }
  },
  methods : {
    handleSubmit(e) {
      e.preventDefault()
      let currentObj = this;
      if (this.password === this.password_confirmation && this.password.length > 0)
      {
        axios.post('auth/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation : this.password_confirmation
        })
            .then(response => {
              if(response.data.error === true) {
                currentObj.output = 'Registration failed!';
              } else {
                currentObj.output = 'Registration Successful!';
              }
            })
            .catch(error => {
              console.error(error);
            });
      } else {
        this.password = ""
        this.passwordConfirm = ""

        return alert('Passwords do not match')
      }
    }
  }
}
</script>