import { ref } from 'vue'

const flashMessage = ref<string | null>(null)
const flashType = ref<'success' | 'error' | null>(null)

export function useFlash() {
  function success(message: string) {
    flashMessage.value = message
    flashType.value = 'success'

    setTimeout(() => {
      flashMessage.value = null
      flashType.value = null
    }, 2000)
  }

  return {
    flashMessage,
    flashType,
    success,
  }
}
