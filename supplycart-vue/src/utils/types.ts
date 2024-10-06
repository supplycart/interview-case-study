// Product Interface
export interface Product {
    id: number;
    name: string;
    description?: string; // Optional: You can add a product description
    price: number;
    image_url?: string; // Optional: URL of the product image
    stock?: number; // Optional: Amount of stock available for this product
    created_at?: string; // Optional: For keeping track of product creation date
    updated_at?: string; // Optional: For keeping track of product update date
}

export type CartItem = Product;

// OrderItem should extend Product and include quantity
export interface OrderItem extends Product {
    quantity: number; // The quantity of the product in the order
}

// Order Interface
export interface Order {
    id: number; // Unique ID of the order
    user_id: number; // The ID of the user who placed the order
    items: OrderItem[]; // List of products in the order with quantities
    total_price: number; // Total price of the order
    status: string; // Status of the order (e.g., 'pending', 'completed', 'shipped')
    date: string; // Date when the order was placed
    created_at?: string; // Optional: Date when the order record was created
    updated_at?: string; // Optional: Date when the order record was updated
}
