import moment from 'moment'

// timeAgo
export const timeAgo = (date: string): string => {
  return moment(date).fromNow()
}
