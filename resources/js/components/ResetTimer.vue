<template>
  <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

        <div
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
            <button type="button" @click="toggleForm"
                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                   aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <form v-on:submit.prevent="resetTimer">
            <div class="space-y-6">
              <p class="text-base font-semibold text-gray-900">Reset Machine Timer</p>
              <div
                  class="space-y-8 border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                  <label for="date" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Date</label>
                  <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input v-model="formattedDate" type="date" name="date" id="date" autocomplete="date"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                  </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                  <label for="hours" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Hours</label>
                  <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input v-model="timer.hours" type="text" name="hours" id="hours" autocomplete="hours"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                  </div>
                </div>

                <div class="flex justify-end sm:py-6 space-x-8">
                  <button type="button" @click="addTimer"
                          class="cursor-pointer w-1/4 rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add
                  </button>
                  <div class=" w-1/4">
                    <button v-if="resetTimer.hours > 0" type="button" @click="resetCount"
                            class="cursor-pointer rounded-md px-3 py-1.5 text-sm/6 font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                      Reset Count
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Date
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hrs</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                    <span class="sr-only"></span>
                  </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <tr>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                    {{ resetTimer.timer_date ? useDateFormat(resetTimer.timer_date, 'DD/MM/YYYY') : '-' }}
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ resetTimer.hours }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button v-if="resetTimer.hours !== 0" @click="resetCount" class="cursor-pointer  text-indigo-600 hover:text-indigo-900">Reset</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import {ChevronDownIcon} from "@heroicons/vue/16/solid/index.js";
import {useMachineStore} from "../stores/machineStore.js";
import {useDateFormat, useNow} from '@vueuse/core';

const today = useDateFormat(useNow(), 'YYYY-MM-DD', {locales: 'en-US'})

export default {
  name: 'ResetTimer',
  setup() {
    return {
      useDateFormat
    }
  },
  components: {
    ChevronDownIcon,
  },
  computed: {
    formattedDate: {
      get() {
        return this.timer.timer_date;
      },
      set(value) {
        this.timer.timer_date = value.toString();
      }
    }
  },
  props: {
    machineId: {
      type: Number,
      required: true
    },
    resetTimer: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      timer: {
        timer_date: '',
        hours: 0
      }
    }
  },
  mounted() {

    this.$nextTick(() => {
      this.timer.timer_date = today.value;
      this.timer.hours = this.resetTimer.hours;
    });
  },
  methods: {
    toggleForm() {
      this.$emit('close');
    },
    addTimer() {

      //check if the hours is greater than 0
      if (this.timer.hours <= 0) {
        this.$notify({type: "error", text: "Hours must be greater than 0"});
        return;
      }

      //adding the new timer to the machine timer
      if (this.timer.hours > 0) {
          if(this.checkDuplicates() === -1) {
            return;
          }
      } else {
          this.$notify({ type: "error", text: "Hours must be integers and not less than 0" });
        return;
      }

      const machineStore = useMachineStore();
      //add the timer to the machine
      machineStore.updateMachineHours(this.machineId, this.timer)
          .then((response) => {
            //update resetTimer with new values
            this.resetTimer.hours = this.timer.hours;
            this.resetTimer.timer_date = this.timer.timer_date;

            this.$notify({type: "success", text: "Machine Hours Updated"});
          })
          .catch((error) => {
            this.$notify({type: "error", text: error});
          });
    },
    resetCount() {
      this.timer.hours = 0;

      const machineStore = useMachineStore();
      //add the timer to the machine
      machineStore.updateMachineHours(this.machineId, this.timer)
          .then((response) => {
            this.timer = {
              hours: response.data.payload.hours
            }

            this.resetTimer.hours = this.timer.hours;

            this.$notify({type: "success", text: "Machine Hours Updated"});
          })
          .catch((error) => {
            this.$notify({type: "error", text: error});
          });

    },
    checkDuplicates() {
      //parse the hours to integers
      let new_hours = parseInt(this.timer.hours);
      let timer_hours = parseInt(this.resetTimer.hours);

      //check new hours is equal to the current hours in same day
      if((this.resetTimer.timer_date === this.timer.timer_date) && (new_hours === timer_hours)) {
        this.$notify({type: "error", text: "This timer already exists"});
        return -1;
      } else {
        this.timer.hours = timer_hours + new_hours;
        return 1;
      }
    }
  }
}
</script>

<style scoped>

</style>
