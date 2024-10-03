import {defineStore} from "pinia";

export const checkoutStore = defineStore('proceedToCheckout', {
    state: () => ({
        proceedState: false,
        isPaying: false,
        proceedToCheckoutCopy: 'Proceed to Checkout',
        continueShoppingCopy: 'Continue Shopping'
    }),
    actions: {
        proceed() {
            this.proceedState = true;
            this.proceedToCheckoutCopy = 'Pay Now';
            this.continueShoppingCopy = 'Back to Cart';
        },
        payNow() {
            this.isPaying = true;
            this.proceedToCheckoutCopy = 'Paying...';
        },
        backToCart() {
            this.proceedState = false;
            this.isPaying = false;
            this.proceedToCheckoutCopy = 'Proceed to Checkout';
            this.continueShoppingCopy = 'Continue Shopping';
        }
    }
})
