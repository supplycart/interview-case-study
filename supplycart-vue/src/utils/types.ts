export interface Product {
    id: number;
    name: string;
    price: number;
}
  
export type CartItem = Product;
  
export interface Order {
    items: CartItem[]; 
    date: string; 
}
  