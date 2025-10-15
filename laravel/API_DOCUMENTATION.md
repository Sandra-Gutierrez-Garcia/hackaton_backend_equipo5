# 🚀 API Documentation - Backend Hackaton

## 📋 Información General

### Backend Info
- **Framework**: Laravel 11
- **Base de Datos**: SQLite
- **Puerto**: 8000 (por defecto)
- **Autenticación**: No requerida
- **CORS**: Configurado para desarrollo

### URL Base
```
http://localhost:8000/api
```

---

## 🌐 Endpoints Disponibles

### 📍 Territories

#### 1. **GET /api/territories**
Obtener todos los territorios

**Request:**
```http
GET http://localhost:8000/api/territories
Content-Type: application/json
```

**Response (200 OK):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Barcelona",
            "citizens": 5500000,
            "pollution_level": "75.50",
            "airport_id": 1,
            "created_at": "2025-10-15T10:30:00.000000Z",
            "updated_at": "2025-10-15T10:30:00.000000Z"
        },
        {
            "id": 2,
            "name": "Helsinki",
            "citizens": 1200000,
            "pollution_level": "40.30",
            "airport_id": 2,
            "created_at": "2025-10-15T10:31:00.000000Z",
            "updated_at": "2025-10-15T10:31:00.000000Z"
        }
    ],
    "count": 6
}
```

---

#### 2. **GET /api/territories/{id}**
Obtener un territorio específico

**Request:**
```http
GET http://localhost:8000/api/territories/1
Content-Type: application/json
```

**Response (200 OK):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Barcelona",
        "citizens": 5500000,
        "pollution_level": "75.50",
        "airport_id": 1,
        "created_at": "2025-10-15T10:30:00.000000Z",
        "updated_at": "2025-10-15T10:30:00.000000Z"
    }
}
```

**Response (404 Not Found):**
```json
{
    "success": false,
    "message": "Territory not found"
}
```

---

#### 3. **POST /api/territories**
Crear un nuevo territorio

**Request:**
```http
POST http://localhost:8000/api/territories
Content-Type: application/json

{
    "name": "Valencia",
    "citizens": 800000,
    "pollution_level": 35.75,
    "airport_id": 3
}
```

**Response (201 Created):**
```json
{
    "success": true,
    "data": {
        "id": 7,
        "name": "Valencia",
        "citizens": 800000,
        "pollution_level": "35.75",
        "airport_id": 3,
        "created_at": "2025-10-15T11:00:00.000000Z",
        "updated_at": "2025-10-15T11:00:00.000000Z"
    },
    "message": "Territory created successfully"
}
```

**Response (422 Validation Error):**
```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "name": ["The name field is required."],
        "citizens": ["The citizens must be an integer."]
    }
}
```

---

## 📊 Estructura de Datos

### Territory Model
```typescript
interface Territory {
    id: number;
    name: string;
    citizens: number;
    pollution_level: string; // decimal con 2 decimales
    airport_id: number | null;
    created_at: string; // ISO 8601
    updated_at: string; // ISO 8601
}
```

### Validación POST /territories
```typescript
interface CreateTerritoryRequest {
    name: string;        // required, max 255 caracteres
    citizens: number;    // required, mínimo 0
    pollution_level: number; // required, entre 0 y 100
    airport_id?: number; // opcional
}
```

---

## 🔧 Cómo Iniciar el Backend

### 1. Instalación y Setup
```bash
# Navegar al directorio del proyecto
cd hackaton_backend_equipo5/laravel

# Instalar dependencias (si es necesario)
composer install

# Verificar que existe la base de datos
dir database\database.sqlite

# Ejecutar migraciones (si es necesario)
php artisan migrate:fresh --seed
```

### 2. Iniciar el Servidor
```bash
# Iniciar servidor de desarrollo
php artisan serve

# El servidor estará disponible en:
# http://localhost:8000
```

### 3. Verificar que Funciona
```bash
# Verificar rutas disponibles
php artisan route:list --path=api

# Probar endpoint básico
curl http://localhost:8000/api/territories
```

---

## 🧪 Ejemplos de Uso con JavaScript

### Fetch Todos los Territorios
```javascript
const fetchTerritories = async () => {
    try {
        const response = await fetch('http://localhost:8000/api/territories');
        const data = await response.json();
        
        if (data.success) {
            console.log('Territorios:', data.data);
            console.log('Total:', data.count);
        }
    } catch (error) {
        console.error('Error:', error);
    }
};
```

