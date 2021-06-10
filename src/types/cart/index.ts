export enum CartStatus {
  PENDING = 'pending',
  COMPLETED = 'completed',
  REMOVED = 'removed',
}

export type Cart = {
  status: CartStatus
  quantity: number
  productId: number
  productTitle: string
  productImage: string
  productPrice: number
  productDiscountPrice: number
  createdAt: string
}
