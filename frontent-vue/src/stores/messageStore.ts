import { http } from '@/services/http'
import type { IMessage } from '@/types/conversation'
import { defineStore } from 'pinia'

export const useMessageStore = defineStore('messageStore', {
  state: () => ({
    messages: [] as IMessage[]
  }),
  actions: {
    async fetchMessages(conversationId: number) {
      try {
        const response = await http().get(`/users/conversations/${conversationId}/messages`)
        this.messages = response.data
      } catch (error: any) {
        console.log(error)
      }
    },
    async sendMessage(data: { conversationId: number | string; content: string }) {
      try {
        const response = await http().post(`/users/conversations/${data.conversationId}/messages`, {
          content: data.content
        })
        this.messages.push(response.data)
      } catch (error: any) {
        console.log(error)
      }
    }
  }
})
