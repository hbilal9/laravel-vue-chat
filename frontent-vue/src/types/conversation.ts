import type { IUser } from './user'

export interface IConversation {
  id: number
  users: IUser[]
  last_message: string
  last_message_at: string
  created_at: string
  updated_at: string
}

export interface IMessage {
  id: number
  conversation_id: number
  user: IUser
  content: string
  seen: boolean
  seen_at: string
  created_at: string
  updated_at: string
}
