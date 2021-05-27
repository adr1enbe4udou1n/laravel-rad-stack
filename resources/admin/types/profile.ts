import { Model } from './model'

export class Profile extends Model {
  id: number
  name: string
  email: string
  is_impersonating: boolean
  toString() {
    return this.name
  }
}
