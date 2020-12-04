<template>

</template>

<script>
export default {
  data(){
    return {
      email : "",
      password : "",
      output:""
    }
  },
  methods : {
    handleSubmit(e){
      e.preventDefault()
      let currentObj = this;
      if (this.password.length > 0) {
        axios.post('auth/login', {
          email: this.email,
          password: this.password
        })
            .then(response => {
              if(response.data.error === true) {
                currentObj.output = 'login failed!';
              } else {
                currentObj.output = 'login Successful!';
                localStorage.setItem('user',response.data.data.user_data.name)
                localStorage.setItem('access_token',response.data.data.token_data.accessToken)

                if (localStorage.getItem('access_token') != null){
                  this.$emit('loggedIn')
                  if(this.$route.params.nextUrl != null){
                    this.$router.push(this.$route.params.nextUrl)
                  } else {
                    this.$router.push('/')
                  }
                }
              }
            })
            .catch(function (error) {
              console.error(error);
            });
      }
    }
  },
}
</script>