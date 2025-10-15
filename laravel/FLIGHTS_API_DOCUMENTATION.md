# Flight API Endpoints Documentation

## Base URL
```
http://localhost:8000/api
```
*En producción: `https://tu-dominio-render.com/api`*

## Arquitectura de Persistencia
Los endpoints de vuelos utilizan **persistencia JSON** en lugar de base de datos SQLite. Los datos se almacenan en el archivo `flights.json` ubicado en la raíz del proyecto Laravel.

---

## Endpoints de Vuelos

### 1. Obtener Todos los Vuelos
```http
GET /flights
```

**Descripción:** Retorna todos los vuelos disponibles en el sistema.

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "aeropuerto_origen_id": 1,
      "aeropuerto_destino_id": 2,
      "fecha": "2024-10-15",
      "hora_salida": "08:30",
      "hora_llegada": "10:15",
      "aerolinea": "Iberia",
      "numero_vuelo": "IB6021",
      "tipo_aeronave": "Airbus A320",
      "pasajeros": 158,
      "tipo": "salida",
      "co2_estimado_kg": 12500.5
    }
  ],
  "count": 150
}
```

**Respuesta de error (500):**
```json
{
  "success": false,
  "message": "Error retrieving flights",
  "error": "Detalle del error"
}
```

---

### 2. Obtener Vuelo Específico
```http
GET /flights/{id}
```

**Parámetros:**
- `id` (integer): ID único del vuelo

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "aeropuerto_origen_id": 1,
    "aeropuerto_destino_id": 2,
    "fecha": "2024-10-15",
    "hora_salida": "08:30",
    "hora_llegada": "10:15",
    "aerolinea": "Iberia",
    "numero_vuelo": "IB6021",
    "tipo_aeronave": "Airbus A320",
    "pasajeros": 158,
    "tipo": "salida",
    "co2_estimado_kg": 12500.5
  }
}
```

**Respuesta no encontrado (404):**
```json
{
  "success": false,
  "message": "Flight not found"
}
```

---

### 3. Obtener Todos los Aeropuertos
```http
GET /airports
```

**Descripción:** Retorna todos los aeropuertos disponibles.

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nombre": "Aeropuerto Adolfo Suárez Madrid-Barajas",
      "ciudad": "Madrid",
      "codigo_iata": "MAD",
      "coordenadas": {
        "latitud": 40.4719,
        "longitud": -3.5626
      },
      "poblacion": 3223334,
      "co2_anual_toneladas": 8500000
    }
  ],
  "count": 25
}
```

---

### 4. Obtener Vuelos por Aeropuerto
```http
GET /flights/airport/{id}
```

**Parámetros:**
- `id` (integer): ID del aeropuerto

**Descripción:** Retorna todos los vuelos que tienen como origen o destino el aeropuerto especificado.

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "aeropuerto_origen_id": 1,
      "aeropuerto_destino_id": 2,
      "fecha": "2024-10-15",
      "hora_salida": "08:30",
      "hora_llegada": "10:15",
      "aerolinea": "Iberia",
      "numero_vuelo": "IB6021",
      "tipo_aeronave": "Airbus A320",
      "pasajeros": 158,
      "tipo": "salida",
      "co2_estimado_kg": 12500.5
    }
  ],
  "count": 45,
  "airport_id": 1
}
```

---

### 5. Obtener Vuelos por Fecha
```http
GET /flights/date/{date}
```

**Parámetros:**
- `date` (string): Fecha en formato YYYY-MM-DD

**Descripción:** Retorna todos los vuelos programados para la fecha especificada.

**Ejemplo:**
```http
GET /flights/date/2024-10-15
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "aeropuerto_origen_id": 1,
      "aeropuerto_destino_id": 2,
      "fecha": "2024-10-15",
      "hora_salida": "08:30",
      "hora_llegada": "10:15",
      "aerolinea": "Iberia",
      "numero_vuelo": "IB6021",
      "tipo_aeronave": "Airbus A320",
      "pasajeros": 158,
      "tipo": "salida",
      "co2_estimado_kg": 12500.5
    }
  ],
  "count": 23,
  "date": "2024-10-15"
}
```

---

### 6. Obtener Vuelos por Tipo
```http
GET /flights/type/{type}
```

**Parámetros:**
- `type` (string): Tipo de vuelo (`entrada` o `salida`)

**Descripción:** Retorna vuelos filtrados por tipo (entrada o salida).

**Ejemplos:**
```http
GET /flights/type/salida
GET /flights/type/entrada
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "aeropuerto_origen_id": 1,
      "aeropuerto_destino_id": 2,
      "fecha": "2024-10-15",
      "hora_salida": "08:30",
      "hora_llegada": "10:15",
      "aerolinea": "Iberia",
      "numero_vuelo": "IB6021",
      "tipo_aeronave": "Airbus A320",
      "pasajeros": 158,
      "tipo": "salida",
      "co2_estimado_kg": 12500.5
    }
  ],
  "count": 75,
  "type": "salida"
}
```

---

### 7. Obtener CO2 Total por Aeropuerto
```http
GET /flights/co2/airport/{id}
```

**Parámetros:**
- `id` (integer): ID del aeropuerto

