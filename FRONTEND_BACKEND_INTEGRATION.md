# 🔗 Integración Frontend-Backend - SkyImpact

## ✅ **CONFIGURACIÓN COMPLETADA**

### **🚀 Archivos Creados/Configurados:**

1. **📁 Environments:**
   - ✅ `src/environments/environment.ts` - Desarrollo (localhost:8000)
   - ✅ `src/environments/environment.prod.ts` - Producción (Render)

2. **🛠️ Servicios Angular:**
   - ✅ `src/app/services/territory.service.ts` - API Territorios
   - ✅ `src/app/services/plane.service.ts` - API Aviones  
   - ✅ `src/app/services/flight.service.ts` - API Vuelos
   - ✅ `src/app/services/error.interceptor.ts` - Manejo de errores HTTP
   - ✅ `src/app/services/error-handler.service.ts` - Utilidades de error

3. **🔧 Configuración:**
   - ✅ `proxy.conf.json` - Proxy para desarrollo local
   - ✅ `angular.json` - Configurado para usar proxy
   - ✅ `app.config.ts` - HttpClient e interceptores configurados
   - ✅ `package.json` - Scripts actualizados

4. **🧪 Componente de Prueba:**
   - ✅ `src/app/components/api-test.component.ts` - Tests de conectividad
   - ✅ Ruta `/api-test` agregada al navbar

## 🎯 **ENDPOINTS BACKEND DISPONIBLES**

### **Territorios:**
```
GET  /api/health                           # Health check
GET  /api/territories                      # Todos los territorios
GET  /api/territories/pollution_analysis   # Análisis contaminación
GET  /api/territories/{id}                 # Territorio específico
POST /api/territories                      # Crear territorio
```

### **Aviones:**
```
GET  /api/planes                          # Todos los aviones
GET  /api/planes/{id}                     # Avión específico
POST /api/planes                          # Crear avión
```

### **Vuelos:**
```
GET  /api/flights                         # Todos los vuelos
GET  /api/flights/statistics              # Estadísticas
GET  /api/flights/airport/{id}            # Por aeropuerto
GET  /api/flights/date/{date}             # Por fecha
GET  /api/flights/type/{type}             # Por tipo
GET  /api/flights/co2/airport/{id}        # CO2 por aeropuerto
GET  /api/flights/co2/highest             # Vuelos con mayor CO2
```

## 🏃‍♂️ **PASOS PARA PROBAR LA INTEGRACIÓN**

### **1. Preparar Backend Laravel:**
```bash
# Navegar al directorio del backend
cd laravel

# Instalar dependencias (si no está hecho)
composer install

# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# Iniciar servidor de desarrollo
php artisan serve
```

### **2. Preparar Frontend Angular:**
```bash
# Navegar al directorio del frontend
cd SkyImpact-front

# Instalar dependencias
npm install

# Iniciar con proxy (RECOMENDADO para desarrollo)
npm run start:proxy

# O iniciar normal
npm start
```

### **3. Probar Comunicación:**
1. **Abrir navegador:** `http://localhost:4200`
2. **Ir a "🔗 API Test"** en el navbar
3. **Hacer clic en los botones de prueba:**
   - ✅ Health Check
   - ✅ Obtener Territorios  
   - ✅ Análisis Contaminación
   - ✅ Obtener Aviones
   - ✅ Obtener Vuelos
   - ✅ Estadísticas

### **4. Verificar Resultados:**
- **✅ SUCCESS** = Comunicación exitosa
- **❌ ERROR** = Problema de conectividad

## 🚀 **PARA PRODUCCIÓN**

### **URLs de Producción:**
- **Backend:** `https://hackaton-backend-equipo5.onrender.com/api`
- **Frontend:** Será desplegado según configuración

### **Build de Producción:**
```bash
# Build optimizado para producción
npm run build:prod

# Los archivos se generan en dist/
```

## 🛠️ **SOLUCIÓN DE PROBLEMAS COMUNES**

### **❌ Error CORS:**
- **Verificar** que el backend tenga CORS configurado
- **Usar proxy** en desarrollo: `npm run start:proxy`

### **❌ Connection refused:**
- **Verificar** que Laravel esté ejecutándose en `http://localhost:8000`
- **Verificar** que no haya firewall bloqueando

### **❌ 404 Not Found:**
- **Verificar** rutas en `routes/api.php`
- **Verificar** que los endpoints existan

### **❌ 500 Internal Server Error:**
- **Verificar** logs de Laravel: `storage/logs/laravel.log`
- **Verificar** configuración de base de datos

## 📋 **SIGUIENTE PASOS SUGERIDOS**

1. **🎨 Integrar datos reales** en los componentes existentes
2. **📊 Crear dashboards** con datos de vuelos y territorios
3. **🗺️ Conectar mapas** con datos del backend
4. **📱 Optimizar UI/UX** para mostrar información
5. **🚀 Preparar deployment** de frontend

## 💡 **COMANDOS ÚTILES**

```bash
# Desarrollo con proxy
npm run start:proxy

# Desarrollo normal  
npm start

# Build de producción
npm run build:prod

# Verificar backend
curl http://localhost:8000/api/health

# Ver logs de Angular
# Abrir DevTools > Console en el navegador
```

---

🎉 **¡La integración está lista!** Ahora puedes usar los servicios Angular para comunicarte con la API Laravel de forma seamless.