<template>
  <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

        <div
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
              <ExclamationTriangleIcon class="size-6 text-red-600" aria-hidden="true"/>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold text-gray-900">Delete Machine</h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">Are you sure you want to Delete this Machine? All of your data will be
                  permanently removed from our servers forever. This action cannot be undone.</p>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <button type="button"
                    class="cursor-pointer inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                    @click="deleteMachine">Delete
            </button>
            <button type="button"
                    class="cursor-pointer mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                    @click="toggleForm">Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {ExclamationTriangleIcon} from '@heroicons/vue/24/outline'
import {ChevronDownIcon} from "@heroicons/vue/16/solid/index.js";
import {useMachineStore} from "../stores/machineStore.js";

export default {
  name: 'DeleteModal',
  components: {
    ChevronDownIcon,
    ExclamationTriangleIcon
  },

  props: {
    machineId: {
      type: Number,
      required: true
    }
  },
  mounted() {
    this.$nextTick(() => {

    });
  },
  methods: {
    toggleForm() {
      this.$emit('close');
    },
    deleteMachine() {
      const machineStore = useMachineStore();

      machineStore.deleteMachine(this.machineId)
          .then((response) => {
            this.$notify({type: "success", text: "Machine Deleted Successfully"});
            this.toggleForm();
          })
          .catch((error) => {
            console.error(error);
          });
    },
  }
}
</script>
