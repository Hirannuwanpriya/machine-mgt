<template>
  <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Machine Mgt</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
      <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
        <form class="space-y-6" @submit.prevent="handleSubmit" method="POST">
          <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
              <input v-model="email" type="email" name="email" id="email" autocomplete="email"
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
              <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email }}</p>
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
            <div class="mt-2">
              <input v-model="password" type="password" name="password" id="password" autocomplete="current-password"
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
              <p v-if="errors.password" class="mt-2 text-sm text-red-600">{{ errors.password }}</p>
            </div>
          </div>
          <div>
            <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useAuthStore } from '../auth';
import { useRouter } from 'vue-router';

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      errors: {
        email: "",
        password: ""
      }
    };
  },
  mounted() {
    this.$nextTick(() => {
      console.log("Login component mounted.");
    });
  },
  methods: {
    validateFields() {
      this.errors.email = "";
      this.errors.password = "";

      let isValid = true;

      if (!this.email) {
        this.errors.email = 'Email is required';
        isValid = false;
      }

      if (!this.password) {
        this.errors.password = 'Password is required';
        isValid = false;
      }
      return isValid;
    },
    async handleSubmit() {

      if (this.validateFields()) {

        const authStore = useAuthStore();
        const router = useRouter();

        await axios.post('/api/v1/login', {
          email: this.email,
          password: this.password
        }).then(response => {
          const token = response.data.payload.token;
          // get user token and set it into authStore
          authStore.setToken(token);
          //redirect to machines list page
          router.push({ name: 'machines' });
        }).catch(error => {
          console.error('Login failed:', error);
        });
      }
    },
  },


}


</script>
