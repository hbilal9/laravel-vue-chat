<script setup lang="ts">
import { watch, ref, onMounted } from 'vue'
import { useConversationStore } from '@/stores/conversationStore'
import { useMessageStore } from '@/stores/messageStore'
import Message from './Message.vue'
import TextInput from '@/components/ui/TextInput.vue'
import echo from '@/services/echo'
import type { IMessage } from '@/types/conversation'

const conversationStore = useConversationStore()
const store = useMessageStore()

const message = ref('')
const typing = ref(false)
const timeout = ref(0)
watch(
  () => conversationStore.selectedConversation,
  (conversation) => {
    store.fetchMessages(conversation?.id!)
    echo
      .join(`conversation.${conversation?.id}`)
      .listen('MessageSent', (e) => {
        store.addMessage(e.message)
      })
      .listenForWhisper('typing', (e) => {
        typing.value = e.typing
        if (timeout.value) {
          clearTimeout(timeout.value)
        }
        timeout.value = setTimeout(() => {
          typing.value = false
        }, 2000)
      })
      .listen('MessageSeen', (e: { message: IMessage }) => {
        const seenMessage = store.messages.find((m) => m.id === e.message.id)
        if (seenMessage) {
          seenMessage.seen = true
          seenMessage.seen_at = e.message.seen_at
        }
      })
  }
)

const handleWhiser = () => {
  echo.join(`conversation.${conversationStore.selectedConversation?.id}`).whisper('typing', {
    typing: true
  })
}

const handleSendMessage = async () => {
  let data = {
    conversationId: conversationStore.selectedConversation?.id!,
    content: message.value
  }
  await store.sendMessage(data)
  message.value = ''
}

const messageContainer = ref<HTMLElement | null>(null)
const onScroll = () => {
  const container = messageContainer.value
  if (container?.scrollTop! + container?.clientHeight! >= container?.scrollHeight!) {
    store.markMsgAsSeen(conversationStore.selectedConversation?.id!)
  }
}
</script>

<template>
  <div class="bg-gray-200 rounded w-full mt-4 overflow-hidden">
    <ul
      @scroll="onScroll"
      class="flex flex-col gap-2 h-full overflow-auto justify-start px-2 py-2"
      ref="messageContainer"
    >
      <Message v-for="msg in store.messages" :key="msg.id" :message="msg" />
    </ul>
  </div>
  <div class="h-5 text-start">
    <div v-if="typing" class="text-sm text-gray-500 mt-2">Typing...</div>
  </div>
  <div class="flex gap-2">
    <TextInput
      @input="handleWhiser"
      v-model="message"
      class="py-4 w-full"
      placeholder="type here..."
    />
    <button @click="handleSendMessage" class="bg-blue-500 text-white p-2 rounded h-12 mt-4">
      Send
    </button>
  </div>
</template>
