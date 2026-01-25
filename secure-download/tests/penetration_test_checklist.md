# PENETRATION TEST CHECKLIST

## 1. Authentication & Session Management
- [ ] Test session timeout (should expire after inactivity)
- [ ] Test session fixation (cannot set custom session ID)
- [ ] Test session hijacking (HttpOnly cookies prevent JavaScript access)
- [ ] Test concurrent sessions (multiple sessions handled correctly)
- [ ] Test logout functionality (session destroyed properly)

## 2. Authorization & Access Control
- [ ] Access /en/files.php without selecting country → Should redirect to index.php
- [ ] Access /en/disclaimer.php without selecting country → Should redirect to index.php
- [ ] Select AU-NZ, try to access /en/files.php → Should show no_access.php
- [ ] Select EU, disagree with disclaimer, try to access /en/files.php → Should redirect to disclaimer
- [ ] Try to download PDF without going through proper flow → Should be blocked

## 3. Input Validation
- [ ] Submit XSS payloads in country selection
- [ ] Submit SQL injection payloads in forms
- [ ] Submit extremely long strings (10000+ characters)
- [ ] Submit null bytes (%00)
- [ ] Submit special characters (<>'"&;)
- [ ] Submit encoded payloads (URL encoded, HTML encoded)

## 4. CSRF Protection
- [ ] Submit country selection form without CSRF token → Should be rejected
- [ ] Submit disclaimer form without CSRF token → Should be rejected
- [ ] Submit form with invalid CSRF token → Should be rejected
- [ ] Reuse old CSRF token → Should be rejected (if token rotation enabled)

## 5. File Access & Path Traversal
- [ ] Try to download: /download.php?id=../../../etc/passwd
- [ ] Try to download: /download.php?id=....//....//etc/passwd
- [ ] Try to access: /assets/pdf/en/../../includes/config.php
- [ ] Try to access: /includes/config.php directly
- [ ] Try to access: /includes/functions.php directly
- [ ] Try to access: /logs/access.log directly
- [ ] Try to access: /.htaccess directly
- [ ] Try to access: /.git/ directory (if exists)

## 6. File Download Security
- [ ] Try to download non-existent file
- [ ] Try to download file with manipulated ID
- [ ] Try to download file for wrong language
- [ ] Try to access PDF directly: /assets/pdf/en/document1.pdf
- [ ] Try to download without proper session/country selection

## 7. HTTP Security Headers
- [ ] Check for X-Content-Type-Options: nosniff
- [ ] Check for X-Frame-Options: SAMEORIGIN
- [ ] Check for X-XSS-Protection: 1; mode=block
- [ ] Check for Content-Security-Policy (if implemented)
- [ ] Check for Strict-Transport-Security (if HTTPS)
- [ ] Verify Server header doesn't expose version info

## 8. Information Disclosure
- [ ] PHP errors should not display to users
- [ ] Stack traces should not be visible
- [ ] Directory listing should be disabled
- [ ] .git directory should not be accessible
- [ ] Backup files (.bak, .old, ~) should not be accessible
- [ ] Source code comments should not expose sensitive info

## 9. Injection Attacks
- [ ] Test SQL injection in all input fields
- [ ] Test XSS in all output fields
- [ ] Test command injection in file operations
- [ ] Test LDAP injection (if applicable)
- [ ] Test XML injection (if applicable)

## 10. Business Logic
- [ ] Try to access files after session expires
- [ ] Try to access files from different country than selected
- [ ] Try to skip disclaimer by direct URL access
- [ ] Try to access files with manipulated session data
- [ ] Try to download more files than allowed (if rate limiting exists)

## 11. Cryptography
- [ ] Verify CSRF tokens are cryptographically random
- [ ] Verify session IDs are cryptographically random
- [ ] Check if sensitive data is encrypted (if applicable)
- [ ] Verify password hashing uses strong algorithm (if applicable)

## 12. Rate Limiting & DoS
- [ ] Test rapid form submissions
- [ ] Test rapid file downloads
- [ ] Test session creation flooding
- [ ] Test large file upload (if applicable)

## Tools for Penetration Testing

### Automated Scanners:
- OWASP ZAP (Zed Attack Proxy)
- Burp Suite Community Edition
- Nikto
- SQLMap (for SQL injection)

### Manual Testing Tools:
- Browser Developer Tools (Network tab, Console)
- curl/wget for HTTP requests
- Postman for API testing

### Commands to Run:

1. **OWASP ZAP Quick Scan:**
   ```bash
   docker run -t owasp/zap2docker-stable zap-baseline.py -t http://localhost
   ```

2. **Nikto Scan:**
   ```bash
   nikto -h http://localhost
   ```

3. **Directory Enumeration:**
   ```bash
   dirb http://localhost
   ```

4. **SQL Injection Test:**
   ```bash
   sqlmap -u "http://localhost/index.php" --forms --batch
   ```

## Expected Security Posture

### Should Be Protected:
✅ CSRF attacks
✅ XSS attacks
✅ SQL injection
✅ Path traversal
✅ Direct file access
✅ Unauthorized access
✅ Session hijacking
✅ Information disclosure

### Recommendations:
1. Enable HTTPS in production
2. Implement rate limiting
3. Add Content Security Policy headers
4. Implement IP-based blocking for failed attempts
5. Add honeypot fields to forms
6. Implement CAPTCHA for production
7. Set up Web Application Firewall (WAF)
8. Regular security audits
9. Keep PHP and server software updated
10. Monitor logs for suspicious activity

## Critical Vulnerabilities to Fix Immediately:
- Any direct access to PHP include files
- Any successful path traversal attempts
- Any successful XSS or SQL injection
- Any bypass of access control
- Any missing CSRF protection
- Any direct PDF access bypassing authentication

*/
