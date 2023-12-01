import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
    state() {
        return {
            dialog: false,
            snackbar: false
        }
    },

    actions: {
        closeOpen() {
            this.dialog = false;
            this.snackbar = true
        },
        close() {
            this.dialog = false;
            this.snackbar = false
        }
    },

    getters: {

    }
})