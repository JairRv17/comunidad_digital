<template>
  <div class="login">
    <h1>Login</h1>
    <input
      type="email"
      name="email"
      placeholder="alguien@example.com"
      required="required"
      v-model="form.email"
    />
    <input
      type="password"
      name="password"
      placeholder="contraseña"
      required="required"
      v-model="form.password"
    />
    <span class="helper-text text-danger" slot="helper"> </span>
    <span class="helper-text text-danger" slot="helper"> </span>
    <br /><br />
    <button
      type="submit"
      class="btn btn-primary btn-block btn-large"
      @click="login"
    >
      Ingresar
    </button>
    <br />
    <button type="submit" class="btn btn-primary btn-block btn-large">
      Registrar
    </button>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      url: "http://127.0.0.1:8000/api/",
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login: function () {
      axios
        .post(this.url + "login", this.form)
        .then(({ data }) => {
          console.log(data);
        })
        .catch( E => {
          swal.fire({
            title: "Credenciales no válidas!",
            text: "Error",
            icon: "error",
            confirmButtonText: "Ok",
          });
        });
    },
  },
  mounted() {},
};
</script>
