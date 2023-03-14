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
                  type="text"
                  v-model="user.firstName"
                  class="form-control"
                  placeholder="Example"
                />
              </div>
              <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input
                  type="text"
                  v-model="user.lastName"
                  class="form-control"
                  placeholder="John"
                />
              </div>
              <div class="col-12">
                <label for="email">Email</label>
                <input
                  type="email"
                  v-model="user.email"
                  class="form-control"
                  placeholder="example.john@cat.com"
                />
              </div>
              <div class="col-md-3">
                <label for="zipCode">Zip code</label>
                <input
                  type="number"
                  v-model="user.zipCode.zipCode"
                  class="form-control"
                  placeholder="1000"
                />
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
                  type="text"
                  v-model="user.address"
                  class="form-control"
                  placeholder="Széchenyi tér 1"
                />
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
export default {
  name: "profile",
  data() {
    return {
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
      authUser: this.$store.state.auth.user,
    };
  },
  methods: {
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
        });
    },
  },
  created() {
    axios.get(`api/user/${this.authUser.id}`).then(({ data }) => {
      this.user = data.data;
    });
  },
  watch: {
    "user.zipCode.zipCode": function (val) {
      if (val && val.toString().length === 4) {
        axios
          .get(`api/zip-code/${val}`)
          .then(({ data }) => {
            this.user.zipCode = data.data;
          })
          .catch(({ response }) => {
            if (response.status === 404) {
              // TODO ERROR handling
            } else {
              console.log($response);
            }
          });
      }
    },
  },
};
</script>

<style>
</style>