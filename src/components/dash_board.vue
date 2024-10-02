<template>
  <div class="dash_board">
    <h1>Panel de Control</h1>
    <p>Aquí puedes ver los datos generados desde el formulario.</p>

    <!-- Botón para descargar XLS -->
    <button @click="descargarXLS">Descargar XLS</button>

    <table class="data_table">
      <thead>
        <tr>
          <th @click="ordenarPor('Nombre inspector')">Nombre Inspector</th>
          <th @click="ordenarPor('Apellido inspector')">Apellido Inspector</th>
          <th @click="ordenarPor('Fecha')">Fecha</th>
          <th @click="ordenarPor('Turno')">Turno</th>
          <th @click="ordenarPor('Periodo')">Periodo</th>
          <th @click="ordenarPor('Anden')">Anden</th>
          <th @click="ordenarPor('Arribo / Salida')">Arribo / Salida</th>
          <th @click="ordenarPor('Empresa')">Empresa</th>
          <th @click="ordenarPor('Servicio')">Servicio</th>
          <th @click="ordenarPor('Nº Coche')">Nº Coche</th>
          <th @click="ordenarPor('Nº Ticket')">Nº Ticket</th>
          <th @click="ordenarPor('Hora de ingreso')">Hora de Ingreso</th>
          <th @click="ordenarPor('Importe Canon')">Importe Canon</th>
          <th @click="ordenarPor('Procedencia')">Procedencia</th>
          <th @click="ordenarPor('Destino')">Destino</th>
          <th @click="ordenarPor('Fecha de registro')">Fecha de Registro</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(dato, index) in datosOrdenados" :key="index">
          <td>{{ dato['Nombre inspector'] }}</td>
          <td>{{ dato['Apellido inspector'] }}</td>
          <td>{{ dato['Fecha'] }}</td>
          <td>{{ dato['Turno'] }}</td>
          <td>{{ dato['Periodo'] }}</td>
          <td>{{ dato['Anden'] }}</td>
          <td>{{ dato['Arribo / Salida'] }}</td>
          <td>{{ dato['Empresa'] }}</td>
          <td>{{ dato['Servicio'] }}</td>
          <td>{{ dato['Nº Coche'] }}</td>
          <td>{{ dato['Nº Ticket'] }}</td>
          <td>{{ dato['Hora de ingreso'] }}</td>
          <td>{{ dato['Importe Canon'] }}</td>
          <td>{{ dato['Procedencia'] }}</td>
          <td>{{ dato['Destino'] }}</td>
          <td>{{ dato['Fecha de registro'] }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import * as XLSX from 'xlsx';

export default {
  name: 'dash_board', // Nombre ajustado a multi-word
  data() {
    return {
      datos: [], // Datos recibidos desde el formulario
      columnaOrden: '',
      ordenAscendente: true
    };
  },
  computed: {
    datosOrdenados() {
      return this.datos.slice().sort((a, b) => {
        if (this.ordenAscendente) {
          return a[this.columnaOrden] > b[this.columnaOrden] ? 1 : -1;
        } else {
          return a[this.columnaOrden] < b[this.columnaOrden] ? 1 : -1;
        }
      });
    }
  },
  methods: {
    obtenerDatos() {
      fetch('http://localhost/ingreso_colectivos/registro_coles/obtener_datos.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
          }
          return response.json();
        })
        .then(data => {
          this.datos = data;
        })
        .catch(error => {
          console.error('Error al obtener los datos:', error);
        });
    },
    ordenarPor(columna) {
      if (this.columnaOrden === columna) {
        this.ordenAscendente = !this.ordenAscendente;
      } else {
        this.columnaOrden = columna;
        this.ordenAscendente = true;
      }
    },
    descargarXLS() {
      // Preparar los datos para el archivo XLS
      const datosParaXLS = this.datos.map(dato => ({
        'Nombre inspector': dato['Nombre inspector'],
        'Apellido inspector': dato['Apellido inspector'],
        'Fecha': dato['Fecha'],
        'Turno': dato['Turno'],
        'Periodo': dato['Periodo'],
        'Anden': dato['Anden'],
        'Arribo / Salida': dato['Arribo / Salida'],
        'Empresa': dato['Empresa'],
        'Servicio': dato['Servicio'],
        'Nº Coche': dato['Nº Coche'],
        'Nº Ticket': dato['Nº Ticket'],
        'Hora de ingreso': dato['Hora de ingreso'],
        'Importe Canon': dato['Importe Canon'],
        'Procedencia': dato['Procedencia'],
        'Destino': dato['Destino'],
        'Fecha de registro': dato['Fecha de registro'],
      }));

      // Crear una hoja de trabajo (worksheet)
      const ws = XLSX.utils.json_to_sheet(datosParaXLS);

      // Crear un libro de trabajo (workbook)
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Datos Formulario');

      // Generar el archivo XLSX y descargarlo
      XLSX.writeFile(wb, 'datos_formulario.xlsx');
    }
  },
  mounted() {
    this.obtenerDatos(); // Llamar a la función al montar el componente
  }
};
</script>

<style scoped>
.dash_board {
  padding: 20px;
}

.data_table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.data_table th,
.data_table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  cursor: pointer;
}

.data_table th {
  background-color: #f4f4f4;
  font-weight: bold;
}
</style>
  