# CRM Import/Export (Laravel 10)

Projekt prikazuje proces **uvoza podatkov iz Excela**, prenos v CRM tabelo in **izvoz v Excel**.  
Namen: simulacija integracije med spletno trgovino in CRM sistemom.

---

## 🚀 Zahteve
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js (za lokalni strežnik `php artisan serve`)

---

## 🔧 Namestitev

1. Ustvari nov Laravel projekt:
   ```bash
   composer create-project laravel/laravel crm-project
   cd crm-project
- composer require maatwebsite/excel  namestitev paketa za obdelavo excel datotek

###V .env se nastasvi baza
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=crm_db
- DB_USERNAME=root
- DB_PASSWORD=

###  Nato sledi ukaz:
- php artisan migrate

### Excel datoteko se kopira v 
- database/seeders/podatki-test.xlsx

### Napolnimo bazo z seederjem
- php artisan db:seed --class=ExcelImportSeeder

### Prenos podatkov iz tabele v CRM
- php artisan transfer:crm

### Zaženemo projekt ter obiščemo pot
- php artisan serve
- http://127.0.0.1:8000/export-crm