### Fetch Territorio Específico
```javascript
const fetchTerritory = async (id) => {
    try {
        const response = await fetch(`http://localhost:8000/api/territories/${id}`);
        const data = await response.json();
        
        if (data.success) {
            console.log('Territorio:', data.data);
        } else {
            console.log('Error:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
};
```

### Crear Nuevo Territorio
```javascript
const createTerritory = async (territoryData) => {
    try {
        const response = await fetch('http://localhost:8000/api/territories', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(territoryData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            console.log('Territorio creado:', data.data);
        } else {
            console.log('Error:', data.message);
            if (data.errors) {
                console.log('Errores de validación:', data.errors);
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
};

// Ejemplo de uso
createTerritory({
    name: "Madrid",
    citizens: 3200000,
    pollution_level: 62.5,
    airport_id: 1
});
```

---

## 🧪 Ejemplos con cURL

### GET Todos los Territorios
```bash
curl -X GET http://localhost:8000/api/territories \
  -H "Content-Type: application/json"
```

### GET Territorio Específico
```bash
curl -X GET http://localhost:8000/api/territories/1 \
  -H "Content-Type: application/json"
```

### POST Crear Territorio
```bash
curl -X POST http://localhost:8000/api/territories \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Sevilla",
    "citizens": 700000,
    "pollution_level": 45.2,
    "airport_id": 2
  }'
```

---

## 📊 Datos de Prueba Disponibles

El backend viene con datos de prueba pre-poblados:

### Territorios (6 registros)
1. **Barcelona** - 5,500,000 ciudadanos, 75.50% contaminación
2. **Helsinki** - 1,200,000 ciudadanos, 40.30% contaminación
3. **Abu Dhabi** - 3,000,000 ciudadanos, 60.80% contaminación
4. **+ 3 territorios generados con Factory**

### Aviones (3 registros)
1. **Boeing 737** - 189 pasajeros, vuelo internacional
2. **Airbus A320** - 180 pasajeros, vuelo internacional
3. **Cessna 172** - 4 pasajeros, vuelo nacional

---

## 🔴 Códigos de Estado HTTP

| Código | Descripción | Cuándo se usa |
|--------|-------------|---------------|
| 200 | OK | GET exitoso |
| 201 | Created | POST exitoso |
| 404 | Not Found | Recurso no encontrado |
| 422 | Unprocessable Entity | Errores de validación |
| 500 | Internal Server Error | Error del servidor |

---

## 🐛 Troubleshooting

### Problemas Comunes

#### 1. **Error: Connection refused**
```bash
# Verificar que el servidor está ejecutándose
php artisan serve

# Verificar el puerto (debería mostrar localhost:8000)
```

#### 2. **Error 404 en rutas API**
```bash
# Verificar que las rutas están registradas
php artisan route:list --path=api

# Si no aparecen, verificar bootstrap/app.php
```

#### 3. **Base de datos vacía**
```bash
# Re-poblar la base de datos
php artisan migrate:fresh --seed
```

#### 4. **Errores de CORS**
```javascript
// Si tienes problemas de CORS, instala el paquete:
// composer require fruitcake/laravel-cors

// O usar un proxy en desarrollo (React):
// "proxy": "http://localhost:8000"
```

---

## 🎯 Para el Equipo Frontend

### Lo que tienes disponible:
✅ **3 endpoints REST** completamente funcionales  
✅ **Datos de prueba** poblados y consistentes  
✅ **Respuestas JSON** estructuradas con `success`, `data`, `message`  
✅ **Validación** implementada en POST  
✅ **Sin autenticación** requerida  
✅ **Documentación completa** con ejemplos  

### Próximos pasos recomendados:
1. Probar endpoints con Postman/curl
2. Implementar las llamadas en tu aplicación frontend
3. Manejar estados de loading y errores
4. Implementar formularios para CREATE
5. Añadir paginación si es necesario

### Contacto Backend:
- Cualquier duda o modificación necesaria, contactar al equipo backend
- Todos los endpoints están listos para producción/demo

---

**Estado**: ✅ **LISTO PARA INTEGRACIÓN**  
**Fecha**: 15 de Octubre, 2025  
**Versión**: 1.0