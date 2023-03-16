<template>
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-body">
            <h1 class="text-center">Profile</h1>
            <hr />
            <form @submit.prevent="updateProfile" class="row g-2">
              <div class="col-md-6">
                <label for="firstName">First Name</label>
                <input
                  id="firstName-input"
                  type="text"
                  v-model="user.firstName"
                  class="form-control"
                  placeholder="Example"
                />
                <div id="firstName-invalid" class="invalid-feedback"></div>
              </div>
              <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input
                  id="lastName-input"
                  type="text"
                  v-model="user.lastName"
                  class="form-control"
                  placeholder="John"
                />
                <div id="lastName-invalid" class="invalid-feedback"></div>
              </div>
              <div class="col-12">
                <label for="email">Email</label>
                <input
                  id="email-input"
                  type="email"
                  v-model="user.email"
                  class="form-control"
                  placeholder="example.john@cat.com"
                />
                <div id="email-invalid" class="invalid-feedback"></div>
              </div>
              <div class="col-md-3">
                <label for="zipCode">Zip code</label>
                <input
                  id="zipCode-input"
                  type="text"
                  pattern="[0-9]{4}"
                  v-model="user.zipCode.zipCode"
                  :class="{
                    'is-valid': zipCodeInput.isValid,
                    'is-invalid': zipCodeInput.isError,
                  }"
                  class="form-control"
                  placeholder="1000"
                />
                <div id="zipCode-invalid" class="invalid-feedback">
                  Please provide a valid zip.
                </div>
              </div>
              <div class="col-md-4 offset-md-1">
                <label for="city">City</label>
                <input
                  disabled
                  type="text"
                  v-model="user.zipCode.city"
                  class="form-control"
                  placeholder="Szeged"
                />
              </div>
              <div class="col-md-3 offset-md-1">
                <label for="county">County</label>
                <input
                  disabled
                  type="text"
                  v-model="user.zipCode.county"
                  class="form-control"
                  placeholder="Csongrád-Csanád vármegye"
                />
              </div>
              <div class="col-12">
                <label for="address">Address</label>
                <input
                  id="address-input"
                  type="text"
                  v-model="user.address"
                  class="form-control"
                  placeholder="Széchenyi tér 1"
                />
                <div id="address-invalid" class="invalid-feedback"></div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {
  name: "profile",
  data() {
    return {
      zipCodeInput: {
        isValid: false,
        isError: false,
      },
      user: {
        address: "",
        firstName: "",
        lastName: "",
        email: "",
        zipCode: {
          county: "",
          zipCode: "",
          city: "",
        },
      },
    };
  },
  computed: {
    authUser() {
      return this.$store.state.auth.user;
    },
  },
  methods: {
    ...mapMutations({
      setUser: "auth/SET_USER",
    }),
    updateProfile() {
      axios
        .put(`api/user/${this.authUser.id}`, {
          address: this.user.address,
          firstName: this.user.firstName,
          email: this.user.email,
          lastName: this.user.lastName,
          zipCodeId: this.user.zipCode.id,
        })
        .then(({ data }) => {
          this.user = data.data;
          this.setUser({
            id: this.user.id,
            email: this.user.email,
            first_name: this.user.firstName,
            last_name: this.user.lastName,
          });
        })
        .catch(({ response }) => {
          if (response.status === 422) {
            this.showErrors(response.data);
          } else {
            console.error(response);
          }
        });
    },
    showErrors: function (error) {
      for (const [field, message] of Object.entries(error.errors)) {
        const input = document.getElementById(field + "-input");
        const invalid = document.getElementById(field + "-invalid");
        invalid.innerHTML = message;
        input.classList.add("is-invalid");
      }
    },
  },
  created() {
    axios.get(`api/user/${this.authUser.id}`).then(({ data }) => {
      this.user = data.data;
    });
  },
  watch: {
    "user.zipCode.zipCode": function (val) {
      if (val && val.length === 4) {
        axios
          .get(`api/zip-code/${val}`)
          .then(({ data }) => {
            this.user.zipCode = data.data;
            this.zipCodeInput.isError = false;
            this.zipCodeInput.isValid = true;
          })
          .catch(({ response }) => {
            if (response.status === 404) {
              this.zipCodeInput.isError = true;
              this.zipCodeInput.isValid = false;
              this.user.zipCode.city = "";
              this.user.zipCode.county = "";
            } else {
              console.error(response);
            }
          });
      } else {
        this.user.zipCode.city = "";
        this.user.zipCode.county = "";
        this.zipCodeInput.isError = false;
        this.zipCodeInput.isValid = false;
      }
    },
  },
};
</script>

<style>
</style>