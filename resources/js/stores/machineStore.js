import { defineStore } from 'pinia';
import axios from 'axios';

export const useMachineStore = defineStore('machine', {
    state: () => ({
        machines: [],
    }),
    actions: {
        fetchMachines() {
            return new Promise((resolve, reject) => {
                axios.get('/api/v1/machines')
                    .then(response => {
                        this.machines = response.data.payload;
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error fetching machines:', error);
                        reject(error);
                    });
            });
        },
    },
});
