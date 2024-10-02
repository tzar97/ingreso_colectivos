// src/router.js
import { createRouter, createWebHistory } from 'vue-router';
import RecoleccionDatos from './components/recolecion_datos.vue'; // Importa el componente existente
import dash_board from './components/dash_board.vue'; // Crea e importa tu nuevo componente

const routes = [
  {
    path: '/', // Ruta para el formulario principal
    name: 'RecoleccionDatos',
    component: RecoleccionDatos,
  },
  {
    path: '/dash_board', // Ruta para la nueva página
    name: 'dash_board',
    component: dash_board,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
