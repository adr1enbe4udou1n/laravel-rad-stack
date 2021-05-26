export interface PaginatedData<Model> {
  current_page: number
  data: Model[]
  first_page_url: string
  from: number
  last_page: number
  last_page_url: string
  links: PaginatedLink[]
  next_page_url: string
  path: string
  per_page: number | string
  prev_page_url: null
  to: number
  total: number
}

export interface PaginatedLink {
  url: null | string
  label: string
  active: boolean
}
