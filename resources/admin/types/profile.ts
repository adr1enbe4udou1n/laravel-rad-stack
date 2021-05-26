import { Model } from './model'

export class Profile extends Model {
  id: number
  name: string
  email: string
  toString() {
    return this.name
  }
}
