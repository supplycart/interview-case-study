export enum CheckoutTypes {
  PENDING = 'pending',
  COMPLETED = 'completed',
}

export type CheckoutProduct = {
  id: number
  productTitle: string
  productImage: string
  productPrice: number
  quantity: number
  totalPrice: number
}

export type Checkout = {
  id: number
  status: CheckoutTypes
  price: number
  products: CheckoutProduct[]
}
