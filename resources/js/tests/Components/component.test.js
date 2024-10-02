import { usePage } from '@inertiajs/vue3'
import { mount } from '@vue/test-utils'
import { createPinia, setActivePinia } from 'pinia'
import { describe, expect, it, vi } from 'vitest'

import Dashboard from '@/Pages/Dashboard.vue'

// Mock the usePage function and Head component
vi.mock('@inertiajs/vue3', () => ({
    usePage: vi.fn(),
    Head: {
        props: {},
        render: () => null,
    },
}))

describe('Dashboard.vue', () => {
    const pinia = createPinia()
    setActivePinia(pinia)

    it('renders the title with props', () => {
        // Example mock data for usePage
        usePage.mockReturnValue({
            props: {
                auth: {
                    user: { name: 'John Doe', age: 30 },
                },
            },
        })

        const wrapper = mount(Dashboard, {
            global: {
                plugins: [pinia],
            },
        })

        // Then check its text
        expect(wrapper.find('h3')).toBe('Products') // Adjust based on actual title
    })
})
