<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class extends Vue {}
</script>

<template>
  <div class="menu">
      <h1>Title</h1>
      <nav>
          <ul>
              <li>foo</li>
              <li>bar</li>
          </ul>
      </nav>
  </div>
</template>

<style lang="scss" scoped>
.menu {
    padding-top: 60px;
    padding-bottom: 40px;
}
</style>

