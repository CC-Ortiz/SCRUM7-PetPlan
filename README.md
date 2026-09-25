# 🐾 PetPlan

Plataforma web para gestionar citas, vacunas e historial clínico de mascotas. Hecha en Laravel 12 + Blade + MySQL.

## Cómo clonar y correr el proyecto

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio>
cd SCRUM7-PetPlan

# 2. Instalar dependencias PHP
composer install

# 3. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 4. Revisar/ajustar credenciales en .env (ya vienen listas por defecto)
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=petplan
#    DB_USERNAME=root
#    DB_PASSWORD=

# 5. Revisar/Configurar MAIL en .env
# MAIL_MAILER=smtp
# MAIL_HOST=smtp.gmail.com
# MAIL_PORT=587
# MAIL_USERNAME=scrum7petplan@gmail.com
# MAIL_PASSWORD=dnuhpmvmbwvfqssz
# MAIL_ENCRYPTION=tls
# MAIL_FROM_ADDRESS=scrum7petplan@gmail.com
# MAIL_FROM_NAME="PetPlan"

# 6. Migrar y sembrar datos base
php artisan migrate --seed

# 6. Levantar el servidor
php artisan serve
```

Abre **http://127.0.0.1:8000** en el navegador.

### Credenciales de Veterinario (ya viene creado por el seeder)

| Email | Contraseña |
|---|---|
| `laura.gomez@petplan.test` | `veterinario123` |
| `andres.rios@petplan.test` | `veterinario123` |
