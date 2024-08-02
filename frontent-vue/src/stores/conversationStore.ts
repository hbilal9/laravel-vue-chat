import { http } from '@/services/http'
import type { IConversation } from '@/types/conversation'
import { defineStore } from 'pinia'

export const useConversationStore = defineStore('conversationStore', {
  state: () => ({
    conversations: [] as IConversation[],
    selectedConversation: null as IConversation | null
  }),
  actions: {
    async fetchConversations() {
      try {
        const response = await http().get('/users/conversations/')
        this.conversations = response.data
      } catch (error: any) {
        console.log(error)
      }
    },
    setSelectedConversation(conversation: IConversation) {
      this.selectedConversation = conversation
    }
  }
})
