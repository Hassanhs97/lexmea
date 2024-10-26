<template>
  <div id="app">
    <header>
      <h1>Hotel Room Management</h1>
      <nav>
        <router-link to="/rooms">Rooms</router-link>
        <router-link to="/guests">Guests</router-link>
      </nav>
    </header>
    <router-view />
  </div>
</template>

<script lang="ts">
export default {
  name: 'App',
};
</script>