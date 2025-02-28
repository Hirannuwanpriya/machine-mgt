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
                    <label for="category" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Model</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <div class="grid grid-cols-1 sm:max-w-xs">
                        <select v-model="machine.category" id="category" name="category" autocomplete="model-name"
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
                    <label for="purchase_date" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Date</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                      <input v-model="machine.purchase_date" type="date" name="purchase_date" id="purchase_date" autocomplete="purchase-date"
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
import {required} from '@vuelidate/validators';
import {useMachineStore} from "../stores/machineStore.js";

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
      isEditing: false,
      machineId: null,
      machine: {
        name: '',
        category: '',
        brand: '',
        purchase_date: '',
        price: ''
      }
    }
  },
  validations() {
    return {
      machine: {
        name: {required},
        category: {required},
        brand: {required},
        purchase_date: {required},
        price: {required}
      }
    }
  },
  mounted() {
    this.formVisible = !this.formVisible;

    this.$nextTick(() => {
      //get route params
      this.parentPath = this.getParentUrl(this.$route.matched, 'machine.edit', {machineId: this.$route.params.machineId});
      //check router is edit or create
      if(this.parentPath.name === 'machine.edit') {
        this.isEditing = true;
        this.machineId = this.$route.params.machineId;

        //fetch machine data
        const machineStore = useMachineStore();
        machineStore.fetchMachine(this.machineId)
            .then((response) => {
              this.machine = response.data.payload;
              this.machine.purchase_date = new Date(this.machine.purchase_date).toISOString().split('T')[0];
            })
            .catch((error) => {
              console.error(error);
            });
      }
    });
  },
  methods: {
    isInError(machine) {
      return this.v$.$errors && this.v$.$errors.find(element => element.$propertyPath === machine)
    },
    toggleForm() {
      this.formVisible = !this.formVisible;

      this.$router.push({name: 'machines.index'});
    },
    saveForm() {
      this.v$.$validate().then((valid) => {

        if (!valid) {
          return;
        }
        //set api data
        let formData = {
          name: this.machine.name,
          category: this.machine.category,
          brand: this.machine.brand,
          purchase_date: this.machine.purchase_date,
          price: this.machine.price
        };
        //call api to save machine
        const machineStore = useMachineStore();

        if(this.isEditing && this.machineId) {
          machineStore.updateMachine(this.machineId, formData)
              .then((response) => {
                this.$notify({type: "success", text: "Machine Updated"});
                this.toggleForm();
              })
              .catch((error) => {
                console.error(error);
              });

        } else {
          machineStore.createMachine(formData)
              .then((response) => {
                this.$notify({type: "success", text: "Machine Created"});
                this.toggleForm();
              })
              .catch((error) => {
                console.error(error);
              });
        }
      });
    },
    getParentUrl(route, name, id) {
      let routeHistory = route.slice(0, -1);
      if (Array.isArray(routeHistory)) {
        if (routeHistory[0].name === name + '.show') {
          return { name: `${name}.show`, params: id };
        }
      }
      return { name: name };
    }
  }
}
</script>

<style scoped>

</style>
