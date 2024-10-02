import axios from 'axios'

import { useToast } from '@/Components/ui/toast/use-toast'
import { useOrderStore } from '@/Stores/orderStore'

export default async function getOrders() {
    // Stores
    const orderStore = useOrderStore()

    // Hooks
    const { toast } = useToast()

    try {
        const response = await axios.get('/orders/all/')
        orderStore.setOrders(response.data)
    } catch {
        toast({
            title: 'There was an issue when trying to fetch the orders.',
            variant: 'destructive',
        })
    }
    orderStore.setLoading(false)
}
