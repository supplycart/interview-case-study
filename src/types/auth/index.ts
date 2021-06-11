export type User = {
  id: number
  name: string
  email: string
  updatedAt: string
  createdAt: string
}

export type AccessToken = string

export type AuthData = {
  user: User
  accessToken: AccessToken
}

export type LoginCredentials = {
  email: string
  password: string
}

export type RegisterCredentials = {
  name: string
  email: string
  password: string
  passwordConfirmation: string
}
