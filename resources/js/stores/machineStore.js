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
                        this.machines = response.data.payload.data;
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error fetching machines:', error);
                        reject(error);
                    });
            });
        },
        //method for creating a new machine
        createMachine(data) {
            return new Promise((resolve, reject) => {
                axios.post('/api/v1/machines', data)
                    .then(response => {
                        //update machines store with the new machine
                        this.machines.push(response.data.payload);
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error creating machine:', error);
                        reject(error);
                    });
            });
        },
    },
});
