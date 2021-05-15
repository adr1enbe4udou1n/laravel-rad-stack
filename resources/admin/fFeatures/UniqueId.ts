export default function uniqueId(): string {
  return Math.random().toString(36).substr(2, 9)
}
