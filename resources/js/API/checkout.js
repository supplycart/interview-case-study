import axios from 'axios'

import { useToast } from '@/Components/ui/toast'

import getCart from './getCart'

export default async function checkout() {
    // Hooks
    const { toast } = useToast()

    try {
        const _response = await axios.post('/cart/checkout')
        toast({
            title: 'Everything looks good, expect to have your items soon.',
            description: 'Redirecting you to the orders page...',
        })
    } catch {
        toast({
            title: 'There was an issue when trying to checkout.',
            variant: 'destructive',
        })
    } finally {
        getCart()
        setTimeout(() => (window.location.href = '/orders'), [2000])
    }
}
