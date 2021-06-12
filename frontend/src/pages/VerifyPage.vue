<template>
  <div class="flex flex-col items-center p-4 text-center">
    <div v-if="userDetails">
      <div class="text-lg sm:text-xl font-bold">Hi {{ userDetails['fullName'] }}</div>
      <div>Thank you for registering!</div>
      <div>Please enter your verification code below</div>
      <input type="number" class="text-center" v-model="verificationCode">
      <div v-if="verifycodeError" class="text-red-500 mb-3">{{ verifycodeError }}</div>
      <button @click="verifyClicked">Verify</button>
    </div>
    <div v-else-if="loading">
      {{ loading }}
    </div>
    <div v-else>
      Sorry this page is unavailable.
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      userid: '',
      userDetails: null,
      verificationCode: '',
      verifycodeError: '',

      loading: 'Please wait'
    }
  },
  props: {
  },
  methods: {
    verifyClicked: async function() {
      this.verifycodeError = '';

      if (!this.verificationCode) {
        this.verifycodeError = 'Please enter your verification code';
        return;
      }

      let verify = (await this.$axios.get(`/Users/Verify?id=${this.userid}&code=${this.verificationCode}`)).data;
      if (verify) {
        await this.$swal({
          icon: 'success',
          title: 'Email Verified!',
          html: `Thank you ${this.userDetails['fullName']} for verifying your email address.`
        });

        this.$store.state.verified = null;
        this.$router.push('/');
      } else {
        await this.$swal({
          icon: 'error',
          title: 'Email not verified',
          html: `There was an error while verifying your email address.<br /><br />Please make sure the verification code matches the verification code sent to your email`
        });
      }
    }
  },
  async mounted() {
    this.userid = this.$route.params.id;
    this.userDetails = (await this.$axios.get(`/Users/GetUser?id=${this.userid}`)).data;

    this.loading = '';
  }
};
</script>

<style lang="scss" scoped>

</style>