<script lang="ts">
import SideMenu from '@/components/organisims/SideMenu.vue';
import { Component, Vue } from 'vue-property-decorator';

@Component({
    components: {
        SideMenu,
    },
})
export default class App extends Vue {}
</script>

<template>
  <div>
    <SideMenu class=side-menu />
    <router-view />
  </div>
</template>
  
<style lang="scss">
.side-menu {
  width: 20%;
}
</style>

