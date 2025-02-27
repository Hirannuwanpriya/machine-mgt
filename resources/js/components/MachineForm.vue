<template>
  <div v-if="formVisible" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
          <form v-on:submit.prevent="saveForm">
            <div>
              <div class="space-y-6 sm:space-y-16">
                <p class="text-base font-semibold text-gray-900">Add New Machine</p>
                <div
                    class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                  <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Name</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <input v-model="machine.name" type="text" name="name" id="name" autocomplete="name"
                             class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                      <p class="mt-2 text-sm text-red-600" v-if="isInError('machine.name')">Name Required</p>
                    </div>
                  </div>

                  <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="model" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Model</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <div class="grid grid-cols-1 sm:max-w-xs">
                        <select v-model="machine.model" id="model" name="model" autocomplete="model-name"
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="0">Select Model</option>
                          <option value="1">Model 01</option>
                          <option value="2">Model 02</option>
                          <option value="3">Model 03</option>
                          <option value="4">Model 04</option>
                        </select>
                        <ChevronDownIcon
                            class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            aria-hidden="true"/>
                      </div>
                      <p class="mt-2 text-sm text-red-600" v-if="isInError('machine.model')">Model Required</p>
                    </div>
                  </div>

                  <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="brand" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Brand</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <div class="grid grid-cols-1 sm:max-w-xs">
                        <select v-model="machine.brand" id="brand" name="brand" autocomplete="brand-name"
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="0">Select Brand</option>
                          <option value="1">Brand 01</option>
                          <option value="2">Brand 02</option>
                          <option value="3">Brand 03</option>
                          <option value="4">Brand 04</option>
                        </select>
                        <ChevronDownIcon
                            class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            aria-hidden="true"/>
                      </div>
                      <p class="mt-2 text-sm text-red-600" v-if="isInError('machine.brand')">Brand Required</p>
                    </div>
                  </div>

                  <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="date" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Date</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <input v-model="machine.date" type="date" name="date" id="date" autocomplete="date"
                             class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                      <p class="mt-2 text-sm text-red-600" v-if="isInError('machine.date')">Date Required</p>
                    </div>
                  </div>

                  <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="price" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Price</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <input v-model="machine.price" id="price" name="price" type="text" autocomplete="price"
                             class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"/>
                      <p class="mt-2 text-sm text-red-600" v-if="isInError('machine.price')">Price Required</p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <button type="submit"
                      class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">
                Save
              </button>
              <button type="button"
                      class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                      @click="toggleForm">Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {ChevronDownIcon} from '@heroicons/vue/16/solid'
import {useVuelidate} from "@vuelidate/core";
import { required } from '@vuelidate/validators';

export default {
  name: 'MachineForm',
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  components: {
    ChevronDownIcon
  },
  data() {
    return {
      formVisible: false,
      machine: {
        name: '',
        model: '',
        brand: '',
        date: '',
        price: ''
      }
    }
  },
  validations () {
    return {
      machine: {
        name: {required},
        model: {required},
        brand: {required},
        date: {required},
        price: {required}
      }
    }
  },
  mounted() {
    this.formVisible = !this.formVisible;
  },
  methods: {
    isInError(machine) {
      return this.v$.$errors && this.v$.$errors.find(element => element.$propertyPath === machine)
    },
    toggleForm() {
      this.formVisible = !this.formVisible;
      this.$parent.toggleMachineForm();
    },
    saveForm() {
      this.v$.$validate().then((valid) => {

        if (!valid) {
          return;
        }


        // Handle form submission logic
        console.log('Form submitted', this.machine);
        this.toggleForm();
      });
    }
  }
}
</script>

<style scoped>

</style>
