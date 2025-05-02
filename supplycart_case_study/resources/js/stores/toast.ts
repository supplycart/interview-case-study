import { defineStore } from 'pinia'

interface Toast {
  id: number
  message: string
  type: 'success' | 'error' | 'info' | 'warning'
}

export const useToastStore = defineStore('toast', {
  state: () => ({
    toasts: [] as Toast[],
  }),

  actions: {
    show(message: string, type: Toast['type'] = 'info') {
      const id = Date.now()
      this.toasts.push({ id, message, type })

      setTimeout(() => {
        this.toasts = this.toasts.filter(t => t.id !== id)
      }, 3000)
    },

    success(msg: string) {
      this.show(msg, 'success')
    },
    error(msg: string) {
      this.show(msg, 'error')
    },
    info(msg: string) {
      this.show(msg, 'info')
    },
    warning(msg: string) {
      this.show(msg, 'warning')
    },
  },
})
