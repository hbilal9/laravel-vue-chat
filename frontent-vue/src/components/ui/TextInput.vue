<script setup lang="ts">
const { modelValue, placeholder, label, type } = defineProps({
  modelValue: {
    type: String
  },
  placeholder: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  errors: {
    type: String,
    default: ''
  }
})
const random = Math.floor(Math.random() * 1000000).toString()
</script>

<template>
  <div>
    <label v-if="label" :for="random" class="block py-2 text-sm font-bold text-gray-600">
      {{ label }}
    </label>
    <div
      class="w-auto flex items-center rounded-md border-2 focus-within:border-primary-500 h-12 justify-center p-2 gap-2"
      :class="`${disabled ? 'bg-gray-100' : 'bg-white'} ${errors ? 'border-danger' : 'border-secondary-200'}`"
    >
      <input
        v-bind="$attrs"
        :id="random"
        :value="modelValue"
        :placeholder="placeholder"
        :type="type"
        @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        class="w-full p-2 h-full outline-none bg-transparent text-base"
        :disabled="disabled"
        :autocomplete="type === 'password' ? 'false' : 'true'"
      />
    </div>
    <small class="text-xs text-danger">
      {{ errors }}
    </small>
  </div>
</template>
