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
        //fetch machine by id
        fetchMachine(id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/v1/machines/${id}`)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error fetching machine:', error);
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
        //method for updating a machine
        updateMachine(id, data) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/v1/machines/${id}`, data)
                    .then(response => {
                        //update machines store with the updated machine
                        const index = this.machines.findIndex(machine => machine.id === id);
                        this.machines[index] = response.data.payload;
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error updating machine:', error);
                        reject(error);
                    });
            });
        },
        //method for updating a machine hours
        updateMachineHours(id, data) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/v1/machines/${id}/update-hours`, data)
                    .then(response => {
                        //update machines store with the updated machine
                        const index = this.machines.findIndex(machine => machine.id === id);
                        this.machines[index] = response.data.payload;
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error updating machine hours:', error);
                        reject(error);
                    });
            });
        },
        //method for deleting a machine
        deleteMachine(id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/v1/machines/${id}`)
                    .then(response => {
                        //remove the machine from the machines store
                        const index = this.machines.findIndex(machine => machine.id === id);
                        if (index !== -1) {
                            //remove the machine from the machines store
                            this.machines.splice(index, 1);
                        }

                        resolve(response);
                    })
                    .catch(error => {
                        console.error('Error deleting machine:', error);
                        reject(error);
                    });
            });
        },
    },
});
