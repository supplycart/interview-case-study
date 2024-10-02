import axios from 'axios'

import { useToast } from '@/Components/ui/toast/use-toast'

import getCart from './getCart'

export default async function addToCart(productId, quantity = 1) {
    // Hooks
    const { toast } = useToast()

    try {
        const _response = await axios.post(`/cart/add/${productId}`, {
            quantity: quantity || 1,
        })
        toast({
            title: 'Product added to cart successfully',
        })
    } catch {
        toast({
            title: 'Failed to add product to cart',
            variant: 'destructive',
        })
    } finally {
        getCart()
    }
}
