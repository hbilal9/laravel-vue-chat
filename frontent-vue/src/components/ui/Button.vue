<script setup lang="ts">
import { computed } from 'vue'
import type { HTMLAttributes, PropType } from 'vue'
import { cn } from '@/utils/cn'

// const props = withDefaults(
//   defineProps<{
//     variant?: 'primary' | 'info' | 'success' | 'warning' | 'danger' | 'outline' | 'text' | 'icon';
//     class?: HTMLAttributes['class'];
//     type?: 'button' | 'submit' | 'reset';
//     icon?: string;
//   }>(),
//   {
//     variant: 'primary',
//     type: 'button'
//   }
// );

const props = defineProps({
  variant: {
    type: String as PropType<
      'primary' | 'info' | 'success' | 'warning' | 'danger' | 'outline' | 'text' | 'icon'
    >,
    default: 'primary'
  },
  class: {
    type: String as PropType<HTMLAttributes['class']>
  },
  type: {
    type: String as PropType<'button' | 'submit' | 'reset'>,
    default: 'button'
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const classes = computed(() => {
  return {
    'bg-none border-none shadow-none hover:text-gray-800 text-gray-700 cursor-pointer':
      (props.variant as unknown as string) === 'icon',
    'bg-none border-none shadow-none hover:text-gray-900 text-gray-700 cursor-pointer':
      (props.variant as unknown as string) === 'text',
    'bg-none hover:bg-gray-200 text-gray-700': (props.variant as unknown as string) === 'outline',
    'bg-primary-600 hover:bg-primary-700 text-white disabled:bg-primary-500 disabled:cursor-not-allowed disabled:text-white':
      (props.variant as unknown as string) === 'primary',
    'bg-info hover:bg-blue-600 text-white disabled:bg-blue-500 disabled:cursor-not-allowed disabled:text-white':
      (props.variant as unknown as string) === 'info',
    'bg-success hover:bg-green-700 text-white disabled:bg-green-500 disabled:cursor-not-allowed disabled:text-white':
      (props.variant as unknown as string) === 'success',
    'bg-warning hover:bg-yellow-500 text-white disabled:bg-green-500 disabled:cursor-not-allowed disabled:text-white':
      (props.variant as unknown as string) === 'warning',
    'bg-danger hover:bg-red-700 text-white disabled:bg-green-700 disabled:cursor-not-allowed disabled:text-white':
      (props.variant as unknown as string) === 'danger'
  }
})
</script>

<template>
  <button
    :type="props.type"
    :disabled="props.disabled"
    :class="cn('btn btn-sm rounded-md px-5', classes, props.class)"
  >
    <slot />
  </button>
</template>
