import { Model } from './model'

export class Post extends Model {
  constructor(
    public id: number,
    public category_id: number,
    public title: string,
    public status: string,
    public summary: string,
    public body: string,
    public published_at: string,
    public pin: boolean,
    public promote: boolean,
    public slug: string,
    public meta_title: string,
    public meta_description: string,
    public created_at: string,
    public updated_at: string,
    public category: PostCategory
  ) {
    super(id)
  }
  toString() {
    return this.title
  }
}

export class PostCategory extends Model {
  constructor(
    public id: number,
    public name: string,
    public order_column: number,
    public slug: string,
    public created_at: string,
    public updated_at: string
  ) {
    super(id)
  }
  toString() {
    return this.name
  }
}
