import axios from 'axios'

import { useToast } from '@/Components/ui/toast'
import { useProductsStore } from '@/Stores/productStore'

export default async function getProducts(user_tier) {
    // Stores
    const productsStore = useProductsStore()

    // Hooks
    const { toast } = useToast()

    try {
        const response = await axios.get(`/products/get?user_tier=${user_tier}`)
        const products = response.data

        // Update product store with data
        productsStore.setProducts(products)
        productsStore.setQuantities(
            products.map((product) => (product.quantity <= 0 ? 0 : 1))
        )
        productsStore.setCategories([
            ...new Set(products.map((product) => product.product_category)),
        ])
        productsStore.setBrands([
            ...new Set(products.map((product) => product.product_brand)),
        ])
    } catch (error) {
        toast({
            title: 'There was an issue when trying to fetch the products.',
            variant: 'destructive',
        })
        console.error('Error fetching products:', error)
    } finally {
        productsStore.setLoading(false)
    }
}
