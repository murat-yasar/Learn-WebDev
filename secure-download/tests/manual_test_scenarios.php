<?php
/**
 * Manual Test Scenarios
 * Copy and paste these URLs/commands to test manually
 */
    // TEST VARIABLES
    $test_url = 'http://localhost';
    $test_id = 'DLH-DIP-2016-Base-Prospectus';
    $test_doc_path = 'assets/pdf/en';
    $test_doc = 'DLH-DIP-2016-Base-Prospectus.pdf';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Security Test Scenarios</title>
    <style>
        body {
            font-family: monospace;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-group {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .test-case {
            background: #ecf0f1;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #3498db;
        }
        .expected {
            color: #27ae60;
            font-weight: bold;
        }
        .danger {
            color: #e74c3c;
            font-weight: bold;
        }
        code {
            background: #34495e;
            color: #ecf0f1;
            padding: 2px 6px;
            border-radius: 3px;
        }
        .copy-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>🔒 Manual Security Test Scenarios</h1>
    <p>Test each scenario and verify the expected result. Click "Copy" to copy the URL/payload.</p>

    <div class="test-group">
        <h2>1. Path Traversal Attacks</h2>

        <div class="test-case">
            <strong>Test 1.1:</strong> Directory Traversal - Linux<br>
            <code id="test1_1"><?= $test_url ?>/download.php?id=../../../etc/passwd&lang=en</code>
            <button class="copy-btn" onclick="copy('test1_1')">Copy</button><br>
            <span class="expected">Expected: 404 or "Document not found"</span>
        </div>

        <div class="test-case">
            <strong>Test 1.2:</strong> Directory Traversal - Encoded<br>
            <code id="test1_2"><?= $test_url ?>/download.php?id=..%2F..%2F..%2Fetc%2Fpasswd&lang=en</code>
            <button class="copy-btn" onclick="copy('test1_2')">Copy</button><br>
            <span class="expected">Expected: 404 or "Document not found"</span>
        </div>

        <div class="test-case">
            <strong>Test 1.3:</strong> Access Config File<br>
            <code id="test1_3"><?= $test_url ?>/includes/config.php</code>
            <button class="copy-btn" onclick="copy('test1_3')">Copy</button><br>
            <span class="expected">Expected: 403 Forbidden or "Direct access not permitted"</span>
        </div>
    </div>

    <div class="test-group">
        <h2>2. Access Control Bypass</h2>

        <div class="test-case">
            <strong>Test 2.1:</strong> Access Files Without Country Selection<br>
            <code id="test2_1"><?= $test_url ?>/en/files.php</code>
            <button class="copy-btn" onclick="copy('test2_1')">Copy</button><br>
            <span class="expected">Expected: Redirect to index.php</span><br>
            <span class="danger">⚠️ Start in incognito/private mode or clear cookies first!</span>
        </div>

        <div class="test-case">
            <strong>Test 2.2:</strong> Access Disclaimer Without Country<br>
            <code id="test2_2"><?= $test_url ?>/en/disclaimer.php</code>
            <button class="copy-btn" onclick="copy('test2_2')">Copy</button><br>
            <span class="expected">Expected: Redirect to index.php</span>
        </div>

        <div class="test-case">
            <strong>Test 2.3:</strong> Direct PDF Access<br>
            <code id="test2_3"><?= $test_url ?>/<?= $test_doc_path ?>/<?= $test_doc ?></code>
            <button class="copy-btn" onclick="copy('test2_3')">Copy</button><br>
            <span class="expected">Expected: Should ideally be blocked (check if accessible)</span>
        </div>
    </div>

    <div class="test-group">
        <h2>3. XSS (Cross-Site Scripting)</h2>

        <div class="test-case">
            <strong>Test 3.1:</strong> XSS in Country Selection<br>
            Instructions: Go to index.php, open DevTools Console, run:<br>
            <code id="test3_1">document.querySelector('select[name="country"]').value = '&lt;script&gt;alert("XSS")&lt;/script&gt;'; document.querySelector('form').submit();</code>
            <button class="copy-btn" onclick="copy('test3_1')">Copy</button><br>
            <span class="expected">Expected: Script should be escaped in error message, no alert should pop up</span>
        </div>

        <div class="test-case">
            <strong>Test 3.2:</strong> XSS in URL Parameter<br>
            <code id="test3_2"><?= $test_url ?>/404.php?lang=en&test=&lt;script&gt;alert('XSS')&lt;/script&gt;</code>
            <button class="copy-btn" onclick="copy('test3_2')">Copy</button><br>
            <span class="expected">Expected: No alert, script should be escaped</span>
        </div>
    </div>

    <div class="test-group">
        <h2>4. CSRF Protection</h2>

        <div class="test-case">
            <strong>Test 4.1:</strong> Submit Form Without CSRF Token<br>
            Instructions: Use curl or Postman:<br>
            <code id="test4_1">curl -X POST <?= $test_url ?>/index.php -d "country=EU"</code>
            <button class="copy-btn" onclick="copy('test4_1')">Copy</button><br>
            <span class="expected">Expected: "Invalid request" error</span>
        </div>

        <div class="test-case">
            <strong>Test 4.2:</strong> Submit Form With Invalid CSRF Token<br>
            <code id="test4_2">curl -X POST <?= $test_url ?>/index.php -d "country=EU&csrf_token=fake_token_12345"</code>
            <button class="copy-btn" onclick="copy('test4_2')">Copy</button><br>
            <span class="expected">Expected: "Invalid request" error</span>
        </div>

        <div class="test-case">
            <strong>Test 4.3:</strong> Submit Disclaimer Without CSRF Token<br>
            <code id="test4_3">curl -X POST <?= $test_url ?>/en/disclaimer.php -d "action=agree"</code>
            <button class="copy-btn" onclick="copy('test4_3')">Copy</button><br>
            <span class="expected">Expected: "Invalid request" error</span>
        </div>
    </div>

    <div class="test-group">
        <h2>5. SQL Injection</h2>

        <div class="test-case">
            <strong>Test 5.1:</strong> SQL Injection in Country Field<br>
            Instructions: Go to index.php, open DevTools Console, run:<br>
            <code id="test5_1">document.querySelector('select[name="country"]').innerHTML += '&lt;option value="' OR 1=1--"&gt;SQL Inject&lt;/option&gt;'; document.querySelector('select[name="country"]').value = "' OR 1=1--";</code>
            <button class="copy-btn" onclick="copy('test5_1')">Copy</button><br>
            <span class="expected">Expected: Should be rejected, no SQL errors displayed</span>
        </div>

        <div class="test-case">
            <strong>Test 5.2:</strong> SQL Injection via URL<br>
            <code id="test5_2"><?= $test_url ?>/download.php?id=1' OR '1'='1&lang=en</code>
            <button class="copy-btn" onclick="copy('test5_2')">Copy</button><br>
            <span class="expected">Expected: 404 or error, no SQL error messages</span>
        </div>

        <div class="test-case">
            <strong>Test 5.3:</strong> SQL Injection - UNION Attack<br>
            <code id="test5_3"><?= $test_url ?>/download.php?id=1' UNION SELECT NULL--&lang=en</code>
            <button class="copy-btn" onclick="copy('test5_3')">Copy</button><br>
            <span class="expected">Expected: 404 or error, no database info leaked</span>
        </div>
    </div>

    <div class="test-group">
        <h2>6. Session Management</h2>

        <div class="test-case">
            <strong>Test 6.1:</strong> Session Fixation<br>
            Instructions: Open DevTools > Application > Cookies, try to set custom PHPSESSID<br>
            <code id="test6_1">document.cookie = "PHPSESSID=attacker_controlled_session_id; path=/"</code>
            <button class="copy-btn" onclick="copy('test6_1')">Copy</button><br>
            <span class="expected">Expected: Session should regenerate, not accept custom ID</span>
        </div>

        <div class="test-case">
            <strong>Test 6.2:</strong> Check HttpOnly Cookie<br>
            Instructions: Open DevTools > Console, run:<br>
            <code id="test6_2">document.cookie</code>
            <button class="copy-btn" onclick="copy('test6_2')">Copy</button><br>
            <span class="expected">Expected: PHPSESSID should NOT appear (HttpOnly flag prevents JavaScript access)</span>
        </div>

        <div class="test-case">
            <strong>Test 6.3:</strong> Session Persistence After Logout<br>
            Instructions: Select country, then clear session manually:<br>
            <code id="test6_3">// After selecting country, try: <?= $test_url ?>/en/files.php in new incognito window</code>
            <button class="copy-btn" onclick="copy('test6_3')">Copy</button><br>
            <span class="expected">Expected: Should redirect to index.php (session not shared)</span>
        </div>
    </div>

    <div class="test-group">
        <h2>7. File Upload & Download</h2>

        <div class="test-case">
            <strong>Test 7.1:</strong> Download Non-Existent File<br>
            <code id="test7_1"><?= $test_url ?>/download.php?id=nonexistent_file&lang=en</code>
            <button class="copy-btn" onclick="copy('test7_1')">Copy</button><br>
            <span class="expected">Expected: 404 "Document not found"</span>
        </div>

        <div class="test-case">
            <strong>Test 7.2:</strong> Download Without Language Parameter<br>
            <code id="test7_2"><?= $test_url ?>/download.php?id=<?= $test_id ?></code>
            <button class="copy-btn" onclick="copy('test7_2')">Copy</button><br>
            <span class="expected">Expected: Error or 404</span>
        </div>

        <div class="test-case">
            <strong>Test 7.3:</strong> Download With Invalid Language<br>
            <code id="test7_3"><?= $test_url ?>/download.php?id=<?= $test_id ?>&lang=fr</code>
            <button class="copy-btn" onclick="copy('test7_3')">Copy</button><br>
            <span class="expected">Expected: Error or redirect</span>
        </div>

        <div class="test-case">
            <strong>Test 7.4:</strong> Null Byte Injection<br>
            <code id="test7_4"><?= $test_url ?>/download.php?id=<?= $test_id ?>%00.txt&lang=en</code>
            <button class="copy-btn" onclick="copy('test7_4')">Copy</button><br>
            <span class="expected">Expected: 404 or blocked</span>
        </div>
    </div>

    <div class="test-group">
        <h2>8. Information Disclosure</h2>

        <div class="test-case">
            <strong>Test 8.1:</strong> Access Log Files<br>
            <code id="test8_1"><?= $test_url ?>/logs/access.log</code>
            <button class="copy-btn" onclick="copy('test8_1')">Copy</button><br>
            <span class="expected">Expected: 403 Forbidden</span>
        </div>

        <div class="test-case">
            <strong>Test 8.2:</strong> Access .htaccess File<br>
            <code id="test8_2"><?= $test_url ?>/.htaccess</code>
            <button class="copy-btn" onclick="copy('test8_2')">Copy</button><br>
            <span class="expected">Expected: 403 Forbidden</span>
        </div>

        <div class="test-case">
            <strong>Test 8.3:</strong> Access .git Directory<br>
            <code id="test8_3"><?= $test_url ?>/.git/config</code>
            <button class="copy-btn" onclick="copy('test8_3')">Copy</button><br>
            <span class="expected">Expected: 404 or 403 (should not exist in production)</span>
        </div>

        <div class="test-case">
            <strong>Test 8.4:</strong> Directory Listing<br>
            <code id="test8_4"><?= $test_url ?>/assets/</code>
            <button class="copy-btn" onclick="copy('test8_4')">Copy</button><br>
            <span class="expected">Expected: 403 Forbidden (no directory listing)</span>
        </div>

        <div class="test-case">
            <strong>Test 8.5:</strong> PHP Info Exposure<br>
            <code id="test8_5"><?= $test_url ?>/phpinfo.php</code>
            <button class="copy-btn" onclick="copy('test8_5')">Copy</button><br>
            <span class="expected">Expected: 404 (file should not exist)</span>
        </div>
    </div>

    <div class="test-group">
        <h2>9. Business Logic Tests</h2>

        <div class="test-case">
            <strong>Test 9.1:</strong> AU-NZ Accessing Files<br>
            Instructions:
            1. Select "AU-NZ" from country dropdown
            2. You should see no_access.php
            3. Then try to access: <code id="test9_1">/en/files.php</code>
            <button class="copy-btn" onclick="copy('test9_1')">Copy</button><br>
            <span class="expected">Expected: Redirect to no_access.php</span>
        </div>

        <div class="test-case">
            <strong>Test 9.2:</strong> EU Without Disclaimer Agreement<br>
            Instructions:
            1. Select "EU" from country dropdown
            2. You'll see disclaimer page
            3. Click "I Disagree"
            4. Try to access files directly: <code id="test9_2">/en/files.php</code>
            <button class="copy-btn" onclick="copy('test9_2')">Copy</button><br>
            <span class="expected">Expected: Redirect to disclaimer or index</span>
        </div>

        <div class="test-case">
            <strong>Test 9.3:</strong> Language Switching After Country Selection<br>
            Instructions:
            1. Select "EU" and agree to disclaimer
            2. You're on /en/files.php
            3. Click "DE" language switcher
            4. Verify you're on /de/files.php and can still access files<br>
            <span class="expected">Expected: Should maintain access, just switch language</span>
        </div>

        <div class="test-case">
            <strong>Test 9.4:</strong> Direct Access to German Disclaimer<br>
            <code id="test9_4">/de/disclaimer.php</code>
            <button class="copy-btn" onclick="copy('test9_4')">Copy</button><br>
            <span class="expected">Expected: Redirect to index if no country selected</span>
        </div>
    </div>

    <div class="test-group">
        <h2>10. HTTP Methods & Headers</h2>

        <div class="test-case">
            <strong>Test 10.1:</strong> OPTIONS Method<br>
            <code id="test10_1">curl -X OPTIONS /index.php -v</code>
            <button class="copy-btn" onclick="copy('test10_1')">Copy</button><br>
            <span class="expected">Expected: Check what methods are allowed</span>
        </div>

        <div class="test-case">
            <strong>Test 10.2:</strong> PUT Method (Should Not Be Allowed)<br>
            <code id="test10_2">curl -X PUT /index.php -d "test=data"</code>
            <button class="copy-btn" onclick="copy('test10_2')">Copy</button><br>
            <span class="expected">Expected: 405 Method Not Allowed or ignored</span>
        </div>

        <div class="test-case">
            <strong>Test 10.3:</strong> DELETE Method (Should Not Be Allowed)<br>
            <code id="test10_3">curl -X DELETE <?= $test_url ?>/<?= $test_doc_path ?>/<?= $test_doc ?></code>
            <button class="copy-btn" onclick="copy('test10_3')">Copy</button><br>
            <span class="expected">Expected: 405 Method Not Allowed or 403</span>
        </div>

        <div class="test-case">
            <strong>Test 10.4:</strong> Check Security Headers<br>
            <code id="test10_4">curl -I <?= $test_url ?>/index.php</code>
            <button class="copy-btn" onclick="copy('test10_4')">Copy</button><br>
            <span class="expected">Expected: Should see X-Content-Type-Options, X-Frame-Options, X-XSS-Protection</span>
        </div>
    </div>

    <div class="test-group">
        <h2>11. Advanced Path Traversal</h2>

        <div class="test-case">
            <strong>Test 11.1:</strong> Double Encoding<br>
            <code id="test11_1"><?= $test_url ?>/download.php?id=%252e%252e%252f%252e%252e%252fetc%252fpasswd&lang=en</code>
            <button class="copy-btn" onclick="copy('test11_1')">Copy</button><br>
            <span class="expected">Expected: 404 blocked</span>
        </div>

        <div class="test-case">
            <strong>Test 11.2:</strong> Unicode Bypass<br>
            <code id="test11_2"><?= $test_url ?>/download.php?id=..%c0%af..%c0%af..%c0%afetc%c0%afpasswd&lang=en</code>
            <button class="copy-btn" onclick="copy('test11_2')">Copy</button><br>
            <span class="expected">Expected: 404 blocked</span>
        </div>

        <div class="test-case">
            <strong>Test 11.3:</strong> Windows Path Traversal<br>
            <code id="test11_3"><?= $test_url ?>/download.php?id=..\..\..\windows\system32\config\sam&lang=en</code>
            <button class="copy-btn" onclick="copy('test11_3')">Copy</button><br>
            <span class="expected">Expected: 404 blocked</span>
        </div>

        <div class="test-case">
            <strong>Test 11.4:</strong> Absolute Path<br>
            <code id="test11_4"><?= $test_url ?>/download.php?id=/etc/passwd&lang=en</code>
            <button class="copy-btn" onclick="copy('test11_4')">Copy</button><br>
            <span class="expected">Expected: 404 blocked</span>
        </div>
    </div>

    <div class="test-group">
        <h2>12. Edge Cases & Special Characters</h2>

        <div class="test-case">
            <strong>Test 12.1:</strong> Very Long Input (Buffer Overflow)<br>
            <code id="test12_1"><?= $test_url ?>/download.php?id=AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA...&lang=en</code>
            <button class="copy-btn" onclick="copy('test12_1')">Copy</button><br>
            <span class="expected">Expected: Should handle gracefully, not crash</span>
        </div>

        <div class="test-case">
            <strong>Test 12.2:</strong> Special Characters in ID<br>
            <code id="test12_2"><?= $test_url ?>/download.php?id=<?= $test_id ?>';DROP TABLE users;--&lang=en</code>
            <button class="copy-btn" onclick="copy('test12_2')">Copy</button><br>
            <span class="expected">Expected: Should be escaped/rejected safely</span>
        </div>

        <div class="test-case">
            <strong>Test 12.3:</strong> Null Bytes<br>
            <code id="test12_3"><?= $test_url ?>/download.php?id=<?= $test_id ?>%00&lang=en</code>
            <button class="copy-btn" onclick="copy('test12_3')">Copy</button><br>
            <span class="expected">Expected: Should be rejected or handled safely</span>
        </div>

        <div class="test-case">
            <strong>Test 12.4:</strong> Multiple Parameters<br>
            <code id="test12_4"><?= $test_url ?>/download.php?id=<?= $test_id ?>&id=../../etc/passwd&lang=en</code>
            <button class="copy-btn" onclick="copy('test12_4')">Copy</button><br>
            <span class="expected">Expected: Should use only first parameter or reject</span>
        </div>
    </div>

    <div class="test-group">
        <h2>13. Enumeration Attacks</h2>

        <div class="test-case">
            <strong>Test 13.1:</strong> Document ID Enumeration<br>
            Instructions: Try sequential IDs to see if you can guess document names:<br>
            <code id="test13_1">
                <?= $test_url ?>/download.php?id=<?= $test_id ?>&lang=en
                <?= $test_url ?>/download.php?id=doc2&lang=en
                <?= $test_url ?>/download.php?id=doc3&lang=en
            </code>
            <button class="copy-btn" onclick="copy('test13_1')">Copy</button><br>
            <span class="expected">Expected: Check if error messages reveal document existence</span>
        </div>

        <div class="test-case">
            <strong>Test 13.2:</strong> File Extension Guessing<br>
            <code id="test13_2"><?= $test_url ?>/download.php?id=<?= $test_id ?>.pdf&lang=en</code>
            <button class="copy-btn" onclick="copy('test13_2')">Copy</button><br>
            <span class="expected">Expected: Should not reveal file structure</span>
        </div>
    </div>

    <div class="test-group">
        <h2>14. Rate Limiting & DoS</h2>

        <div class="test-case">
            <strong>Test 14.1:</strong> Rapid Form Submissions<br>
            Instructions: Open DevTools Console and run:<br>
            <code id="test14_1">
                for(let i=0; i<100; i++) {
                    fetch('/index.php', {
                        method: 'POST',
                        body: 'country=EU&csrf_token=test'
                    });
                }
            </code>
            <button class="copy-btn" onclick="copy('test14_1')">Copy</button><br>
            <span class="expected">Expected: Check if server handles load (rate limiting would be ideal)</span>
        </div>

        <div class="test-case">
            <strong>Test 14.2:</strong> Rapid Downloads<br>
            Instructions: Bash script to test:<br>
            <code id="test14_2">for i in {1..50}; do curl <?= $test_url ?>/download.php?id=<?= $test_id ?>&lang=en & done</code>
            <button class="copy-btn" onclick="copy('test14_2')">Copy</button><br>
            <span class="expected">Expected: Server should handle concurrent requests</span>
        </div>
    </div>

    <div class="test-group">
        <h2>15. External Link Security</h2>

        <div class="test-case">
            <strong>Test 15.1:</strong> Open Redirect via External Links<br>
            Instructions: Check if external links in config can be manipulated<br>
            <span class="expected">Expected: External links should have rel="noopener noreferrer"</span>
        </div>

        <div class="test-case">
            <strong>Test 15.2:</strong> Verify Target Blank Security<br>
            Instructions: Inspect external links in files.php:<br>
            <code id="test15_2">// Right-click external link > Inspect Element
// Should see: target="_blank" rel="noopener noreferrer"</code>
            <button class="copy-btn" onclick="copy('test15_2')">Copy</button><br>
            <span class="expected">Expected: Should prevent reverse tabnabbing</span>
        </div>
    </div>

    <div class="test-group" style="background: #fff3cd; border-left: 4px solid #ffc107;">
        <h2>🔥 Critical Security Checklist</h2>
        <p><strong>Before deploying to production, verify ALL of these:</strong></p>

        <div style="margin: 20px 0;">
            <input type="checkbox" id="check1"> <label for="check1">All include files (config.php, functions.php) return 403/blocked</label><br>
            <input type="checkbox" id="check2"> <label for="check2">Log files are not accessible via browser</label><br>
            <input type="checkbox" id="check3"> <label for="check3">PDF files cannot be accessed without going through download.php</label><br>
            <input type="checkbox" id="check4"> <label for="check4">CSRF tokens are validated on all forms</label><br>
            <input type="checkbox" id="check5"> <label for="check5">Path traversal attacks are blocked</label><br>
            <input type="checkbox" id="check6"> <label for="check6">XSS payloads are escaped in all outputs</label><br>
            <input type="checkbox" id="check7"> <label for="check7">Access control works (can't access files without country selection)</label><br>
            <input type="checkbox" id="check8"> <label for="check8">Disclaimer agreement is enforced for EU/USA-CA</label><br>
            <input type="checkbox" id="check9"> <label for="check9">AU-NZ and Others are blocked from accessing files</label><br>
            <input type="checkbox" id="check10"> <label for="check10">Session cookies have HttpOnly flag</label><br>
            <input type="checkbox" id="check11"> <label for="check11">Security headers are present (X-Content-Type-Options, etc.)</label><br>
            <input type="checkbox" id="check12"> <label for="check12">Directory listing is disabled</label><br>
            <input type="checkbox" id="check13"> <label for="check13">Error messages don't reveal sensitive information</label><br>
            <input type="checkbox" id="check14"> <label for="check14">.git directory is not accessible (if exists)</label><br>
            <input type="checkbox" id="check15"> <label for="check15">PHP errors are not displayed to users (display_errors=Off in production)</label><br>
        </div>
    </div>

    <script>
        function copy(elementId) {
            const element = document.getElementById(elementId);
            const text = element.textContent;

            navigator.clipboard.writeText(text).then(() => {
                const btn = element.nextElementSibling;
                const originalText = btn.textContent;
                btn.textContent = '✓ Copied!';
                btn.style.background = '#27ae60';

                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = '#3498db';
                }, 2000);
            });
        }
    </script>
</body>
</html>