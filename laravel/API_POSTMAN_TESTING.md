# 🚀 API ENDPOINTS TESTING - POSTMAN GUIDE

## 📋 **CONFIGURACIÓN INICIAL**

### **Base URL Local:**
```
http://localhost:8000/api
```

### **Base URL Producción (Render):**
```
https://hackaton-backend-equipo5.onrender.com/api
```

### **Headers Requeridos:**
```
Content-Type: application/json
Accept: application/json
```

---

## 🏥 **HEALTH CHECK ENDPOINT**

### **GET /health**
**Descripción:** Verifica estado del API y conexión a base de datos

**Request:**
```http
GET {{base_url}}/health
```

**Response Esperado (200):**
```json
{
    "status": "OK",
    "message": "API is running",
    "database": "Connected (SQLite)",
    "territories_count": 10,
    "timestamp": "2025-10-15T10:30:00.000Z",
    "app_name": "Hackaton Backend API",
    "app_env": "production"
}
```

**✅ Test Postman:**
- Status Code: `200`
- Response Time: `< 1000ms`
- JSON válido
- Campo `status` = `"OK"`

---

## 🌍 **TERRITORIES ENDPOINTS**

### **1. GET /territories**
**Descripción:** Obtener todos los territorios

**Request:**
```http
GET {{base_url}}/territories
```

**Response Esperado (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Madrid",
            "citizens": 50000,
            "pollution_level": 45.50,
            "airport_id": 1,
            "created_at": "2025-10-15T10:00:00.000Z",
            "updated_at": "2025-10-15T10:00:00.000Z"
        }
    ],
    "count": 10
}
```

**✅ Test Postman:**
- Status Code: `200`
- Campo `success` = `true`
- Array `data` no vacío
- Campo `count` > 0

### **2. GET /territories/{id}**
**Descripción:** Obtener territorio específico

**Request:**
```http
GET {{base_url}}/territories/1
```

**Response Esperado (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Madrid",
        "citizens": 50000,
        "pollution_level": 45.50,
        "airport_id": 1,
        "created_at": "2025-10-15T10:00:00.000Z",
        "updated_at": "2025-10-15T10:00:00.000Z"
    }
}
```

**Response Error (404):**
```json
{
    "success": false,
    "message": "Territory not found"
}
```

**✅ Test Postman:**
- Status Code: `200` (existe) o `404` (no existe)
- Campo `success` = `true` (si existe)
- Objeto `data` válido

### **3. POST /territories**
**Descripción:** Crear nuevo territorio

**Request:**
```http
POST {{base_url}}/territories
Content-Type: application/json

{
    "name": "Barcelona",
    "citizens": 75000,
    "pollution_level": 38.5,
    "airport_id": 2
}
```

**Response Esperado (201):**
```json
{
    "success": true,
    "data": {
        "id": 11,
        "name": "Barcelona",
        "citizens": 75000,
        "pollution_level": 38.5,
        "airport_id": 2,
        "created_at": "2025-10-15T11:00:00.000Z",
        "updated_at": "2025-10-15T11:00:00.000Z"
    },
    "message": "Territory created successfully"
}
```

**Response Error (422):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": ["The name field is required."],
        "citizens": ["The citizens must be at least 0."]
    }
}
```

**✅ Test Postman:**
- Status Code: `201` (creado) o `422` (validación)
- Campo `success` = `true`
- Objeto `data` con nuevo `id`

### **4. GET /territories/pollution_analysis**
**Descripción:** Análisis de contaminación por territorios

**Request:**
```http
GET {{base_url}}/territories/pollution_analysis
```

**Response Esperado (200):**
```json
{
    "success": true,
    "data": {
        "total_territories": 10,
        "pollution_levels": {
            "high": {
                "count": 2,
                "territories": []
            },
            "medium": {
                "count": 5,
                "territories": []
            },
            "low": {
                "count": 3,
                "territories": []
            }
        },
        "most_polluted": {
            "name": "Industrial Zone",
            "pollution_level": 85.2
        },
        "cleanest": {
            "name": "Natural Park",
            "pollution_level": 12.1
        }
    }
}
```

---

## ✈️ **PLANES ENDPOINTS**

### **1. GET /planes**
**Descripción:** Obtener todos los aviones

**Request:**
```http
GET {{base_url}}/planes
```

**Response Esperado (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "model": "Boeing 737",
            "capacity": 180,
            "range_km": 5000,
            "flight_type": "commercial",
            "arrival_date": "2025-10-15T08:30:00.000Z",
            "departure_date": "2025-10-15T10:45:00.000Z",
            "created_at": "2025-10-15T07:00:00.000Z",
            "updated_at": "2025-10-15T07:00:00.000Z"
        }
    ],
    "count": 15
}
```