**Descripción:** Calcula las emisiones totales de CO2 para todos los vuelos de un aeropuerto específico.

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": {
    "airport_id": 1,
    "total_co2_kg": 2875600.50,
    "total_co2_tons": 2875.60,
    "total_flights": 123,
    "average_co2_per_flight_kg": 23377.24
  }
}
```

---

### 8. Obtener Vuelos con Mayor Emisión CO2
```http
GET /flights/co2/highest
```

**Parámetros de consulta opcionales:**
- `limit` (integer): Número máximo de resultados (por defecto: 10)

**Descripción:** Retorna los vuelos con mayores emisiones de CO2 ordenados de mayor a menor.

**Ejemplo:**
```http
GET /flights/co2/highest?limit=5
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 45,
      "aeropuerto_origen_id": 1,
      "aeropuerto_destino_id": 8,
      "fecha": "2024-10-20",
      "hora_salida": "14:30",
      "hora_llegada": "22:45",
      "aerolinea": "Air Europa",
      "numero_vuelo": "UX8923",
      "tipo_aeronave": "Boeing 787",
      "pasajeros": 284,
      "tipo": "salida",
      "co2_estimado_kg": 45780.25
    }
  ],
  "count": 5,
  "limit": 5
}
```

---

### 9. Obtener Estadísticas Generales
```http
GET /flights/statistics
```

**Descripción:** Retorna estadísticas completas del sistema de vuelos incluyendo totales de CO2, vuelos, aeropuertos y promedios.

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": {
    "json_statistics": {
      "total_vuelos": 150,
      "total_aeropuertos": 25,
      "vuelos_por_tipo": {
        "entrada": 75,
        "salida": 75
      },
      "aerolineas_activas": 12
    },
    "calculated_statistics": {
      "total_flights": 150,
      "total_airports": 25,
      "total_co2_kg": 4562750.75,
      "total_co2_tons": 4562.75,
      "average_passengers_per_flight": 167.23,
      "average_co2_per_flight_kg": 30418.34
    }
  }
}
```

---

## Estructura de Datos

### Objeto Flight (Vuelo)
```json
{
  "id": "integer - ID único del vuelo",
  "aeropuerto_origen_id": "integer - ID del aeropuerto de origen",
  "aeropuerto_destino_id": "integer - ID del aeropuerto de destino",
  "fecha": "string - Fecha del vuelo (YYYY-MM-DD)",
  "hora_salida": "string - Hora de salida (HH:MM)",
  "hora_llegada": "string - Hora de llegada (HH:MM)",
  "aerolinea": "string - Nombre de la aerolínea",
  "numero_vuelo": "string - Código del vuelo",
  "tipo_aeronave": "string - Modelo del avión",
  "pasajeros": "integer - Número de pasajeros",
  "tipo": "string - Tipo de vuelo (entrada/salida)",
  "co2_estimado_kg": "float - Emisiones estimadas de CO2 en kilogramos"
}
```

### Objeto Airport (Aeropuerto)
```json
{
  "id": "integer - ID único del aeropuerto",
  "nombre": "string - Nombre completo del aeropuerto",
  "ciudad": "string - Ciudad donde se encuentra",
  "codigo_iata": "string - Código IATA de 3 letras",
  "coordenadas": {
    "latitud": "float - Latitud geográfica",
    "longitud": "float - Longitud geográfica"
  },
  "poblacion": "integer - Población de la ciudad",
  "co2_anual_toneladas": "float - Emisiones anuales de CO2 en toneladas"
}
```

---

## Códigos de Estado HTTP

- **200**: Operación exitosa
- **404**: Recurso no encontrado
- **500**: Error interno del servidor

---

## Manejo de Errores

Todos los endpoints retornan errores en el siguiente formato:

```json
{
  "success": false,
  "message": "Descripción del error",
  "error": "Detalle técnico del error (opcional)"
}
```

---

## Consideraciones Técnicas

1. **Persistencia JSON**: Los datos se leen del archivo `flights.json` en tiempo real
2. **Performance**: No hay cache implementado, cada consulta lee el archivo completo
3. **Filtros**: Los filtros se aplican en memoria después de cargar todos los datos
4. **CORS**: Configurado para permitir requests desde Angular frontend
5. **Validación**: Validación básica de parámetros en las rutas
6. **Escalabilidad**: Para grandes volúmenes de datos, considerar migrar a base de datos

---

## Ejemplos de Uso con cURL

### Obtener todos los vuelos
```bash
curl -X GET http://localhost:8000/api/flights
```

### Obtener vuelo específico
```bash
curl -X GET http://localhost:8000/api/flights/1
```

### Obtener vuelos por aeropuerto
```bash
curl -X GET http://localhost:8000/api/flights/airport/1
```

### Obtener estadísticas
```bash
curl -X GET http://localhost:8000/api/flights/statistics
```

### Obtener top 5 vuelos con mayor CO2
```bash
curl -X GET "http://localhost:8000/api/flights/co2/highest?limit=5"
```

---

## Notas para Frontend Angular

- Todos los endpoints retornan JSON válido
- El campo `success` indica si la operación fue exitosa
- Los arrays de datos siempre incluyen un campo `count`
- Las fechas están en formato ISO (YYYY-MM-DD)
- Las coordenadas están en formato decimal (latitud, longitud)
- Las emisiones de CO2 se pueden mostrar tanto en kg como en toneladas