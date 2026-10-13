# TugasWeb-P11-EcommerceAuth

Tugas Rutin Pertemuan 11 — E-Commerce Database + Secure Auth Laravel dengan multi-role (admin/editor/user), Eloquent relationships, seeders, factories, middleware, dan policy.

---

## 🛠️ Langkah Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/necromancerbot1/TugasWeb-P11-EcommerceAuth.git
cd TugasWeb-P11-EcommerceAuth
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Buka `.env`, sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tugaspertemuan11
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
Buat database baru bernama `tugaspertemuan11` di phpMyAdmin atau HeidiSQL.

### 5. Jalankan Migration + Seeder
```bash
php artisan migrate --seed
```

### 6. Buat Storage Link
```bash
php artisan storage:link
```

### 7. Jalankan Server
```bash
php artisan serve
```

Buka browser → **http://127.0.0.1:8000**

---

## 👤 Akun Demo

| Role   | Email                    | Password  |
|--------|--------------------------|-----------|
| Admin  | admin@tugasweb.com       | password  |
| Editor | editor@tugasweb.com      | password  |
| User   | user@tugasweb.com        | password  |

---

## 📁 Struktur Folder

```
TugasWeb-P11-EcommerceAuth/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php         ← Login + redirect by role
│   │   │   │   ├── RegisterController.php      ← Register sebagai user
│   │   │   │   └── LogoutController.php
│   │   │   ├── Admin/
│   │   │   │   ├── AdminDashboardController.php ← Stats + recent data
│   │   │   │   ├── AdminProductController.php   ← CRUD produk
│   │   │   │   ├── AdminOrderController.php     ← Kelola + update status order
│   │   │   │   └── AdminUserController.php      ← Kelola user + ubah role
│   │   │   ├── Editor/
│   │   │   │   ├── EditorDashboardController.php
│   │   │   │   └── EditorProductController.php  ← Create & edit produk (no delete)
│   │   │   └── User/
│   │   │       ├── UserDashboardController.php
│   │   │       └── UserOrderController.php      ← Lihat order milik sendiri
│   │   └── Middleware/
│   │       ├── RoleMiddleware.php               ← Custom middleware multi-role
│   │       └── RedirectIfAuthenticated.php      ← Redirect by role setelah login
│   ├── Models/
│   │   ├── User.php        ← SoftDeletes + role helper (isAdmin, isEditor, isUser)
│   │   ├── Role.php        ← Relationship ke users
│   │   ├── Category.php    ← Scope: withProductCount
│   │   ├── Product.php     ← SoftDeletes + scopes: active, inStock, popular, cheapest
│   │   ├── Order.php       ← SoftDeletes + scopes: pending, delivered, byStatus
│   │   ├── OrderItem.php   ← Belongs to Order & Product
│   │   └── Review.php      ← Scope: highRated, unique per user+product
│   └── Policies/
│       ├── ProductPolicy.php ← Otorisasi create/update/delete per role
│       ├── OrderPolicy.php   ← Admin lihat semua, user lihat milik sendiri
│       └── ReviewPolicy.php  ← User edit/delete review miliknya
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_roles_table.php
│   │   ├── 2024_01_01_000002_create_users_table.php       ← FK ke roles
│   │   ├── 2024_01_01_000003_create_categories_table.php
│   │   ├── 2024_01_01_000004_create_products_table.php    ← FK ke categories
│   │   ├── 2024_01_01_000005_create_orders_table.php      ← FK ke users
│   │   ├── 2024_01_01_000006_create_order_items_table.php ← FK ke orders & products
│   │   └── 2024_01_01_000007_create_reviews_table.php     ← FK ke users & products
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── RoleSeeder.php     ← 3 roles: admin, editor, user
│   │   ├── UserSeeder.php     ← 3 akun demo + 10 user factory
│   │   ├── CategorySeeder.php ← 8 kategori
│   │   ├── ProductSeeder.php  ← 50+ produk realistis
│   │   ├── OrderSeeder.php    ← Order + order items
│   │   └── ReviewSeeder.php   ← Review dengan rating 3-5
│   └── factories/
│       ├── UserFactory.php    ← State: admin(), editor()
│       └── ProductFactory.php ← State: active(), outOfStock()
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php     ← Layout sidebar hitam-biru-putih
│   ├── auth/
│   │   ├── login.blade.php   ← Form login + akun demo
│   │   └── register.blade.php
│   ├── admin/
│   │   └── dashboard.blade.php ← Stats, recent orders, top products, users
│   ├── editor/
│   │   └── dashboard.blade.php ← Stats produk, daftar produk terbaru
│   └── user/
│       └── dashboard.blade.php ← Stats order, recent orders, featured products
└── routes/
    └── web.php               ← Route protection per role dengan middleware
```

---

## 🌐 Route Protection

| Prefix    | Middleware         | Role yang Diizinkan  |
|-----------|--------------------|----------------------|
| `/admin`  | `auth, role:admin` | Admin saja           |
| `/editor` | `auth, role:admin,editor` | Admin & Editor  |
| `/user`   | `auth, role:admin,editor,user` | Semua role  |
| `/login`  | `guest`            | Belum login          |
| `/register` | `guest`          | Belum login          |

---

## 🗄️ Dokumentasi Query Tinker

Jalankan `php artisan tinker` lalu coba query berikut:

**Query 1 — Produk aktif dengan stok tersedia:**
```php
App\Models\Product::active()->inStock()->with('category')->get();
```

**Query 2 — 5 produk paling populer:**
```php
App\Models\Product::popular()->active()->take(5)->get(['id','name','price']);
```

**Query 3 — Order pending milik user tertentu:**
```php
App\Models\User::find(4)->orders()->pending()->with('items.product')->get();
```

**Query 4 — Review dengan rating tinggi beserta produknya:**
```php
App\Models\Review::highRated(4)->with('user', 'product')->get();
```

**Query 5 — Total revenue dari order delivered:**
```php
App\Models\Order::delivered()->sum('total_price');
```

---

## ✅ Checklist Requirement

### Bagian A — Database & Eloquent
- [x] Migrations 7 tabel e-commerce + FK constraints
- [x] Seeders + factories (50+ produk realistis)
- [x] Model + relationships + minimal 1 scope per model
- [x] Dokumentasi 5 query Tinker

### Bagian B — Auth & Security
- [x] Install Breeze (custom — login/register/logout manual)
- [x] Multi-role (admin/editor/user) + custom middleware `RoleMiddleware`
- [x] `ProductPolicy` untuk otorisasi edit/delete
- [x] Route protection + testing incognito 2 role

### Bonus
- [x] Eager loading demo (with('category'), with('user'), with('items.product'))
