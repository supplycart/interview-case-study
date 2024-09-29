export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
        categories: any[];
    };
    cart: Cart;
};

// interface for Product
export interface Product {
    id: number;
    name: string;
    price: number;
    description: string;
    image: string;
}

export type Cart = {
        count: number
        total: number
        items: any
        goods: any
}