# Panduan Cron Job cPanel untuk Laravel

Panduan lengkap menggunakan Cron Job di cPanel untuk menjalankan perintah Artisan Laravel tanpa akses terminal.

## 1. Akses Cron Job di cPanel

1. **Login ke cPanel**
2. Cari menu **"Cron Jobs"** di bagian Advanced
3. Klik untuk membuka interface Cron Jobs

## 2. Format Cron Job

### Struktur Waktu Cron:
```
* * * * * command
│ │ │ │ │
│ │ │ │ └─── Hari dalam minggu (0-7, 0 dan 7 = Minggu)
│ │ │ └───── Bulan (1-12)
│ │ └─────── Hari dalam bulan (1-31)
│ └───────── Jam (0-23)
└─────────── Menit (0-59)
```

### Contoh Setting Waktu:
- **Manual**: `0 0 1 1 0` (Tidak otomatis)
- **Harian**: `0 2 * * *` (Setiap hari jam 2 pagi)
- **Mingguan**: `0 3 * * 0` (Setiap Minggu jam 3 pagi)
- **Bulanan**: `0 4 1 * *` (Tanggal 1 setiap bulan jam 4 pagi)

## 3. Template Command untuk Laravel

### Basic Template:
```bash
cd /home/username/public_html && /usr/bin/php artisan COMMAND
```

**Catatan:**
- Ganti `/home/username/public_html` dengan path hosting Anda
- Ganti `/usr/bin/php` dengan path PHP di hosting (cek di cPanel → PHP Selector)

## 4. Perintah Artisan Umum

### A. Optimasi Cache

**Cache Semua (Optimize):**
```bash
cd /home/username/public_html && /usr/bin/php artisan optimize
```
- **Kapan**: Setelah deploy/update code
- **Frekuensi**: Manual atau setelah perubahan

**Clear Cache:**
```bash
cd /home/username/public_html && /usr/bin/php artisan optimize:clear
```
- **Kapan**: Troubleshooting atau maintenance
- **Frekuensi**: Mingguan (Minggu jam 3 pagi)

### B. Cache Individual

**Config Cache:**
```bash
cd /home/username/public_html && /usr/bin/php artisan config:cache
```

**Route Cache:**
```bash
cd /home/username/public_html && /usr/bin/php artisan route:cache
```

**View Cache:**
```bash
cd /home/username/public_html && /usr/bin/php artisan view:cache
```

**Event Cache:**
```bash
cd /home/username/public_html && /usr/bin/php artisan event:cache
```

### C. Database Commands

**Migration:**
```bash
cd /home/username/public_html && /usr/bin/php artisan migrate --force
```
- **Kapan**: Deploy pertama atau update schema
- **Frekuensi**: Manual saja

**Seeder:**
```bash
cd /home/username/public_html && /usr/bin/php artisan db:seed --force
```

### D. Storage & Maintenance

**Storage Link:**
```bash
cd /home/username/public_html && /usr/bin/php artisan storage:link
```

**Queue Processing:**
```bash
cd /home/username/public_html && /usr/bin/php artisan queue:work --stop-when-empty
```
- **Frekuensi**: Setiap menit `* * * * *`

**Clear Expired Sessions:**
```bash
cd /home/username/public_html && /usr/bin/php artisan session:gc
```

## 5. Skenario Cron Job Setup

### A. Setup Awal (Manual Execution)

**Setting Waktu:** `0 0 1 1 0` (Tidak otomatis)

1. **Optimize untuk Production:**
```bash
cd /home/username/public_html && /usr/bin/php artisan optimize
```

2. **Create Storage Link:**
```bash
cd /home/username/public_html && /usr/bin/php artisan storage:link
```

3. **Run Migration:**
```bash
cd /home/username/public_html && /usr/bin/php artisan migrate --force
```

4. **Run Seeder:**
```bash
cd /home/username/public_html && /usr/bin/php artisan db:seed --force
```

### B. Maintenance Rutin

**Harian (2 AM) - Cache Optimization:**
```
Minute: 0
Hour: 2
Day: *
Month: *
Weekday: *

Command: cd /home/username/public_html && /usr/bin/php artisan optimize
```

**Mingguan (Minggu 3 AM) - Clear Cache:**
```
Minute: 0
Hour: 3
Day: *
Month: *
Weekday: 0

Command: cd /home/username/public_html && /usr/bin/php artisan optimize:clear
```

