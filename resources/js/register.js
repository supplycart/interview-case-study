const register = new Vue({
    el: '#register',
    data: {
      password: '',
      password2: '',
      invalidPass: false
    },
    methods: {
      validatePassword: function () {
        if(this.password2 != '')
            this.invalidPass = (this.password != this.password2)
      }
    },
  });
  