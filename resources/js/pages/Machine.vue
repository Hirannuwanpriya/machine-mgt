<template>
  <header>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Machines</h1>
    </div>
  </header>
  <main>
    <div class="max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto"></div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
              <button @click="openMachineForm(-1)"
                      class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Create Machine</button>
            </div>
          </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                  <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Brand</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Reset Count</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                  <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-0">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="machine in machines.machines" :key="machine.id">
                  <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">{{ machine.id }}</td>
                  <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">{{ machine.name }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ useDateFormat(machine.purchase_date, 'DD/MM/YYYY') }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">{{ machine.category }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">{{ machine.brand }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">{{ machine.hours }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ machine.price }}</td>
                  <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-sm font-medium sm:pr-0 space-x-4">
<!--                    <RouterLink-->
<!--                        :to="{ name : 'machine.reset_timer' , params: { machineId : machine.id } }"-->
<!--                        class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-sky-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">-->
<!--                      Reset<span class="sr-only">, {{ machine.id }}</span>-->
<!--                    </RouterLink>-->
                    <button
                        @click.prevent="openMachineForm(machine.id)"
                        class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                      Edit<span class="sr-only">, {{ machine.id }}</span>
                    </button>
                    <button
                        @click.prevent="openDeleteModal(machine.id)"
                        class="cursor-pointer inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                      Delete
                    </button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <teleport to="body">

    <MachineForm v-if="showMachineForm"  :machineId="selectedMachineId"
                 @close="showMachineForm = false"/>

    <DeleteModal v-if="showDeleteModal" :machineId="selectedMachineId"
                 @close="showDeleteModal = false"/>
  </teleport>

</template>

<script>
import { useMachineStore } from '../stores/machineStore';
import {nextTick, onMounted} from 'vue';
import MachineForm from "../components/MachineForm.vue";
import DeleteModal from "../components/DeleteModal.vue";
import { useDateFormat } from '@vueuse/core';

export default {
  name: 'Machine',
  setup() {
    const machineStore = useMachineStore();

    onMounted(() => {
       machineStore.fetchMachines();
    });

    return {
      machines : machineStore,
      useDateFormat
    }
  },
  components: {
    MachineForm,
    DeleteModal
  },
  data() {
    return {
      open: false,
      showMachineForm: false,
      showDeleteModal: false,
      selectedMachineId: null
    }
  },
  methods: {
    openMachineForm(machineId) {
      this.selectedMachineId = machineId;
      this.showMachineForm = true;
    },
    openDeleteModal(machineId) {
      this.selectedMachineId = machineId;
      this.showDeleteModal = true;
    }
  }
}
</script>

<style scoped>

</style>
