# 🧪 Tutorial Testing Auto Delete Shipments

## 📋 Persiapan Testing

### 1. Pastikan Database Siap ✅
```bash
# Semua tabel sudah dibuat - skip migration conflicts
# Langsung cek command tersedia
```

### 2. Verifikasi Command Tersedia ✅
```bash
php artisan list | findstr shipments
```
**Expected Output:** `shipments:delete-expired`

### 3. Quick Test - Cek Command Berjalan ✅
```bash
php artisan shipments:delete-expired --dry-run
```
**Expected Output:** `✅ No expired shipments found.`ing Auto Delete Shipments

## 📋 Persiapan Testing

### 1. Pastikan Database Siap
```bash
# Cek status migration
php artisan migrate:status

# Jalankan migration jika ada yang pending (hati-hati dengan conflicts)
php artisan migrate
```

### 2. Verifikasi Command Tersedia
```bash
php artisan list | findstr shipments
```
Pastikan muncul: `shipments:delete-expired`

---

## 🔍 **Method 1: Testing dengan Database Manual**

### Step 1: Cek Data Shipment Saat Ini
```bash
# Cek tabel shipments
php artisan db:table shipments

# Atau cek dengan SQL di phpMyAdmin
SELECT shipment_id, vessel_name, closing_cargo, deleted_at FROM shipments LIMIT 10;
```

### Step 2: Update Closing Cargo Secara Manual
Buka **phpMyAdmin** atau tool database Anda:

```sql
-- Lihat data shipment yang ada
SELECT shipment_id, vessel_name, closing_cargo, deleted_at FROM shipments;

-- Set closing cargo ke 6 hari yang lalu (akan kena auto delete)
UPDATE shipments 
SET closing_cargo = DATE_SUB(NOW(), INTERVAL 6 DAY) 
WHERE shipment_id = 'SHP001';

-- Set closing cargo ke 4 hari yang lalu (belum kena auto delete)
UPDATE shipments 
SET closing_cargo = DATE_SUB(NOW(), INTERVAL 4 DAY) 
WHERE shipment_id = 'SHP002';

-- Set closing cargo ke 1 hari yang lalu (belum kena auto delete)
UPDATE shipments 
SET closing_cargo = DATE_SUB(NOW(), INTERVAL 1 DAY) 
WHERE shipment_id = 'SHP003';
```

### Step 3: Test Command dengan Dry Run
```bash
php artisan shipments:delete-expired --dry-run
```

**Expected Result:**
- Menampilkan table shipment yang akan dihapus
- SHP001 harus muncul dalam daftar (6 hari > 5 hari)
- SHP002 dan SHP003 tidak muncul (4 hari dan 1 hari < 5 hari)

### Step 4: Jalankan Command Actual Delete
```bash
php artisan shipments:delete-expired
```

### Step 5: Verifikasi Soft Delete
```sql
-- Cek apakah shipment ter-soft delete
SELECT shipment_id, vessel_name, closing_cargo, deleted_at 
FROM shipments 
WHERE deleted_at IS NOT NULL;

-- Cek shipment yang masih aktif
SELECT shipment_id, vessel_name, closing_cargo, deleted_at 
FROM shipments 
WHERE deleted_at IS NULL;
```

---

## 🔍 **Method 2: Testing dengan Command Options**

### Test Different Days Parameter
```bash
# Test dengan 3 hari
php artisan shipments:delete-expired --days=3 --dry-run

# Test dengan 7 hari
php artisan shipments:delete-expired --days=7 --dry-run

# Test dengan 1 hari
php artisan shipments:delete-expired --days=1 --dry-run
```

---

## 🔍 **Method 3: Testing Dashboard Integration**