**✅ Test Postman:**
- Status Code: `200`
- Campo `success` = `true`
- Array `data` no vacío
- Campo `count` > 0

### **2. GET /planes/{id}**
**Descripción:** Obtener avión específico

**Request:**
```http
GET {{base_url}}/planes/1
```

**Response Esperado (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "model": "Boeing 737",
        "capacity": 180,
        "range_km": 5000,
        "flight_type": "commercial",
        "arrival_date": "2025-10-15T08:30:00.000Z",
        "departure_date": "2025-10-15T10:45:00.000Z"
    }
}
```

**✅ Test Postman:**
- Status Code: `200` (existe) o `404` (no existe)
- Campo `success` = `true`
- Objeto `data` válido

### **3. POST /planes**
**Descripción:** Crear nuevo avión

**Request:**
```http
POST {{base_url}}/planes
Content-Type: application/json

{
    "model": "Airbus A320",
    "capacity": 200,
    "range_km": 6000,
    "flight_type": "commercial",
    "arrival_date": "2025-10-16T14:30:00.000Z",
    "departure_date": "2025-10-16T16:45:00.000Z"
}
```

**Response Esperado (201):**
```json
{
    "success": true,
    "data": {
        "id": 16,
        "model": "Airbus A320",
        "capacity": 200,
        "range_km": 6000,
        "flight_type": "commercial",
        "arrival_date": "2025-10-16T14:30:00.000Z",
        "departure_date": "2025-10-16T16:45:00.000Z",
        "created_at": "2025-10-15T12:00:00.000Z",
        "updated_at": "2025-10-15T12:00:00.000Z"
    },
    "message": "Plane created successfully"
}
```

---

## 🧪 **POSTMAN COLLECTION SETUP**

### **Environment Variables:**
```json
{
    "base_url_local": "http://localhost:8000/api",
    "base_url_prod": "https://hackaton-backend-equipo5.onrender.com/api",
    "base_url": "{{base_url_local}}"
}
```

### **Pre-request Script Global:**
```javascript
// Set dynamic timestamp
pm.environment.set("timestamp", new Date().toISOString());

// Set random data for testing
pm.environment.set("random_name", "Test-" + Math.floor(Math.random() * 1000));
pm.environment.set("random_citizens", Math.floor(Math.random() * 100000));
pm.environment.set("random_pollution", Math.floor(Math.random() * 100));
```

### **Test Scripts Básicos:**
```javascript
// Health Check Tests
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});

pm.test("Response time is less than 1000ms", function () {
    pm.expect(pm.response.responseTime).to.be.below(1000);
});

pm.test("API is running", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.status).to.eql("OK");
});

// CRUD Tests
pm.test("Response has success field", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData).to.have.property('success');
});

pm.test("Data array exists", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.data).to.be.an('array');
});
```

---

## 🎯 **TESTING CHECKLIST PARA FRONTEND**

### **✅ Endpoints Validados:**
- [ ] **GET /health** - API funcionando
- [ ] **GET /territories** - Lista territorios
- [ ] **GET /territories/{id}** - Detalle territorio
- [ ] **POST /territories** - Crear territorio
- [ ] **GET /territories/pollution_analysis** - Análisis contaminación
- [ ] **GET /planes** - Lista aviones
- [ ] **GET /planes/{id}** - Detalle avión
- [ ] **POST /planes** - Crear avión

### **✅ Validaciones Frontend:**
- [ ] **CORS** - Sin errores de origen cruzado
- [ ] **JSON Format** - Respuestas consistentes
- [ ] **Error Handling** - Manejo de errores 404/500
- [ ] **Response Time** - < 2000ms aceptable
- [ ] **Data Structure** - Campos esperados presentes

### **📱 Integración Angular:**
```typescript
// service.ts
export interface Territory {
  id: number;
  name: string;
  citizens: number;
  pollution_level: number;
  airport_id?: number;
}

export interface ApiResponse<T> {
  success: boolean;
  data: T;
  count?: number;
  message?: string;
}
```

---

## 🚨 **ERRORES COMUNES Y SOLUCIONES**

| Error | Causa | Solución |
|-------|-------|----------|
| 500 Internal Server Error | Base de datos no conectada | Verificar SQLite y migraciones |
| 404 Not Found | Ruta incorrecta | Revisar URL y métodos HTTP |
| 422 Unprocessable Entity | Validación fallida | Verificar campos obligatorios |
| CORS Error | Configuración CORS | Verificar config/cors.php |
| Connection Timeout | Servidor caído | Verificar estado del servidor |

---

**📝 Notas para el Frontend:**
- Usar `base_url_prod` para producción
- Implementar retry logic para cold starts de Render
- Cachear respuestas de endpoints estáticos
- Mostrar loaders durante llamadas API