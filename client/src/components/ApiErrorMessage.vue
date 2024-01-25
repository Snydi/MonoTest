<template>
  <div :style="{ display: showMessage ? 'block' : 'none' }" v-if="errors.length > 0" class="alert alert-danger">
    <ul>
      <li  v-for="error in errors">{{ error }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    errors: [],
    showMessage: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

