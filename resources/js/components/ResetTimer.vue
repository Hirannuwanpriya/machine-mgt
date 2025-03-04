<template>
  <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

        <div
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
            <button type="button" @click="toggleForm" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <form v-on:submit.prevent="resetTimer">
            <div class="space-y-6 sm:space-y-16">
              <p class="text-base font-semibold text-gray-900">Reset Machine Timer</p>
              <div
                  class="mt-10 space-y-8 border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                  <label for="date" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Date</label>
                  <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input v-model="machinesDate" type="date" name="date" id="date" autocomplete="date"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                  </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                  <label for="hours" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Hours</label>
                  <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input v-model="machinesTime"  type="text" name="hours" id="hours" autocomplete="hours"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"/>
                  </div>
                </div>

                <div class="sm:grid sm:items-center sm:py-6">
                  <button type="button" @click="addTimer"
                          class="flex w-1/4 mx-auto justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add
                  </button>
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
                <tr v-for="timer in timers" :key="timer.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{
                      timer.date
                    }}
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ timer.hours }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <a v-if="timer.reset" href="#" class="text-indigo-600 hover:text-indigo-900">Reset
                      <span class="sr-only">{{ timer.date }}</span></a>
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
import { useDateFormat } from '@vueuse/core';

const today = new Date();

export default {
  name: 'ResetTimer',
  components: {
    ChevronDownIcon,
  },
  data() {
    return {
      modalVisible: false,
      machineId: null,
      machinesDate: today,
      machinesTime: 0,
      timers: [
        {
          date: useDateFormat(today, 'DD/MM/YYYY'),
          hours: 0,
          reset: true
        },
      ]
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
    addTimer() {
      const machineStore = useMachineStore();

      //do the add timer logic here
      //push to timers array
      this.timers.push({
        date: useDateFormat(this.machinesDate, 'DD/MM/YYYY'),
        hours: this.machinesTime,
        reset: false
      });
    },
    resetTimer() {
      //do the reset timer logic here
    },
  }
}
</script>

<style scoped>

</style>
