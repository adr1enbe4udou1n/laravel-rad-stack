export interface Column {
  field: string
  label?: string
  width?: number | string
  numeric?: boolean
  centered?: boolean
  sortable?: boolean
  searchable?: boolean
  type?: string
  props?: any
}

export interface Filter {}
