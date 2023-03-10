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
                  v-model="firstName"
                  class="form-control"
                  placeholder="Example"
                />
              </div>
              <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input
                  type="text"
                  v-model="lastName"
                  class="form-control"
                  placeholder="John"
                />
              </div>
              <div class="col-12">
                <label for="email">Email</label>
                <input
                  type="email"
                  v-model="email"
                  class="form-control"
                  placeholder="example.john@cat.com"
                />
              </div>
              <div class="col-md-4">
                <label for="city">City</label>
                <input
                  type="text"
                  v-model="city"
                  class="form-control"
                  placeholder="Szeged"
                />
              </div>
              <div class="col-md-3 offset-md-1">
                <label for="county">County</label>
                <input
                  type="text"
                  v-model="county"
                  class="form-control"
                  placeholder="Csongrád-Csanád vármegye"
                />
              </div>
              <div class="col-md-3 offset-md-1">
                <label for="zipCode">Zip code</label>
                <input
                  type="number"
                  v-model="zipCode"
                  class="form-control"
                  placeholder="1000"
                />
              </div>
              <div class="col-12">
                <label for="address">Address</label>
                <input
                  type="text"
                  v-model="address"
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
      firstName: "",
      lastName: "",
      email: "",
      city: "",
      county: "",
      zipCode: "",
      address: "",
    };
  },
  methods: {
    updateProfile() {},
  },
};
</script>

<style>
</style>