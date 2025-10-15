# Documentación de Base de Datos - Hackaton Backend

## 📋 Índice
- [Configuración General](#-configuración-general)
- [Modelos](#️-modelos)
- [Migraciones](#-migraciones)
- [Factories](#-factories)
- [Seeders](#-seeders)
- [Relaciones](#-relaciones)
- [Comandos Útiles](#-comandos-útiles)

---

## 🔧 Configuración General

### Base de Datos
- **Tipo**: SQLite
- **Archivo**: `database/database.sqlite`
- **Configuración**: `.env` con `DB_CONNECTION=sqlite`

### Estructura del Proyecto
```
database/
├── database.sqlite
├── migrations/
│   ├── 2025_10_15_095456_create_territories_table.php
│   ├── 2025_10_15_104738_crate_planes_table.php
│   └── 2025_10_15_104713_create_airports_table.php
├── factories/
│   ├── TerritoryFactory.php
│   ├── PlaneFactory.php
│   └── AirportFactory.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── TerritorySeeder.php
    ├── PlaneSeeder.php
    └── AirportSeeder.php
```

---

## 🏗️ Modelos

### TerritoryModel
```php
Tabla: territories
Ubicación: app/Models/TerritoryModel.php

Campos:
- id (Primary Key)
- name (string)
- citizens (integer)
- pollution_level (decimal 5,2)
- airport_id (integer, nullable)
- created_at, updated_at (timestamps)

Fillable:
['name', 'citizens', 'pollution_level', 'airport_id']

Casts:
- citizens: integer
- pollution_level: decimal:2
- airport_id: integer

Relaciones:
- belongsTo(AirportModel::class, 'airport_id')
```

### PlaneModel
```php
Tabla: planes
Ubicación: app/Models/PlaneModel.php

Campos:
- id (Primary Key)
- model (string)
- capacity (integer)
- range_km (integer)
- flight_type (enum: 'national', 'international', 'private')
- arrival_date (datetime)
- departure_date (datetime)
- created_at, updated_at (timestamps)

Fillable:
['model', 'capacity', 'range_km', 'flight_type', 'arrival_date', 'departure_date']

Casts:
- capacity: integer
- range_km: integer
- arrival_date: datetime
- departure_date: datetime

Factory: PlaneFactory
```

### AirportModel
```php
Tabla: airports
Ubicación: app/Models/AirportModel.php

Campos:
- id (Primary Key)
- name (string)
- territory_id (integer)
- plane_id (integer)
- capacity (integer)
- runaways (integer)
- created_at, updated_at (timestamps)

Fillable:
['name', 'territory_id', 'plane_id', 'capacity', 'runaways']

Casts:
- territory_id: integer
- plane_id: integer
- capacity: integer
- runaways: integer

Relaciones:
- belongsTo(TerritoryModel::class, 'territory_id')
- belongsTo(PlaneModel::class, 'plane_id')
```

---

## 📊 Migraciones

### Create Territories Table
**Archivo**: `2025_10_15_095456_create_territories_table.php`

```php
Schema::create('territories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('citizens');
    $table->decimal('pollution_level', 5, 2);
    $table->unsignedBigInteger('airport_id')->nullable();
    $table->timestamps();
});
```

### Create Planes Table
**Archivo**: `2025_10_15_104738_crate_planes_table.php`

```php
Schema::create('planes', function (Blueprint $table) {
    $table->id();
    $table->string('model');
    $table->integer('capacity');
    $table->integer('range_km');
    $table->enum('flight_type', ['national', 'international', 'private']);
    $table->dateTime('arrival_date');
    $table->dateTime('departure_date');
    $table->timestamps();
});
```

### Create Airports Table
**Archivo**: `2025_10_15_104713_create_airports_table.php`

```php
Schema::create('airports', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->unsignedBigInteger('territory_id');
    $table->unsignedBigInteger('plane_id');
    $table->integer('capacity');
    $table->integer('runaways');
    $table->timestamps();
});
```

---

## 🏭 Factories

### TerritoryFactory
**Archivo**: `database/factories/TerritoryFactory.php`

```php
public function definition(): array
{
    return [
        'name' => $this->faker->randomElement([
            'Barcelona', 'Helsinki', 'Abu Dhabi'
        ]),
        'citizens' => $this->faker->numberBetween(1000, 100000),
        'pollution_level' => $this->faker->randomFloat(2, 0, 100),
        'airport_id' => $this->faker->numberBetween(1, 3)
    ];
}
```

### PlaneFactory
**Archivo**: `database/factories/PlaneFactory.php`

```php
public function definition(): array
{
    $arrivalDate = $this->faker->dateTimeBetween('now', '+7 days');
    $departureDate = $this->faker->dateTimeBetween($arrivalDate, '+2 days');

    return [
        'model' => $this->faker->randomElement([
            'Boeing 737', 'Airbus A320', 'Boeing 777', 'Airbus A350', 
            'Boeing 787', 'Embraer E190', 'Bombardier CRJ900'
        ]),
        'capacity' => $this->faker->numberBetween(50, 400),
        'range_km' => $this->faker->numberBetween(1000, 15000),
        'flight_type' => $this->faker->randomElement(['national', 'international', 'private']),
        'arrival_date' => $arrivalDate,
        'departure_date' => $departureDate
    ];
}
```

### AirportFactory
**Archivo**: `database/factories/AirportFactory.php`

```php
public function definition(): array
{
    return [
        'name' => $this->faker->randomElement([
            'Barcelona-El Prat', 'Madrid-Barajas', 'Valencia Airport'
        ]),
        'territory_id' => $this->faker->numberBetween(1, 3),
        'plane_id' => $this->faker->numberBetween(1, 3),
        'capacity' => $this->faker->numberBetween(100, 10000),
        'runaways' => $this->faker->numberBetween(1, 4)
    ];
}
```

---

## 🌱 Seeders

### DatabaseSeeder
**Archivo**: `database/seeders/DatabaseSeeder.php`

```php
public function run(): void
{
    $this->call([
        TerritorySeeder::class,
        PlaneSeeder::class,
    ]);
}
```

### TerritorySeeder
**Archivo**: `database/seeders/TerritorySeeder.php`

- **Factory**: 3 registros aleatorios con `TerritoryModel::factory(3)->create()`
- **Datos manuales**:
  - Barcelona: 5,500,000 ciudadanos, 75.50% contaminación
  - Helsinki: 1,200,000 ciudadanos, 40.30% contaminación  
  - Abu Dhabi: 3,000,000 ciudadanos, 60.80% contaminación
- **Total**: 6 territorios

### PlaneSeeder
**Archivo**: `database/seeders/PlaneSeeder.php`

- **Datos manuales**:
  - Boeing 737: 189 pasajeros, 5600km alcance, internacional
  - Airbus A320: 180 pasajeros, 6100km alcance, internacional
  - Cessna 172: 4 pasajeros, 1280km alcance, nacional
- **Total**: 3 aviones

---

## 🔗 Relaciones

### Diagrama de Relaciones
```
Territory (1) ←→ (0..1) Airport (1) ←→ (0..1) Plane
```

### Explicación
- **Territory**: Puede tener un aeropuerto asociado (`airport_id`)
- **Airport**: Pertenece a un territorio específico y tiene aviones asignados
- **Plane**: Puede estar asignado a un aeropuerto

### Uso en Código
```php
// Obtener territorio con su aeropuerto
$territory = TerritoryModel::with('airport')->find(1);

// Obtener aeropuerto con territorio y avión
$airport = AirportModel::with(['territory', 'plane'])->find(1);
```

---

## ⚡ Comandos Útiles

### Configuración Inicial
```bash
# Crear archivo SQLite (Windows)
New-Item -Path "database/database.sqlite" -ItemType File -Force

# Ejecutar migraciones frescas
php artisan migrate:fresh

# Ejecutar seeders específicos
php artisan db:seed --class=TerritorySeeder
php artisan db:seed --class=PlaneSeeder

# Todo junto
php artisan migrate:fresh --seed
```

### Verificación
```bash
# Ver estado de migraciones
php artisan migrate:status

# Ver lista de rutas
php artisan route:list --path=api

# Acceder a tinker
php artisan tinker
```

### En Tinker - Verificar Datos
```php
// Contar registros
\App\Models\TerritoryModel::count();
\App\Models\PlaneModel::count();

// Ver todos los territorios
\App\Models\TerritoryModel::all();

// Ver primer avión
\App\Models\PlaneModel::first();

// Salir
exit
```

### Creación de Componentes
```bash
# Crear modelo con migración y factory
php artisan make:model ModelName -mf

# Crear seeder
php artisan make:seeder ModelSeeder

# Crear controlador
php artisan make:controller ModelController

# Crear controlador con recursos REST
php artisan make:controller ModelController --resource
```

---

## 🌐 API Endpoints

### Territories
- **GET** `/api/territories` - Obtener todos los territorios
- **GET** `/api/territories/{id}` - Obtener territorio específico  
- **POST** `/api/territories` - Crear nuevo territorio

### Ejemplo de Respuesta JSON
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
        }
    ],
    "message": "Territories retrieved successfully"
}
```

### Controlador
**Archivo**: `app/Http/Controllers/TerritoryController.php`

Métodos implementados:
- `index()` - GET todos los territorios
- `show($id)` - GET territorio específico
- `store(Request $request)` - POST crear territorio

---

## 📝 Notas de Desarrollo

### Problemas Comunes y Soluciones

1. **Error "no such table: plane_models"**
   - **Causa**: Falta especificar `protected $table = 'planes'` en PlaneModel
   - **Solución**: Agregar la propiedad `$table` en todos los modelos

2. **Enum values incorrectos**
   - **Causa**: Valores en seeders no coinciden con enum en migración
   - **Solución**: Usar solo valores permitidos: 'national', 'international', 'private'

3. **Foreign key constraints**
   - **Causa**: Referencias a IDs que no existen
   - **Solución**: Ejecutar seeders en orden correcto o usar factories

4. **Errores en tinker**
   - **Causa**: Conflictos de PHP o cache
   - **Solución**: `php artisan config:clear` y `composer dump-autoload`

### Configuración para Frontend
- ✅ Sin autenticación requerida para hackaton
- ✅ CORS configurado para desarrollo local
- ✅ Respuestas JSON estructuradas con `success`, `data`, `message`
- ✅ Validación de datos en endpoints POST

### Datos de Prueba Disponibles
- **Territorios**: 6 registros (3 factory + 3 manuales)
- **Aviones**: 3 registros manuales específicos
- **Aeropuertos**: Según configuración (pendiente de implementar)

---

## 🚀 Deploy Ready

La base de datos está preparada para:
- ✅ Integración con frontend React/Vue/Angular
- ✅ Endpoints REST API funcionales
- ✅ Datos de prueba poblados y consistentes
- ✅ Relaciones entre modelos configuradas
- ✅ Validaciones implementadas en controladores
- ✅ Documentación completa para el equipo

### Próximos Pasos
1. Implementar endpoints para PlaneModel
2. Crear y poblar AirportSeeder
3. Configurar middleware de CORS si es necesario
4. Agregar paginación para grandes datasets
5. Implementar filtros y búsqueda en endpoints

---

**Última actualización**: 15 de Octubre, 2025  
**Estado**: Listo para desarrollo frontend  
**Contacto**: Equipo Backend Hackaton