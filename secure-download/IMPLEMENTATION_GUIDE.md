# 🚀 Quick Implementation Guide

## Step-by-Step Instructions (15 minutes)

### Step 1: Backup Current Files (2 min)
```bash
cd /Applications/MAMP/htdocs/your-project
cp -r . ../project-backup-$(date +%Y%m%d)
```

### Step 2: Create New .htaccess Files (3 min)

#### Create `includes/.htaccess`
```bash
cat > includes/.htaccess << 'EOF'
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
    Order Allow,Deny
    Deny from all
</IfModule>
EOF
```

#### Create `logs/.htaccess`
```bash
cat > logs/.htaccess << 'EOF'
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
    Order Allow,Deny
    Deny from all
</IfModule>
EOF
```

#### Create `assets/pdf/.htaccess`
```bash
cat > assets/pdf/.htaccess << 'EOF'
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
    Order Allow,Deny
    Deny from all
</IfModule>
EOF
```

### Step 3: Enable mod_headers in MAMP (2 min)

1. Stop MAMP servers
2. Edit Apache config:
```bash
nano /Applications/MAMP/conf/apache/httpd.conf
```

3. Find and uncomment (remove #):
```apache
LoadModule headers_module modules/mod_headers.so
```

4. Also find `<Directory "/Applications/MAMP/htdocs">` and ensure:
```apache
AllowOverride All
```

5. Save and restart MAMP

### Step 4: Replace Files with Secured Versions (5 min)

Replace these files with the artifacts I provided:

1. **Root directory:**
   - `index.php` → Enhanced index.php
   - `download.php` → Hardened download.php
   - `.htaccess` → Enhanced .htaccess
   - `403.php` → NEW FILE
   - `404.php` → NEW FILE

2. **en/ directory:**
   - `files.php` → Enhanced en/files.php
   - `disclaimer.php` → Enhanced en/disclaimer.php

3. **de/ directory:**
   - Update `files.php` - Add these lines at the top (after require statements):
   ```php
   // Security headers
   header('X-Content-Type-Options: nosniff');
   header('X-Frame-Options: SAMEORIGIN');
   header('X-XSS-Protection: 1; mode=block');
   ```

   - Update `disclaimer.php` - Add the same security headers

4. **tests/ directory:**
   - `security_test.php` → Fixed security_test.php

### Step 5: Test the Implementation (3 min)

#### Quick Manual Tests:

1. **Test direct PDF access (should fail):**
```bash
curl -I http://localhost/assets/pdf/en/DLH-DIP-2016-Base-Prospectus.pdf
# Expected: 403 Forbidden
```

2. **Test includes access (should fail):**
```bash
curl -I http://localhost/includes/config.php
# Expected: 403 Forbidden
```

3. **Test security headers:**
```bash
curl -I http://localhost/index.php | grep "X-Content-Type-Options"
# Expected: X-Content-Type-Options: nosniff
```

4. **Test path traversal protection:**
```bash
curl "http://localhost/download.php?id=../../../etc/passwd&lang=en"
# Expected: "Invalid document ID" or "Document not found"
```

#### Run Automated Tests:
```bash
cd /Applications/MAMP/htdocs/your-project
php tests/security_test.php http://localhost
```

## Expected Test Results

### ✅ Should PASS (28-30 tests):
- All CSRF Protection tests
- Session security
- Config/Functions file protection
- Log file protection
- Path traversal protection (all 5 tests)
- SQL injection protection (all 5 tests)
- XSS protection (all 5 tests)
- Access control tests
- Input validation tests

### ⚠️ May show WARNING (0-2 tests):
- Some HTTP header tests (if mod_headers partially working)
- Direct PDF Access (INFO/WARNING - acceptable if .htaccess blocks access)

### ❌ Should NOT FAIL:
- No tests should fail if all steps completed correctly

## Troubleshooting

### Problem: "mod_headers not found"
**Solution:**
```bash
# Edit httpd.conf
nano /Applications/MAMP/conf/apache/httpd.conf

# Find and uncomment:
LoadModule headers_module modules/mod_headers.so

# Restart MAMP
```

### Problem: ".htaccess not working"
**Solution:**
```bash
# Check AllowOverride in httpd.conf
nano /Applications/MAMP/conf/apache/httpd.conf

# Find <Directory "/Applications/MAMP/htdocs"> section
# Change: AllowOverride None
# To: AllowOverride All

# Restart MAMP
```

### Problem: "Headers still not appearing"
**Solution:**
The PHP `header()` calls in the updated files will work even if `.htaccess` headers don't. This is acceptable for development.

### Problem: "Can't download PDFs through download.php"
**Checklist:**
1. Is there a session active? (Select country first)
2. Check logs/access.log for errors
3. Verify file exists in `assets/pdf/en/` or `assets/pdf/de/`
4. Check file permissions: `chmod 644 assets/pdf/en/*.pdf`

### Problem: "Test shows 'Download - No Auth: FAIL'"
**Solution:**
This happens if `checkAccess(true)` isn't redirecting properly. Verify:
1. Session is starting: `startSecureSession()` is called
2. No output before headers in download.php
3. Clear browser cookies and test again

## Verification Checklist

After implementation, verify:

- [ ] MAMP restarted with updated config
- [ ] All .htaccess files created in correct directories
- [ ] All PHP files updated with security headers
- [ ] 403.php and 404.php created
- [ ] Direct access to /includes/ returns 403
- [ ] Direct access to /logs/ returns 403
- [ ] Direct access to PDFs returns 403
- [ ] Can still download PDFs through download.php after login
- [ ] Security test shows 28+ tests passing
- [ ] No critical failures in security test

## Quick Test Script

Create a file `quick-test.sh` in your project root:

```bash
#!/bin/bash

echo "=== Quick Security Test ==="
echo ""

echo "1. Testing includes protection..."
curl -s -I http://localhost/includes/config.php | grep "403"

echo "2. Testing logs protection..."
curl -s -I http://localhost/logs/access.log | grep "403"

echo "3. Testing PDF protection..."
curl -s -I http://localhost/assets/pdf/en/DLH-DIP-2016-Base-Prospectus.pdf | grep "403"

echo "4. Testing security headers..."
curl -s -I http://localhost/index.php | grep "X-Content-Type-Options"
curl -s -I http://localhost/index.php | grep "X-Frame-Options"
curl -s -I http://localhost/index.php | grep "X-XSS-Protection"

echo ""
echo "=== Test Complete ==="
```

Run with:
```bash
chmod +x quick-test.sh
./quick-test.sh
```

All tests should show matching lines with "403" or the security headers.

---

## Next Steps

1. ✅ Complete all steps above
2. ✅ Run security test: `php tests/security_test.php http://localhost`
3. ✅ Review test log in `tests/test-logs/`
4. ✅ Fix any remaining warnings
5. 🎉 Deploy to production when all tests pass!

**Time to complete: ~15 minutes**
**Difficulty: Easy**

If you encounter issues, check the detailed SECURITY_DEPLOYMENT_CHECKLIST.md