import axios from 'axios'

import { useToast } from '@/Components/ui/toast/use-toast'
import { useCartStore } from '@/Stores/cartStore'

export default async function getCart() {
    // Stores
    const cartStore = useCartStore()

    // Hooks
    const { toast } = useToast()

    try {
        const response = await axios.get('/cart/')
        cartStore.setCart(response.data)
    } catch {
        toast({
            title: 'There was an issue when trying to fetch the cart.',
            variant: 'destructive',
        })
    }
}
