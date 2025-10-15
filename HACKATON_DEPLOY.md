# 🚀 Deploy Hackaton - Render (SQLite)

## ✅ **CONFIGURACIÓN COMPLETADA**

### **Archivos preparados:**
- ✅ `render.yaml` - Configuración mínima para deploy
- ✅ `.env.example` - Variables esenciales solamente
- ✅ `config/cors.php` - CORS abierto para desarrollo
- ✅ `TerritoryController.php` - Health check incluido
- ✅ `routes/api.php` - Rutas sin autenticación

## 🎯 **CARACTERÍSTICAS PARA HACKATON**

### **Sin autenticación:**
- ❌ No Sanctum
- ❌ No Laravel Passport  
- ❌ No middleware de autenticación
- ❌ No tokens
- ✅ Acceso libre a toda la API

### **Configuración mínima:**
- ✅ SQLite (sin base de datos externa)
- ✅ CORS totalmente abierto
- ✅ Configuración de producción simplificada
- ✅ Health check para Render

## 🚀 **PASOS PARA DEPLOY**

### **1. Commit y push:**
```bash
git add .
git commit -m "Deploy config for hackaton - no auth required"
git push origin feature/territories
```

### **2. En Render.com:**
1. **New Web Service**
2. **Connect GitHub repo:** `hackaton_backend_equipo5`
3. **Branch:** `feature/territories` 
4. **Auto-deploy from `render.yaml`**

### **3. URLs resultantes:**
```
https://hackaton-backend-equipo5.onrender.com/api/health
https://hackaton-backend-equipo5.onrender.com/api/territories
https://hackaton-backend-equipo5.onrender.com/api/territories/{id}
POST https://hackaton-backend-equipo5.onrender.com/api/territories
```

## 🎨 **PARA EL FRONTEND**

### **Angular service example:**
```typescript
export class ApiService {
  private baseUrl = 'https://hackaton-backend-equipo5.onrender.com/api';

  constructor(private http: HttpClient) { }

  // Sin headers de autenticación necesarios
  getTerritories() {
    return this.http.get(`${this.baseUrl}/territories`);
  }

  createTerritory(data: any) {
    return this.http.post(`${this.baseUrl}/territories`, data);
  }
}
```

### **Test rápido:**
```bash
# Health check
curl https://hackaton-backend-equipo5.onrender.com/api/health

# Get territories
curl https://hackaton-backend-equipo5.onrender.com/api/territories
```

## ⚠️ **LIMITACIONES (Perfectas para hackaton)**

1. **Free Plan Render:**
   - Cold start: 30-60s primera request
   - Se duerme tras 15 min inactividad
   - SQLite temporal (datos se recrean en redeploys)

2. **Seguridad mínima:**
   - CORS abierto para todos los dominios
   - Sin autenticación ni autorización
   - Perfecto para desarrollo/demo rápido

## 📊 **DATOS DE PRUEBA**

- **6 territorios** precargados
- **3 aviones** precargados
- **Aeropuertos** configurados
- Se recrean automáticamente en cada deploy

## ✅ **LISTO PARA HACKATON**

**Todo configurado para máxima simplicidad:**
- Sin complicaciones de autenticación
- Deploy automático desde GitHub
- API REST funcional inmediatamente
- Frontend puede conectarse sin configuración especial

**Próximo paso:** Git push y configurar en Render 🚀