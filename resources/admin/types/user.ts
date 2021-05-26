import { Model } from './model'

export class User extends Model {
  name: string
  email: string
  active: boolean
  role: string
  last_login_at: string
  created_at: string
  updated_at: string
  id: number
  toString() {
    return this.name
  }
}
