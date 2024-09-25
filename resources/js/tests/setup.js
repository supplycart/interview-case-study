// setup.js
import { beforeEach, afterEach } from 'vitest'
import { setActivePinia, createPinia } from 'pinia'
import { createApp } from 'vue'
import { cleanup } from '@testing-library/vue'

// Mocking localStorage
global.localStorage = {
    getItem: (key) => null,
    setItem: (key, value) => {},
    removeItem: (key) => {},
    clear: () => {},
}

// Mocking sessionStorage
global.sessionStorage = {
    getItem: (key) => null,
    setItem: (key, value) => {},
    removeItem: (key) => {},
    clear: () => {},
}

// Create a new Vue app instance before each test
beforeEach(() => {
    const app = createApp({})

    // Set up Pinia
    setActivePinia(createPinia())

    // Mount the app if needed
    // e.g., app.mount('#app');
})

// Clean up after each test to ensure a fresh state
afterEach(() => {
    cleanup()
})

// Utility function to create a wrapper for component testing
global.createWrapper = (component, props = {}) => {
    const { mount } = require('@vue/test-utils')
    return mount(component, { props })
}
