# 🚀 Blog & Developer Portfolio (Laravel + Docker)

[![PHP Version](https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![Nginx](https://img.shields.io/badge/Nginx-Alpine-009639?style=for-the-badge&logo=nginx&logoColor=white)](https://nginx.org)
[![MariaDB](https://img.shields.io/badge/MariaDB-Optimized-003545?style=for-the-badge&logo=mariadb&logoColor=white)](https://mariadb.org)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

Aplicación web full-stack de Blog y Portafolio profesional desarrollada con **Laravel**, diseñada y optimizada para ejecutarse en entornos de alta eficiencia y recursos limitados (ej. contenedores Docker en Droplets de DigitalOcean con 512 MB a 1 GB de RAM).

---

## 🌟 Características Principales

- **Panel Administrativo Protegido**: Gestión completa de artículos (CRUD), categorías, etiquetas (Many-to-Many) y subida de imágenes vinculadas.
- **Frontend Dinámico y Responsivo**: Vistas optimizadas en Blade, paginación nativa y navegación fluida.
- **Integración con Telegram Bot API**: Formulario de contacto directo con sanitización HTML y protección contra ataques por fuerza bruta (`Rate Limiting / Throttle`).
- **Arquitectura Limpia & SOLID**:
  - Validaciones desacopladas mediante **Form Requests** (`StorePostRequest`, `UpdatePostRequest`).
  - Eventos de modelo Eloquent (`booted()`) para eliminación en cascada de archivos multimedia físicos en storage.
  - Inyección de datos globales mediante **View Composers** con almacenamiento en caché.
- **Optimización de Rendimiento Extrema (N+1 Free)**:
  - Eliminación de consultas N+1 mediante **Eager Loading** (`with(['category', 'tags', 'photos'])`).
  - Índices dedicados en base de datos para búsquedas por `slug` (URL) y fechas de publicación.
  - PHP **OPcache** preconfigurado y compresión **Gzip** en Nginx.
- **Suite de Pruebas Automatizadas**: Tests funcionales con **PHPUnit** para validar seguridad, rutas públicas y flujo de contacto.

---

## 🛠️ Stack Tecnológico

| Capa | Tecnología |
| :--- | :--- |
| **Backend** | PHP 8.1, Laravel 8.x, Eloquent ORM |
| **Frontend** | Blade Templates, Tailwind CSS, JavaScript |
| **Base de Datos** | MariaDB 10.6 / MySQL con buffers optimizados para bajo consumo de RAM |
| **Servidor Web** | Nginx Alpine con compresión Gzip y expiración de caché estático |
| **Contenedores** | Docker Multi-Stage Build & Docker Compose |
| **Testing** | PHPUnit Feature & Unit Tests |

---

## 🐳 Despliegue Rápido con Docker

El proyecto cuenta con un entorno Docker listo para producción o desarrollo local sin requerir PHP ni Composer instalados en la máquina anfitriona:

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/blogapp.git
cd blogapp
```

### 2. Configurar variables de entorno
```bash
cp .env.example .env
```
> Ajusta las credenciales de base de datos y tus tokens de Telegram en `.env`.

### 3. Levantar los contenedores
```bash
docker compose up -d --build
```

### 4. Inicializar base de datos y storage
```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link
```

Visita la aplicación en tu navegador: `http://localhost`.

---

## ⚡ Estrategia de Optimización para VPS / Droplet Limitado (512MB / 1GB RAM)

Para alojar la aplicación con máxima velocidad en un Droplet de 1 vCPU y 1 GB de RAM en DigitalOcean:

1. **Configurar Memoria Swap (2 GB)**:
   ```bash
   sudo fallocate -l 2G /swapfile
   sudo chmod 600 /swapfile
   sudo mkswap /swapfile
   sudo swapon /swapfile
   echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
   ```
2. **Ajuste de MySQL / MariaDB**:
   El archivo `docker-compose.yml` limita el `innodb_buffer_pool_size` a **64MB** y reduce el número de conexiones simultáneas para evitar caídas por OOM (Out Of Memory).
3. **Ajuste de PHP-FPM**:
   Configurado en modo `ondemand` (`pm.max_children = 5`, `pm.process_idle_timeout = 10s`) reduciendo el consumo base de RAM a menos de **50MB**.
4. **Caché en Producción**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## 🧪 Pruebas Automatizadas (Testing)

Para ejecutar la suite de pruebas funcionales:

```bash
# En entorno local con PHP:
php artisan test

# O mediante Docker:
docker compose exec app php artisan test
```

### Cobertura de pruebas incluida:
- `HomePageTest`: Renderizado de página principal, portafolio y artículos publicados.
- `AdminSecurityTest`: Verificación de protección de rutas y redirección a login para usuarios no autenticados.
- `ContactTelegramTest`: Validación de campos requeridos y simulación de envío exitoso a la API de Telegram.

---

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](LICENSE).
