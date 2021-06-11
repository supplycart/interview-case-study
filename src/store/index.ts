import { InjectionKey } from 'vue'
import {
  createStore,
  createLogger,
  useStore as VuexUseStore,
  Store as VuexStore,
} from 'vuex'
// eslint-disable-next-line import/no-cycle
import {
  store as auth,
  AuthStore,
  State as AuthState,
} from '@/store/modules/auth'
// eslint-disable-next-line import/no-cycle
import {
  store as notification,
  NotificationStore,
  State as NotificationState,
} from '@/store/modules/notification'
// eslint-disable-next-line import/no-cycle
import {
  store as product,
  ProductStore,
  State as ProductState,
} from '@/store/modules/products'
// eslint-disable-next-line import/no-cycle
import {
  store as cart,
  CartStore,
  State as CartState,
} from '@/store/modules/cart'
// eslint-disable-next-line import/no-cycle
import {
  store as checkout,
  CheckoutStore,
  State as CheckoutState,
} from '@/store/modules/checkout'

import createPersistedState from 'vuex-persistedstate'

export type RootState = {
  notification: NotificationState
  auth: AuthState
  product: ProductState
  cart: CartState
  checkout: CheckoutState
}

export type Store = AuthStore<Pick<RootState, 'auth'>> &
  NotificationStore<Pick<RootState, 'notification'>> &
  ProductStore<Pick<RootState, 'product'>> &
  CartStore<Pick<RootState, 'cart'>> &
  CheckoutStore<Pick<RootState, 'checkout'>>

// Plug in logger when in development environment
const debug = 'production'
const plugins = debug ? [createLogger({})] : []

// Plug in session storage based persistence
plugins.push(createPersistedState({ storage: window.sessionStorage }))

export const key: InjectionKey<VuexStore<RootState>> = Symbol('vuex')
export const store = createStore({
  plugins,
  modules: {
    auth,
    notification,
    product,
    cart,
    checkout,
  },
})

export function useStore(): Store {
  return VuexUseStore(key) as Store
}
