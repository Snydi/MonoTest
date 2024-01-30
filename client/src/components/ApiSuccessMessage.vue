<template>
  <p :style="{ color: 'green', display: showMessage ? 'block' : 'none' }">{{ message }}</p>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      default: '',
    },
    showMessage: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