**Queue Processing (Setiap Menit):**
```
Minute: *
Hour: *
Day: *
Month: *
Weekday: *

Command: cd /home/username/public_html && /usr/bin/php artisan queue:work --stop-when-empty
```

### C. Development/Testing

**Clear Cache (Manual):**
```bash
cd /home/username/public_html && /usr/bin/php artisan cache:clear
```

**Clear Config (Manual):**
```bash
cd /home/username/public_html && /usr/bin/php artisan config:clear
```

**Clear Views (Manual):**
```bash
cd /home/username/public_html && /usr/bin/php artisan view:clear
```

## 6. Path Configuration

### Mencari Path PHP:
1. **cPanel → PHP Selector** → lihat PHP Binary Path
2. **Common paths:**
   - `/usr/bin/php`
   - `/usr/local/bin/php`
   - `/opt/cpanel/ea-php82/root/usr/bin/php`

### Mencari Path Project:
1. **File Manager** → lihat current directory
2. **Common paths:**
   - `/home/username/public_html`
   - `/home/username/domains/yourdomain.com/public_html`

## 7. Email Notifications

### Enable Email Output:
```bash
# Kirim output ke email
cd /home/username/public_html && /usr/bin/php artisan optimize > /tmp/optimize.log 2>&1; cat /tmp/optimize.log
```

### Disable Email Output:
```bash
# Tidak kirim email
cd /home/username/public_html && /usr/bin/php artisan optimize > /dev/null 2>&1
```

## 8. Monitoring & Logging

### Log Output ke File:
```bash
cd /home/username/public_html && /usr/bin/php artisan optimize >> /home/username/logs/cron.log 2>&1
```

### Timestamped Logging:
```bash
cd /home/username/public_html && echo "$(date): Starting optimize" >> /home/username/logs/cron.log && /usr/bin/php artisan optimize >> /home/username/logs/cron.log 2>&1
```

## 9. Troubleshooting

### Common Issues:

**Permission Denied:**
- Check path PHP binary
- Check path project directory
- Verify cPanel user permissions

**Command Not Found:**
- Use absolute path: `/usr/bin/php` bukan `php`
- Check PHP version di cPanel

**Database Connection Error:**
- Verify .env configuration
- Check database credentials
- Ensure database host accessible

**Memory/Time Limit:**
```bash
# Increase limits
cd /home/username/public_html && /usr/bin/php -d memory_limit=256M -d max_execution_time=300 artisan optimize
```

### Debug Mode:
```bash
# Verbose output
cd /home/username/public_html && /usr/bin/php artisan optimize -v
```

## 10. Best Practices

### ✅ DO:
- Test commands manual dulu sebelum dijadwalkan
- Use absolute paths untuk PHP dan project
- Set email notifications untuk error monitoring
- Log output untuk debugging
- Use `--force` flag untuk production commands

### ❌ DON'T:
- Jangan run migration/seeder di production secara otomatis
- Jangan set cron terlalu frequent untuk heavy commands
- Jangan hardcode sensitive data di cron command
- Jangan lupa disable email untuk routine tasks

## 11. Template Cron Jobs untuk HMTI Project

```bash
# 1. Daily Cache Optimization (2 AM)
0 2 * * * cd /home/username/public_html && /usr/bin/php artisan optimize > /dev/null 2>&1

# 2. Weekly Cache Clear (Sunday 3 AM)  
0 3 * * 0 cd /home/username/public_html && /usr/bin/php artisan optimize:clear > /dev/null 2>&1

# 3. Queue Processing (Every Minute)
* * * * * cd /home/username/public_html && /usr/bin/php artisan queue:work --stop-when-empty > /dev/null 2>&1

# 4. Session Cleanup (Daily 4 AM)
0 4 * * * cd /home/username/public_html && /usr/bin/php artisan session:gc > /dev/null 2>&1

# 5. Manual Commands (Set as needed)
# Migration: cd /home/username/public_html && /usr/bin/php artisan migrate --force
# Seeder: cd /home/username/public_html && /usr/bin/php artisan db:seed --force  
# Storage Link: cd /home/username/public_html && /usr/bin/php artisan storage:link
```

Dengan panduan ini, Anda dapat menjalankan semua perintah Artisan Laravel menggunakan Cron Job cPanel tanpa perlu akses terminal!