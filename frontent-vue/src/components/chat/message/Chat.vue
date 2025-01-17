<script setup lang="ts">
import { watch, ref } from 'vue'
import { useConversationStore } from '@/stores/conversationStore'
import { useMessageStore } from '@/stores/messageStore'
import { useAuthStore } from '@/stores/authStore'
import Message from './Message.vue'
import TextInput from '@/components/ui/TextInput.vue'
import echo from '@/services/echo'
import type { IMessage } from '@/types/conversation'

const conversationStore = useConversationStore()
const store = useMessageStore()
const auth = useAuthStore()

const message = ref('')
const typing = ref(false)
const timeout = ref(0)
watch(
  () => conversationStore.selectedConversation,
  (conversation) => {
    store.fetchMessages(conversation?.id!)
    echo
      .join(`conversation.${conversation?.id}`)
      .listen('MessageSent', (e: { message: IMessage }) => {
        if (e.message.user_id !== auth.user?.id) {
          store.addMessage(e.message)
        }
      })
      .listenForWhisper('typing', (e: { typing: boolean }) => {
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
        if (isUserAtBottom()) {
          store.markMsgAsSeen(conversationStore.selectedConversation?.id!)
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
    console.log('object')
    store.markMsgAsSeen(conversationStore.selectedConversation?.id!)
  }
}

const isUserAtBottom = () => {
  const container = messageContainer.value
  return container?.scrollTop! + container?.clientHeight! >= container?.scrollHeight! - 20 // 20px threshold
}

const scrollToBottom = () => {
  if (messageContainer.value) {
    messageContainer.value.scrollTop = messageContainer.value.scrollHeight
  }
}

watch(
  () => store.messages,
  () => {
    scrollToBottom()
  }
)
</script>

<template>
  <div class="bg-gray-200 rounded w-full mt-4 overflow-hidden">
    <ul
      @scroll="onScroll"
      class="flex flex-col gap-2 h-full overflow-auto justify-start px-2 py-2"
      ref="messageContainer"
      v-chat-scroll
    >
      <Message v-for="msg in store.messages" :key="msg.id" :message="msg" />
    </ul>
  </div>
  <div class="h-5 text-start">
    <div v-if="typing" class="text-sm text-gray-500 mt-2">Typing...</div>
  </div>
  <div v-if="conversationStore.selectedConversation" class="flex gap-2">
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
