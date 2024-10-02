    <!-- ULTIMO FUNCIONAL -->
    <template>
      <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
          <header class="text-center mb-4">
            <h2 class="mt-3 text-success">Formulario de Ingreso de Datos</h2>
          </header>
          <form @submit.prevent="enviarDatos" class="p-4 shadow-lg bg-white rounded">
    
            <!-- Sección de Datos del Inspector -->
            <div class="form-row">
              <h3>Datos del Inspector</h3>
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="nombre">Nombre:</label>
                  <input type="text" v-model="nombre" class="form-control" id="nombre" required />
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="apellido">Apellido:</label>
                  <input type="text" v-model="apellido" class="form-control" id="apellido" required />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="fecha">Fecha:</label>
                  <input type="date" v-model="fecha" class="form-control" id="fecha" required />
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="turno">Turno:</label>
                  <select v-model="turno" class="form-control" id="turno" required>
                    <option value="" disabled>Seleccione un Turno</option>
                    <option value="00 a 06">00 a 06</option>
                    <option value="06 a 12">06 a 12</option>
                    <option value="12 a 18">12 a 18</option>
                    <option value="18 a 00">18 a 00</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="periodo">Período:</label>
                  <select v-model="periodo" class="form-control" id="periodo" required>
                    <option value="" disabled>Seleccione un Período</option>
                    <option value="Findes/Feriado">Findes/Feriado</option>
                    <option value="Día Hábil">Día Hábil</option>
                  </select>
                </div>
              </div>
            </div>
    
            <!-- Sección de Datos del Colectivo -->
            <div class="form-row mt-4">
              <h3>Datos del Colectivo</h3>
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="anden">Plataforma: Superior/Inferior:</label>
                  <select v-model="anden" class="form-control" id="anden">
                    <option value="" disabled>Seleccione Plataforma</option>
                    <option value="Superior">Superior</option>
                    <option value="Inferior">Inferior</option>
                  </select>
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="arrSal">Arribo/Salida:</label>
                  <select v-model="arrSal" class="form-control" id="arrSal">
                    <option value="" disabled>Seleccione una opción</option>
                    <option value="Arribo">Arribo</option>
                    <option value="Salida">Salida</option>
                  </select>
                </div>
              </div>
    
              <!-- Fila con Empresa, Procedencia y Destino -->
              <div class="row">
                <div class="form-group col-12 col-md-4">
                  <label for="empresa">Empresa:</label>
                  <select v-model="empresa" @change="obtenerPrecio" class="form-control" id="empresa">
                    <option value="" disabled>Seleccione una Empresa</option>
                    <option v-if="anden === 'Superior'" value="Chito SRL">Chito SRL</option>
                    <option v-if="anden === 'Superior'" value="El Cometa Bis SRL">El Cometa Bis SRL</option>
                    <option v-if="anden === 'Superior'" value="Expreso Prox SRL">Expreso Prox SRL</option>
                    <option v-if="anden === 'Superior'" value="Kruse SRL">Kruse SRL</option>
                    <option v-if="anden === 'Superior'" value="M. Horianski SRL">M. Horianski SRL</option>
                    <option v-if="anden === 'Superior'" value="Martignoni Hnos. SRL">Martignoni Hnos. SRL</option>
                    <option v-if="anden === 'Superior'" value="Ntra. S. del Rosario SA">Ntra. S. del Rosario SA</option>
                    <option v-if="anden === 'Superior'" value="Oro Verde SRL">Oro Verde SRL</option>
                    <option v-if="anden === 'Superior'" value="Forestal MDM SRL - Sol del Norte">Forestal MDM SRL - Sol del Norte</option>
                    <option v-if="anden === 'Superior'" value="Tala SRL">Tala SRL</option>
                    <option v-if="anden === 'Superior'" value="L. S TRANSPORTE - Unión">L. S TRANSPORTE - Unión</option>
                    <option v-if="anden === 'Superior'" value="YSHA Águila Viajes">YSHA Águila Viajes</option>
                    <option v-if="anden === 'Superior'" value="El Cometa">El Cometa</option>
                    <option v-if="anden === 'Superior'" value="Crucero del Norte">Crucero del Norte SRL</option>
                    <option v-if="anden === 'Superior'" value="Río Uruguay SRL">Río Uruguay SRL</option>
                    <option v-if="anden === 'Inferior'" value="Otros">Otros</option>
    
                    <option v-if="anden === 'Inferior'" value="Turismo">Turismo</option>
                    <option v-if="anden === 'Inferior'" value="Capital del Monte">Capital del Monte SRL</option>
                    <option v-if="anden === 'Inferior'" value="Vía Bariloche">Vía Bariloche</option>
                    <option v-if="anden === 'Inferior'" value="Tigre Iguazú">Tigre Iguazú</option>
                    <option v-if="anden === 'Inferior'" value="Silvia S.A">Silvia S.A</option>
                    <option v-if="anden === 'Inferior'" value="Expreso Singer SAT">Expreso Singer SAT</option>
                    <option v-if="anden === 'Inferior'" value="Encarnación">Encarnación</option>
                    <option v-if="anden === 'Inferior'" value="Crucero del Sur SRL">Crucero del Sur SRL</option>
                    <option v-if="anden === 'Inferior'" value="Otros">Otros</option>
                  </select>
                </div>
    
                <!-- Campo Procedencia -->
                <div class="form-group col-12 col-md-4">
                  <label for="procedencia">Procedencia:</label>
                  <select v-model="procedencia" @change="obtenerPrecio" class="form-control" id="procedencia">
                    <option value="" disabled>Seleccione Procedencia</option>
                    <option v-for="lugar in lugares" :key="lugar" :value="lugar">{{ lugar }}</option>
                  </select>
                </div>
    
                <!-- Campo Destino -->
                <div class="form-group col-12 col-md-4">
                  <label for="destino">Destino:</label>
                  <select v-model="destino" @change="obtenerPrecio" class="form-control" id="destino">
                   <option value="" disabled>Seleccione Destino</option>
                   <option v-for="lugar in lugares" :key="lugar" :value="lugar">{{ lugar }}</option>
                 </select>
                </div>
    
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="servicio">Servicio:</label>
                  <select v-model="servicio" @change="obtenerPrecio" class="form-control" id="servicio">
                    <option value="" disabled>Seleccione un Servicio</option>
                    <option value="Internacional de larga distancia ">Internacional de larga distancia </option>
                    <option value="Internacional urbano a Encarnación">Internacional urbano a Encarnación</option>
                    <option value="Nacional/larga distancia ">Nacional/larga distancia </option>
                    <option value="Provincial/media distancia">Provincial/media distancia</option>
                    <option value="Turismo">Turismo</option>
                  </select>
                </div>
                
                <div class="form-group col-12 col-md-6">
                  <label for="cocheNumero">Número del Coche:</label>
                  <input type="text" v-model="cocheNumero" class="form-control" id="cocheNumero" />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="ticketNumero">Número del Ticket:</label>
                  <input type="text" v-model="ticketNumero" class="form-control" id="ticketNumero" />
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="horaIngreso">Hora de Ingreso:</label>
                  <input type="time" v-model="horaIngreso" class="form-control" id="horaIngreso" />
                </div>
              </div>
    
    
            
              <!-- Campo Importe Canon con autocompletado -->
              <div class="form-group col-12 col-md-6">
                <label for="importeCanon">Importe Canon:</label>
                <select v-model="importeCanon" class="form-control" id="importeCanon">
                  <option value="" disabled>Seleccione el Importe Canon</option>
                  <option v-for="importe in opcionesUnicasImporte" :key="importe" :value="importe">
                    {{ importe }}
                  </option>
                </select>
              </div>
    


            </div>


          </div>
            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary mt-4">Enviar</button>
            </form>
          </div>
      </div>
    </template>
    
    <script>
    export default {
  name: 'recolecion_datos',
  data() {
    return {
      // Datos del inspector
      nombre: '',
      apellido: '',
      fecha: '',
      turno: '',
      periodo: '',
      // Datos del colectivo
      anden: '',
      arrSal: '',
      empresa: '',
      servicio: '',
      cocheNumero: '',
      ticketNumero: '',
      horaIngreso: '',
      importeCanon: '',
      procedencia: '',
      destino: '',
      lugares: [
        'Iguazú', 'Retiro', 'Rosario', 'Tucuman', 'Mar del Plata', 'Cordoba', 'Virasoro', 'Santo Tome',
        'Paso de los Libres', 'Porto Alegre', 'Ituzaingo', 'Resistencia', 'Camboriu', 
        'Floreanopolis', 'Torres', 'Clorinda', 'Buenos Aires', 'Yacutinga', 'San Ignacio', 
        'El Dorado', 'Andresito', 'San Antonio', 'Irigoyen', 'El Soberbio', 'San Pedro', 
        'Corpus', 'Obera', '25 de Mayo', 'San Vicente', 'Concepción de las Sierras', 
        'San Javier', 'L. N. Alem', 'Provinciales', 'Azara', 'Apóstoles', 'Internacionales', 
        'Nacionales'
      ],

      // Lista de opciones de importes únicos
      opcionesUnicasImporte: [
        '19000', '17150', '15150', '15000', '20375', '13550',
        '18050', '20600', '11650', '18200', '15325', '3800',
        '1700', '950', '15100', '11500', '7200', '3900', 
        '20375', '1000', '7500', '10230', '17600', '5300',
        '7500', '1250', '2500', '5000', '10000', '4500',
        '3000', '850', '1050', '4600', '5000', '4500', 
        '900', '3700', '3250', '2900', '2500', '1400', 
        '1250', '1800', '1300', '800', '1100'
      ]
    };
  },
        
     
  methods: {
        
        obtenerPrecio() {
          // Crear los datos en formato URL-encoded
          const datos = new URLSearchParams({
            empresa: this.empresa,
            procedencia: this.procedencia,
            destino: this.destino,
            servicio: this.servicio
          });
          

          console.log('Datos enviados:', datos);
          // Enviar los datos al servidor y obtener el precio
          fetch('http://localhost/ingreso_colectivos/registro_coles/get_price.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',  // Cambiado a form-urlencoded
            },
            body: datos.toString(), // Enviar como form-urlencoded
          })
          .then(response => response.json())
          .then(data => {
            if (!isNaN(data)) {
              this.importeCanon = data; // Mostrar el precio en el campo de importe
            } else {
              alert('No se encontró un precio para esta combinación.');
            }
          })
          .catch(error => {
            console.error('Error al obtener el precio:', error);
          });
        },

    
        enviarDatos() {
          // Crear el objeto con los datos combinados
          const datosCompletos = {
            nombre: this.nombre,
            apellido: this.apellido,
            fecha: this.fecha,
            turno: this.turno,
            periodo: this.periodo,
            anden: this.anden,
            arrSal: this.arrSal,
            empresa: this.empresa,
            servicio: this.servicio,
            cocheNumero: this.cocheNumero,
            ticketNumero: this.ticketNumero,
            horaIngreso: this.horaIngreso,
            importeCanon: this.importeCanon,
            procedencia: this.procedencia,
            destino: this.destino
          };
    
          // Enviar los datos al servidor
          fetch('http://localhost/ingreso_colectivos/registro_coles/insertar_completo.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(datosCompletos),
          })
          .then(response => response.text())
          .then(data => {
            console.log(data);
            alert('Datos enviados correctamente');
            this.resetFormulario();
          })
          .catch(error => {
            console.error('Error al enviar los datos:', error);
          });
        },
      resetFormulario() {
          // Resetear todos los campos del formulario
         
          this.anden = '';
          this.arrSal = '';
          this.empresa = '';
          this.servicio = '';
          this.cocheNumero = '';
          this.ticketNumero = '';
          this.horaIngreso = '';
          this.importeCanon = '';
          this.procedencia = '';
          this.destino = '';
        }
      }
    };



    </script>
    
    <style scoped>
    .container-fluid {
      background-color: #f8f9fa;
    }
    
    .form-container {
      max-width: 100%;
      width: 600px;
      padding: 30px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      border-radius: 15px;
      background-color: #ffffff;
    }
    
    h2 {
      color: #14a162;
      font-weight: bold;
    }
    </style>
    