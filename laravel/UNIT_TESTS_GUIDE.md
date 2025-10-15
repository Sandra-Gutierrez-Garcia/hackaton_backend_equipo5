# Laravel API - Tests Unitarios de Rutas

Este documento describe cómo ejecutar los tests unitarios para verificar que todas las rutas de los endpoints están configuradas correctamente.

## Archivos de Test Creados

### 1. FlightRoutesTest.php
Testa todos los endpoints relacionados con vuelos (persistencia JSON):
- `GET /api/flights` - Todos los vuelos
- `GET /api/flights/{id}` - Vuelo específico (soporta ID de vuelo e índices numéricos)
- `GET /api/airports` - Todos los aeropuertos
- `GET /api/flights/airport/{id}` - Vuelos por aeropuerto
- `GET /api/flights/date/{date}` - Vuelos por fecha
- `GET /api/flights/type/{type}` - Vuelos por tipo (entrada/salida)
- `GET /api/flights/co2/airport/{id}` - CO2 total por aeropuerto
- `GET /api/flights/co2/highest` - Vuelos con mayor emisión CO2
- `GET /api/flights/statistics` - Estadísticas generales

### 2. TerritoryRoutesTest.php
Testa todos los endpoints relacionados con territorios (persistencia SQLite):
- `GET /api/health` - Health check del sistema
- `GET /api/territories` - Todos los territorios
- `GET /api/territories/{id}` - Territorio específico
- `POST /api/territories` - Crear territorio
- `GET /api/territories/pollution_analysis` - Análisis de contaminación

### 3. PlaneRoutesTest.php
Testa todos los endpoints relacionados con aviones (persistencia SQLite):
- `GET /api/planes` - Todos los aviones
- `GET /api/planes/{id}` - Avión específico
- `POST /api/planes` - Crear avión

## Comandos para Ejecutar Tests

### Ejecutar Todos los Tests de Rutas
```powershell
Set-Location 'D:\xampp\htdocs\IT_Academy_2nd\hackaton\hackaton_backend_equipo5\laravel'
php artisan test --filter="RoutesTest"
```

### Ejecutar Tests por Categoría

#### Tests de Vuelos (JSON)
```powershell
php artisan test tests/Feature/FlightRoutesTest.php
```

#### Tests de Territorios (SQLite)
```powershell
php artisan test tests/Feature/TerritoryRoutesTest.php
```

#### Tests de Aviones (SQLite)
```powershell
php artisan test tests/Feature/PlaneRoutesTest.php
```

### Ejecutar Test Individual
```powershell
# Ejemplo: solo el test de index de vuelos
php artisan test --filter="test_flights_index_route_exists_and_returns_json"

# Ejemplo: solo el health check
php artisan test --filter="test_health_check_route_exists"
```

## Lo que Validan los Tests

### ✅ Estructura de Respuestas JSON
- Todos los endpoints retornan JSON con campo `success`
- Códigos de estado HTTP correctos (200, 201, 404, 500)
- Estructura de datos esperada

### ✅ Rutas Configuradas Correctamente
- Prefijo `/api` aplicado correctamente
- Métodos HTTP permitidos (GET, POST)
- Parámetros de ruta funcionando

### ✅ Manejo de Errores
- 404 para recursos inexistentes
- Estructura de error consistente

### ✅ Persistencia Híbrida
- Vuelos usando JSON (`flights.json`)
- Territorios y aviones usando SQLite
- Ambos sistemas funcionando independientemente

## Resultados Esperados

Los tests validan que:

1. **Endpoints de Vuelos (JSON)**: Leen correctamente de `flights.json`
2. **Endpoints de Territorios**: Conectan a SQLite correctamente
3. **Endpoints de Aviones**: Conectan a SQLite correctamente
4. **Health Check**: Monitorea estado del sistema
5. **Rutas con Parámetros**: Manejan IDs correctamente
6. **Filtros**: Funcionan por fecha, tipo, aeropuerto, etc.

## Troubleshooting

### Si Fallan Tests de SQLite
```powershell
# Verificar base de datos
php artisan migrate:fresh
php artisan db:seed
```

### Si Fallan Tests de JSON
```powershell
# Verificar que existe flights.json
ls flights.json
```

### Ver Detalles de Fallos
```powershell
# Para mayor detalle en errores
php artisan test --stop-on-failure
```

## Comandos de Desarrollo

### Ejecutar con Servidor Local
```powershell
# Terminal 1: Servidor Laravel
php artisan serve --host=127.0.0.1 --port=8000

# Terminal 2: Tests
php artisan test
```

### Verificar Rutas Registradas
```powershell
php artisan route:list
```

### Cache de Rutas (si es necesario)
```powershell
php artisan route:clear
php artisan config:clear
```

## Integración con Postman

Una vez que pasen todos los tests, puedes probar manualmente en Postman:

**Base URL**: `http://localhost:8000/api`

**Endpoints Testeados**:
- `GET /health`
- `GET /flights`
- `GET /flights/IB3201`
- `GET /airports`
- `GET /territories`
- `GET /planes`

Los tests garantizan que estos endpoints funcionen antes de hacer testing manual o integración con Angular frontend.