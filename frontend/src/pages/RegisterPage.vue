<template>
  <Form title="Create your account" class="m-3">
    <label for="">User ID</label>
    <input type="text" @blur="checkUserID" placeholder="User ID" v-model="userid">
    <div v-if="uidCheck" class="-mt-1 mb-2 ml-2 flex items-center whitespace-pre">
      <div v-if="uidCheck.split(' ')[0] == 'Checking'" class="animate-spin border-solid border-2 border-spin rounded-full h-4 w-4 mr-1"></div>
      {{ uidCheck }}
    </div>
    <div v-else-if="uidError" class="text-red-500 -mt-1 mb-2 ml-2">{{ uidError }}</div>

    <label for="">Email Address</label>
    <input type="email" placeholder="Email" v-model="email">
    <div v-if="emailError" class="text-red-500 -mt-1 mb-2 ml-2">{{ emailError }}</div>
    
    <label for="">Full Name</label>
    <input type="text" placeholder="Full Name" v-model="fName">
    <div v-if="fNameError" class="text-red-500 -mt-1 mb-2 ml-2">{{ fNameError }}</div>

    <label for="">User Type</label>
    <select v-model="userType">
      <option disabled>Select User Type</option>
      <option>Basic</option>
      <option>Advanced</option>
    </select>
    <div v-if="uTypeError" class="text-red-500 -mt-1 mb-2 ml-2">{{ uTypeError }}</div>

    <label for="">Password</label>
    <input type="password" placeholder="*********" v-model="pass">
    <div v-if="passError" class="text-red-500 -mt-1 mb-2 ml-2">{{ passError }}</div>

    <label for="">Re-enter password</label>
    <input type="password" placeholder="*********" v-model="pass2">
    <div v-if="pass2Error" class="text-red-500 -mt-1 mb-2 ml-2">{{ pass2Error }}</div>

    <button class="w-full" @click="registerClicked">Register</button>
    <button class="w-full mt-10" @click="$router.go('-1')">Back to Login</button>
  </Form>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      userid: '',
      email: '',
      fName: '',
      userType: '',
      pass: '',
      pass2: '',

      uidCheck: '',
      uidError: '',
      emailError: '',
      fNameError: '',
      uTypeError: '',
      passError: '',
      pass2Error: ''
    }
  },
  props: {
  },
  methods: {
    checkUserID: async function() {
      if (this.userid) {
        this.uidCheck = 'Checking User ID Availability . . .';

        let isAvailable = await this.$axios.get(`/Users/CheckUserIDAvailability?uid=${this.userid}`);
        if (isAvailable.data) {
          this.uidCheck = '✅\tUser ID is available';
        } else {
          this.uidCheck = '❌\tUser ID is unavailable';
        }
      } else {
        this.uidCheck = '';
      }
    },
    registerClicked: async function() {
      let hasError = false;
      this.clearError();

      if (!this.userid) {
        this.uidError = 'Please enter your User ID';
        hasError = true;
      }
      if (!this.email) {
        this.emailError = 'Please enter your User ID';
        hasError = true;
      }
      if (!this.fName) {
        this.fNameError = 'Please enter your User ID';
        hasError = true;
      }
      if (!this.userType) {
        this.uTypeError = 'Please enter your User ID';
        hasError = true;
      }
      if (!this.pass) {
        this.passError = 'Please enter your User ID';
        hasError = true;
      }
      if (!this.pass2) {
        this.pass2Error = 'Please enter your User ID';
        hasError = true;
      }

      if (!hasError) {
        if (this.pass == this.pass2) {
          console.log('create');
          let register = await this.$axios.post('/Users/Register', {
            userid: this.userid,
            email: this.email,
            fullname: this.fName,
            usertype: this.userType,
            password: this.pass,
            loginkey: ''
          }, {
            headers: {
              'Content-Type': 'application/json',
            }
          });
          
          if (register.data) {
            await this.$swal({
              icon: 'success',
              html: `Hi ${this.userid}!<br /><br />Your account has been created.<br />Please go back to login page and login using your new user id and password.`
            });
            this.$router.push('/');
          }
        } else {
          this.pass2Error = 'Please re enter the same password';
        }
      }
    },
    clearError: function() {
      this.uidError = '';
      this.emailError = '';
      this.fNameError = '';
      this.uTypeError = '';
      this.passError = '';
      this.pass2Error = '';
    }
  }
};
</script>

<style lang="scss" scoped>

</style>