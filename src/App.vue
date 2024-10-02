<template>
  <div id="app">
    <header class="header-container">
      <img src="@/assets/mov urb.png" alt="Logo Omnibus" class="header-logo img-fluid" />
    </header>

    <!-- Aquí se renderizan los componentes según la ruta -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 10px;
  background-color: #f5f5f5;
}

/* Estilos para el header */
.header-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2%;
  background-color: #f5f5f5;
}

@media (min-width: 1024px) {
  .header-logo {
    max-width: 100px; /* Tamaño del logo en pantallas grandes como PC */
  }
}

@media (max-width: 768px) {
  .header-logo {
    max-width: 300px; /* Cambia el tamaño del logo en pantallas pequeñas */
  }
}

@media (max-width: 576px) {
  .header-logo {
    max-width: 200px; /* Logo más pequeño en dispositivos móviles */
  }
}

nav {
  padding: 10px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #ddd;
}
</style>
