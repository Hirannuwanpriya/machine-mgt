<template>
  <div>
    <RouterView></RouterView>
    <notifications position="bottom right"/>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
}
</script>

<style>

</style>
