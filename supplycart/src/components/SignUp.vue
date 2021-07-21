<template>
<div class="container ">
  <div class="flex h-full justify-center items-center ">
      <div class="box bg-gray-200 bg-opacity-90 w-5/12 rounded-lg shadow-lg">
        <div class="wrapper w-4/5">
            <h2 class="text-3xl font-serif">Sign Up</h2>
            <div class="input-area">
                <h3>Username</h3> 
                <input class="textbox rounded-lg bg-gray-100" type="text" placeholder="Username" height="20" width="50">
                <br>
                <br>
                <h3>Birth date</h3> 
                <input class="textbox rounded-lg bg-gray-100" type="date" placeholder="Birth date" height="20" width="50">
                <br>
                <br>
                <h3>Email</h3> 
                <input class="textbox rounded-lg bg-gray-100" type="email" placeholder="Email" height="20" width="50">
                <br>
                <br>
                <h3>Password</h3>
                <input class="textbox rounded-lg bg-gray-100" type="password" placeholder="Password" height="20" width="50">
            </div>
            <button class="mt-8 bg-gray-50 rounded-lg shadow-lg px-4 py-1 hover:bg-gray-300" @click="goToMain()">Create new account</button>
            <br>
            <br>
            <router-link to="/" class="underline text-blue-600">Go back</router-link>
        </div>
      </div>
      
  </div>
</div>
</template>

<script>
export default {
    name: "SignUp",
    methods: {
        goToMain(){
            this.$router.push({name:'Main'})
            console.log("signup success")
        }
    }
}
</script>

<style scoped>
/* .box {
    margin-top: 20px;
    position:relative;
    margin-bottom: 20px;
} */

.wrapper {
    text-align: center;
    margin: 5% auto 10%;
    /* padding: 20px; */
}

.input-area {
    text-align: left;
    margin-top: 30px;
    padding: 0px 20px;
}

.textbox {
    margin-top: 5px;
    height: 8vh;
    width: 100%;
}

.container {
    background: url('../assets/signin-page-bg.jpg');
    background-size: 100% 180%;
    background-position: bottom left;
    /* min-height: 100vh;
    height:auto; */
    padding-top: 20px;
    padding-bottom: 40px;
}

@media screen and (max-width: 800px) {
    .box{
        width:75%;
    }
}
</style>