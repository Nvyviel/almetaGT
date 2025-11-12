# 🎯 CARA TESTING AUTO DELETE SHIPMENTS

## 📋 System Status (READY ✅)
- ✅ Database tables created
- ✅ Command available: `shipments:delete-expired`
- ✅ Auto scheduling setup
- ✅ Dashboard integration ready

---

## 🚀 **TESTING METHOD 1: Quick Test (Recommended)**

### Step 1: Insert Test Data
Buka **phpMyAdmin**, jalankan SQL ini:

```sql
-- Insert 3 test shipments dengan waktu berbeda
INSERT INTO shipments (shipment_id, from_city, to_city, vessel_name, closing_cargo, open_stack, etd, eta, freight_20, freight_40, created_at, updated_at) 
VALUES 
-- 6 hari lalu (AKAN DIHAPUS)
('TEST_DELETE', 'surabaya', 'jakarta', 'MV TEST DELETE', DATE_SUB(NOW(), INTERVAL 6 DAY), NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), DATE_ADD(NOW(), INTERVAL 3 DAY), 500000, 800000, NOW(), NOW()),
-- 2 hari lalu (TIDAK DIHAPUS) 
('TEST_KEEP', 'surabaya', 'jakarta', 'MV TEST KEEP', DATE_SUB(NOW(), INTERVAL 2 DAY), NOW(), DATE_ADD(NOW(), INTERVAL 2 DAY), DATE_ADD(NOW(), INTERVAL 4 DAY), 500000, 800000, NOW(), NOW()),
-- Masa depan (TIDAK DIHAPUS)
('TEST_FUTURE', 'surabaya', 'jakarta', 'MV TEST FUTURE', DATE_ADD(NOW(), INTERVAL 2 DAY), NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), DATE_ADD(NOW(), INTERVAL 5 DAY), 500000, 800000, NOW(), NOW());
```

### Step 2: Test Dry Run
```bash
php artisan shipments:delete-expired --dry-run
```
**Expected:** Harus muncul `TEST_DELETE` dalam table yang akan dihapus

### Step 3: Jalankan Auto Delete
```bash
php artisan shipments:delete-expired
```
**Ketik `y` untuk konfirmasi**

### Step 4: Verifikasi Hasil
```sql
-- Cek hasil soft delete
SELECT shipment_id, vessel_name, closing_cargo, deleted_at 
FROM shipments 
WHERE shipment_id LIKE 'TEST_%'
ORDER BY shipment_id;
```

**Expected Results:**
- `TEST_DELETE`: `deleted_at` terisi (soft deleted)
- `TEST_KEEP`: `deleted_at` NULL (masih aktif)  
- `TEST_FUTURE`: `deleted_at` NULL (masih aktif)

### Step 5: Test Dashboard Integration
1. Buka browser: `http://localhost/dashboard`
2. Search: **POL:** Surabaya, **POD:** Jakarta
3. **Expected:** Hanya muncul `TEST_KEEP` dan `TEST_FUTURE`
4. `TEST_DELETE` tidak muncul karena sudah ter-soft delete

### Step 6: Cleanup
```sql
-- Hapus test data
DELETE FROM shipments WHERE shipment_id LIKE 'TEST_%';
```

---

## 🔬 **TESTING METHOD 2: Command Options**

### Test Different Days Parameter
```bash
# Test 3 hari threshold
php artisan shipments:delete-expired --days=3 --dry-run

# Test 7 hari threshold  
php artisan shipments:delete-expired --days=7 --dry-run

# Test 1 hari threshold
php artisan shipments:delete-expired --days=1 --dry-run
```

### Test Error Scenarios
```bash
# Test dengan parameter invalid
php artisan shipments:delete-expired --days=-1

# Test dengan database kosong
php artisan shipments:delete-expired --dry-run
```

---

## 📊 **TESTING METHOD 3: Schedule Testing**

### Test Scheduled Task
```bash
# Cek schedule terdaftar
php artisan schedule:list
# Expected: shipments:delete-expired muncul

# Test manual run scheduler
php artisan schedule:run

# Cek log hasil
type storage\logs\auto-delete-shipments.log
```

---

## ✅ **Validation Checklist**

### Command Testing
- [ ] ✅ Command tersedia di artisan list
- [ ] ✅ Dry run menampilkan data yang benar
- [ ] ✅ Actual delete berfungsi dengan konfirmasi
- [ ] ✅ Parameter --days berfungsi dengan benar
- [ ] ✅ Error handling untuk edge cases

### Database Testing
- [ ] ✅ Soft delete berfungsi (deleted_at terisi, data masih ada)
- [ ] ✅ Query dashboard mengecualikan data ter-delete
- [ ] ✅ Data histori user masih tersimpan (untuk booking history)

### Integration Testing  
- [ ] ✅ Dashboard tidak menampilkan shipment ter-delete
- [ ] ✅ Search functionality tetap berjalan normal
- [ ] ✅ Booking button disable masih berfungsi untuk shipment aktif

### Scheduling Testing
- [ ] ✅ Schedule terdaftar di Laravel
- [ ] ✅ Manual schedule run berjalan
- [ ] ✅ Log file ter-generate

---

## 🛠️ **Troubleshooting**

### Problem: Command tidak ditemukan
```bash
php artisan config:clear
php artisan cache:clear
```

### Problem: Soft delete tidak berfungsi  
Cek Model Shipment menggunakan `SoftDeletes` trait:
```php
use Illuminate\Database\Eloquent\SoftDeletes;
class Shipment extends Model {
    use SoftDeletes;
}
```

### Problem: Dashboard masih tampilkan data ter-delete
Cek query controller menggunakan `whereNull('deleted_at')`:
```php
Shipment::where('to_city', $pod)
        ->where('from_city', $pol)  
        ->whereNull('deleted_at')  // This line
        ->get();
```

---

## 📈 **Monitoring Commands**

### Cek Shipments yang Akan Dihapus
```bash
php artisan shipments:delete-expired --dry-run
```

### Cek Log Auto Delete  
```bash
# Windows
type storage\logs\auto-delete-shipments.log

# Check recent entries
Get-Content storage\logs\auto-delete-shipments.log -Tail 20
```

### Manual Cleanup untuk Testing Ulang
```sql
-- Reset semua soft delete untuk testing ulang
UPDATE shipments SET deleted_at = NULL WHERE deleted_at IS NOT NULL;

-- Delete all test data
DELETE FROM shipments WHERE shipment_id LIKE 'TEST_%';
```

---

## 🎉 **SUCCESS CRITERIA**

✅ **Command berjalan tanpa error**  
✅ **Soft delete sesuai dengan rule 5+ hari**  
✅ **Dashboard tidak menampilkan data ter-delete**  
✅ **Schedule berjalan otomatis**  
✅ **Log ter-generate dengan benar**  

**Auto Delete System berhasil!** 🚀