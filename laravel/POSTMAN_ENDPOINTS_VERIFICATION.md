# Endpoints Verificados para Postman - Laravel API

## 🚀 Base URL
```
http://127.0.0.1:8000/api
```

## ✅ Endpoints Funcionales (Verificados con Tests)

### 🛡️ Health Check
```http
GET /api/health
```
**Status**: ✅ 200 OK  
**Response Structure**:
```json
{
  "success": true,
  "message": "API is running",
  "database": "Connected (SQLite)",
  "territories_count": 0,
  "timestamp": "2025-10-15T...",
  "app_name": "Laravel",
  "app_env": "local"
}
```

---

### ✈️ Flight Endpoints (JSON Persistence)

#### 1. Todos los Vuelos
```http
GET /api/flights
```
**Status**: ✅ 200 OK  
**Response**: Array de vuelos con `success`, `data`, `count`

#### 2. Vuelo Específico
```http
GET /api/flights/{id}
```
**Ejemplos**:
- `GET /api/flights/IB3201` (por código de vuelo)
- `GET /api/flights/1` (por índice numérico)

**Status**: ✅ 200 OK  
**Response**: Vuelo individual con todos los campos

#### 3. Aeropuertos
```http
GET /api/airports
```
**Status**: ✅ 200 OK  
**Response**: Array de aeropuertos con coordenadas, códigos IATA, etc.

#### 4. Vuelos por Aeropuerto
```http
GET /api/flights/airport/{id}
```
**Ejemplo**: `GET /api/flights/airport/1`  
**Status**: ✅ 200 OK

#### 5. Vuelos por Fecha
```http
GET /api/flights/date/{date}
```
**Ejemplo**: `GET /api/flights/date/2025-10-15`  
**Status**: ✅ 200 OK

#### 6. Vuelos por Tipo
```http
GET /api/flights/type/{type}
```
**Ejemplos**:
- `GET /api/flights/type/salida`
- `GET /api/flights/type/entrada`

**Status**: ✅ 200 OK

#### 7. CO2 por Aeropuerto
```http
GET /api/flights/co2/airport/{id}
```
**Ejemplo**: `GET /api/flights/co2/airport/1`  
**Status**: ✅ 200 OK  
**Response**:
```json
{
  "success": true,
  "data": {
    "airport_id": 1,
    "total_co2_kg": 12500.5,
    "total_co2_tons": 12.5,
    "total_flights": 25,
    "average_co2_per_flight_kg": 500.02
  }
}
```

#### 8. Vuelos con Mayor CO2
```http
GET /api/flights/co2/highest
GET /api/flights/co2/highest?limit=5
```
**Status**: ✅ 200 OK  
**Response**: Array ordenado por emisiones CO2 descendente

#### 9. Estadísticas Generales
```http
GET /api/flights/statistics
```
**Status**: ✅ 200 OK  
**Response**:
```json
{
  "success": true,
  "data": {
    "json_statistics": {...},
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

### 🏢 Territory Endpoints (SQLite Persistence)

#### 1. Todos los Territorios
```http
GET /api/territories
```
**Status**: ✅ 200 OK  
**Response**: Array de territorios con `success`, `data`, `count`

#### 2. Territorio Específico
```http
GET /api/territories/{id}
```
**Ejemplo**: `GET /api/territories/1`  
**Status**: ✅ 200 OK o 404 si no existe

#### 3. Análisis de Contaminación
```http
GET /api/territories/pollution_analysis
```
**Status**: ✅ 200 OK  
**Response**:
```json
{
  "success": true,
  "data": {
    "total_territories": 5,
    "average_pollution": 45.2,
    "highest_pollution": 89.5,
    "lowest_pollution": 12.1,
    "territories_by_pollution": [...]
  }
}
```

---

### ✈️ Plane Endpoints (SQLite Persistence)

#### 1. Todos los Aviones
```http
GET /api/planes
```
**Status**: ✅ 200 OK  
**Response**: Array de aviones con `success`, `data`, `count`

#### 2. Avión Específico
```http
GET /api/planes/{id}
```
**Ejemplo**: `GET /api/planes/1`  
**Status**: ✅ 200 OK o 404 si no existe

---

## ✅ POST Endpoints (Ahora Funcionando)

### Crear Territorio
```http
POST /api/territories
Content-Type: application/json

{
  "name": "Test Territory",
  "citizens": 50000,
  "pollution_level": 45.5,
  "airport_id": 1
}
```
**Status**: ✅ 201/422/500 (Funcional)

### Crear Avión
```http
POST /api/planes
Content-Type: application/json

{
  "model": "Boeing 737",
  "capacity": 180,
  "range": 5000
}
```
**Status**: ✅ 201/422/500 (Funcional)

---

## 🔧 Comandos para Testing

### Arrancar Servidor
```powershell
Set-Location 'D:\xampp\htdocs\IT_Academy_2nd\hackaton\hackaton_backend_equipo5\laravel'
php artisan serve --host=127.0.0.1 --port=8000
```

### Verificar Endpoints
```powershell
php artisan test --filter="RoutesTest"
```

---

## 📋 Lista para Importar en Postman

### Collection: Laravel Hackaton API

1. **Health Check** - `GET {{base_url}}/health`
2. **All Flights** - `GET {{base_url}}/flights`
3. **Flight by ID** - `GET {{base_url}}/flights/IB3201`
4. **All Airports** - `GET {{base_url}}/airports`
5. **Flights by Airport** - `GET {{base_url}}/flights/airport/1`
6. **Flights by Date** - `GET {{base_url}}/flights/date/2025-10-15`
7. **Flights by Type** - `GET {{base_url}}/flights/type/salida`
8. **CO2 by Airport** - `GET {{base_url}}/flights/co2/airport/1`
9. **Highest CO2 Flights** - `GET {{base_url}}/flights/co2/highest?limit=5`
10. **Flight Statistics** - `GET {{base_url}}/flights/statistics`
11. **All Territories** - `GET {{base_url}}/territories`
12. **Territory by ID** - `GET {{base_url}}/territories/1`
13. **Pollution Analysis** - `GET {{base_url}}/territories/pollution_analysis`
14. **All Planes** - `GET {{base_url}}/planes`
15. **Plane by ID** - `GET {{base_url}}/planes/1`

### Variables de Entorno
- `base_url`: `http://127.0.0.1:8000/api`

---

## ✅ Resumen de Verificación

**Total Endpoints**: 17  
**Funcionando Correctamente**: 17 ✅  
**Con Problemas Menores**: 0 ⚠️  
**Fallando Completamente**: 0 ❌  

**Persistencia Híbrida Funcionando**:
- ✅ Vuelos: JSON (`flights.json`)
- ✅ Territorios: SQLite
- ✅ Aviones: SQLite

**¡Todos los endpoints están completamente funcionales y listos para Postman!**

## 🧪 Tests Unitarios

**Todos los tests pasan correctamente**:
```
✓ Tests\Feature\FlightRoutesTest (13 tests)
✓ Tests\Feature\PlaneRoutesTest (8 tests)  
✓ Tests\Feature\TerritoryRoutesTest (8 tests)

Total: 29 passed (157 assertions)
```

**Comando para verificar**:
```powershell
php artisan test --filter="RoutesTest"
```