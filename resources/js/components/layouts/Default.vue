<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">Project</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'dashboard' }" class="nav-link"
                >Home</router-link
              >
            </li>
          </ul>
          <div class="d-flex">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  {{ authUser.name }}
                </a>
                <div
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  <a class="dropdown-item cursor-pointer" @click="profile">
                    Profile
                  </a>
                  <a class="dropdown-item cursor-pointer" @click="logout"
                    >Logout</a
                  >
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <main class="mt-3">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "default",
  computed: {
    authUser() {
      return this.$store.state.auth.user;
    },
  },
  methods: {
    ...mapActions({
      signOut: "auth/logout",
    }),
    async logout() {
      await axios.post("/logout").then(({ data }) => {
        this.signOut();
        this.$router.push({ name: "login" });
      });
    },
    profile() {
      this.$router.push("/profile");
    },
  },
};
</script>
<style scoped>
.cursor-pointer {
  cursor: pointer;
}
</style>