### Step 1: Buat Test Data
```sql
-- Insert shipment baru untuk testing
INSERT INTO shipments (shipment_id, from_city, to_city, vessel_name, closing_cargo, open_stack, etd, eta, freight_20, freight_40, created_at, updated_at) 
VALUES 
('TEST001', 'surabaya', 'jakarta', 'MV TEST VESSEL 1', DATE_SUB(NOW(), INTERVAL 6 DAY), NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), DATE_ADD(NOW(), INTERVAL 3 DAY), 500000, 800000, NOW(), NOW()),
('TEST002', 'surabaya', 'jakarta', 'MV TEST VESSEL 2', DATE_ADD(NOW(), INTERVAL 2 DAY), NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), DATE_ADD(NOW(), INTERVAL 5 DAY), 500000, 800000, NOW(), NOW());
```

### Step 2: Test Dashboard Sebelum Auto Delete
1. Buka browser ke `/dashboard`
2. Search: **POL:** Surabaya, **POD:** Jakarta
3. **Expected:** Harus muncul 2 shipment (TEST001 dan TEST002)

### Step 3: Jalankan Auto Delete
```bash
php artisan shipments:delete-expired --days=5
```

### Step 4: Test Dashboard Setelah Auto Delete
1. Refresh dashboard
2. Search: **POL:** Surabaya, **POD:** Jakarta
3. **Expected:** Hanya muncul TEST002 (TEST001 sudah ter-soft delete)

---

## 🔍 **Method 4: Testing Scheduled Task**

### Step 1: Test Schedule Command
```bash
php artisan schedule:list
```
**Expected:** Muncul `shipments:delete-expired` dalam daftar scheduled command

### Step 2: Test Manual Schedule Run
```bash
php artisan schedule:run
```

### Step 3: Cek Log File
```bash
type storage\logs\auto-delete-shipments.log
```
**Expected:** Muncul log hasil eksekusi auto delete

---

## 🔍 **Method 5: Testing Error Scenarios**

### Test 1: Command dengan Parameter Salah
```bash
# Test dengan days negative
php artisan shipments:delete-expired --days=-1
```

### Test 2: Test dengan Database Kosong
```sql
DELETE FROM shipments;
```
```bash
php artisan shipments:delete-expired --dry-run
```
**Expected:** "No expired shipments found"

---

## ✅ **Checklist Validasi**

### ✅ Command Testing
- [ ] Command tersedia di artisan list
- [ ] Dry run menampilkan data yang benar
- [ ] Actual delete berfungsi dengan konfirmasi
- [ ] Parameter --days berfungsi dengan benar
- [ ] Error handling untuk edge cases

### ✅ Database Testing  
- [ ] Kolom deleted_at ter-create dengan migration
- [ ] Soft delete berfungsi (deleted_at terisi, data masih ada)
- [ ] Query dashboard tidak menampilkan data ter-delete
- [ ] Data histori user masih tersimpan

### ✅ Integration Testing
- [ ] Dashboard tidak menampilkan shipment ter-delete
- [ ] Booking masih bisa dilakukan untuk shipment aktif
- [ ] Search functionality tetap berjalan normal

### ✅ Scheduling Testing
- [ ] Schedule terdaftar di Laravel
- [ ] Manual schedule run berjalan
- [ ] Log file ter-generate

---

## 🚨 **Troubleshooting**

### Problem: Command tidak ditemukan
```bash
php artisan clear-compiled
php artisan config:cache
```

### Problem: Migration gagal
```bash
php artisan migrate:rollback --step=1
php artisan migrate
```

### Problem: Soft delete tidak berfungsi
Pastikan Model Shipment sudah menggunakan `SoftDeletes` trait.

### Problem: Schedule tidak jalan
Pastikan cron job server sudah disetup:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 📊 **Monitoring & Maintenance**

### Cek Shipments yang Akan Dihapus
```bash
php artisan shipments:delete-expired --dry-run
```

### Cek Log Auto Delete
```bash
tail -f storage/logs/auto-delete-shipments.log
```

### Manual Cleanup untuk Testing
```sql
-- Reset semua soft delete untuk testing ulang
UPDATE shipments SET deleted_at = NULL WHERE deleted_at IS NOT NULL;

-- Delete test data
DELETE FROM shipments WHERE shipment_id LIKE 'TEST%';
```