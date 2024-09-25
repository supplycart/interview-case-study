import { describe, it, expect } from 'vitest'
import { mount } from '@vue/test-utils'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

describe('MyComponent', () => {
    it('renders correctly', () => {
        const wrapper = mount(ApplicationLogo)
        expect(mount(ApplicationLogo)).toContain('')
    })
})
