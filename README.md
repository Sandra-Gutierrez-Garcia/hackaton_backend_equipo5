# ✈️ SkyImpact: Air Quality & Flight Impact Visualizer

## 📄 Description
SkyImpact is a web application designed to visualize the estimated impact of air traffic on air quality and public health.

Although the original goal was to build a fully interactive system that calculates pollution levels based on customizable parameters (monthly flight volume, route types, fuel consumption, etc.), this version focuses on two main visual components:

- 🌍 A map of Spanish airports showing detailed gas emission information
- 🛫 A flight map displaying departures and arrivals between selected airports

The project integrates an Angular 20 frontend with a Laravel 12 backend API, both running on a local environment due to deployment limitations.

## 🛠️ Tech Stack

### Frontend
- **Angular 20** - Frontend framework
- **Mapbox** & **Globe gl** for map visualization
- **Angular Material** for UI styling

### Backend
- **Laravel 12** (PHP)
- **REST API** endpoints connecting to flight and emission data
- **Composer** for dependency management

### Environment
Localhost setup with Node.js, npm, and PHP installed

## 📋 Requirements
To run the project locally, make sure you have:

- **Node.js** and **npm** installed → [https://nodejs.org](https://nodejs.org)
- **PHP** (≥8.2) and **Composer** installed → [https://getcomposer.org](https://getcomposer.org)
- **Angular CLI** globally installed:
  ```bash
  npm install -g @angular/cli
 ```

## 🛠️ Installation

✔️ Step-by-step setup
1️⃣ Clone the repository
```bash
git clone https://github.com/Sandra-Gutierrez-Garcia/hackaton_backend_equipo5.git
```
2️⃣ Navigate into the project folder

3️⃣ Install Angular dependencies

```bash
cd SkyImpact-front
```
```bash
npm install
```

4️⃣ Install Laravel dependencies
```bash
cd ..laravel
```
```bash
composer install
```


### ⚙️ Environment Configuration

# 🔧 Frontend (Angular)

1️⃣ Rename the example environment file:

mv src/environments/environment.example.ts src/environments/environment.ts


2️⃣ Edit the file to include your local API endpoint:
```bash
// src/environments/environment.ts
export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api'
};
```

# 🔧 Backend (Laravel)

1️⃣ Copy the environment template:

```bash
cp .env.example .env
```


2️⃣ Generate a Laravel app key:
```bash
php artisan key:generate
```

3️⃣ Update .env with your local configuration (database, ports, etc.)

## ▶️ Running the Application

🖥️ Run the Laravel API

From the backend directory:
```bash
php artisan serve
```

Your backend will run on http://localhost:8000

🌐 Run the Angular frontend

From the frontend directory:
```bash
ng serve
```

Open your browser at http://localhost:4200

The Angular app will fetch data from your local Laravel API.

## ✨ Summary

**Main Focus:** Interactive visualization of flight emissions and air routes

**Region Covered:** Spain

**Environment:** Local (not deployed yet)

## 📚 Authors
Developed by junior front end developers team as part of **Hackató Saló de l’Ocupació** focusing on team programming between front and back.
