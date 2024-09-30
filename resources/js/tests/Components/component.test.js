import { mount } from '@vue/test-utils'
import { describe, expect, it } from 'vitest'

import ApplicationLogo from '@/Components/ApplicationLogo.vue'

describe('MyComponent', () => {
    it('renders correctly', () => {
        const wrapper = mount(ApplicationLogo)
        expect(mount(ApplicationLogo)).toContain('')
    })
})
