<script setup lang="ts"></script>

<template>
  <div class="flex gap-2 w-full px-10 h-screen">
    <div class="flex flex-col w-[18rem]">
      <h1 class="text-2xl font-bold">Conversations</h1>
      <p class="text-sm text-gray-500">Click on a conversation to see the messages</p>
      <ul class="space-y-2 mt-4 grow bg-primary-300 px-2 py-4 rounded">
        <li class="px-2 py-3 rounded bg-gray-200 cursor-pointer hover:bg-primary-200">
          <span>HBilal Khan</span>
        </li>
        <li class="px-2 py-3 rounded bg-gray-200 cursor-pointer hover:bg-primary-200">
          <span>HBilal Khan</span>
        </li>
      </ul>
    </div>
    <div class="flex flex-col grow text-center">
      <h1 class="text-2xl font-bold">Select Conversation To Start Chatting</h1>
      <p class="text-sm text-gray-500">Click on a conversation to see the messages</p>
      <div class="bg-gray-200 rounded h-full w-full mt-4">Hello</div>
    </div>
  </div>
</template>
