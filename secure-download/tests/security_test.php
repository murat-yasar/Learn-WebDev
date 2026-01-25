<?php
/**
 * Manual Security Test Runner
 *
 * This script tests various security vulnerabilities
 * Run from command line: php tests/security_test.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

class SecurityTester {
    private $baseUrl = 'http://localhost'; // Change to your MAMP URL
    private $results = [];
    private $logFile = '';
    private $detailedLog = [];

    public function __construct($baseUrl = null) {
        if ($baseUrl) {
            $this->baseUrl = rtrim($baseUrl, '/');
        }

        // Create logs directory if it doesn't exist
        $logsDir = __DIR__ . '/test-logs';
        if (!is_dir($logsDir)) {
            mkdir($logsDir, 0755, true);
        }

        // Create timestamped log file
        $timestamp = date('Y-m-d_H-i-s');
        $this->logFile = $logsDir . '/security_test_' . $timestamp . '.log';

        // Initialize log file
        $this->writeLog("========================================");
        $this->writeLog("SECURITY TEST LOG");
        $this->writeLog("Started: " . date('Y-m-d H:i:s'));
        $this->writeLog("Base URL: " . $this->baseUrl);
        $this->writeLog("========================================\n");
    }

    public function runAllTests() {
        echo "========================================\n";
        echo "SECURITY TEST SUITE\n";
        echo "========================================\n";
        echo "Log file: " . $this->logFile . "\n\n";

        $this->writeLog("Running all security tests...\n");

        $this->testCSRFProtection();
        $this->testSessionSecurity();
        $this->testDirectFileAccess();
        $this->testPathTraversal();
        $this->testSQLInjection();
        $this->testXSSProtection();
        $this->testAccessControl();
        $this->testFileDownloadSecurity();
        $this->testHTTPHeaders();
        $this->testInputValidation();

        $this->printResults();
        $this->generateSummaryReport();
    }

    private function testCSRFProtection() {
        echo "Testing CSRF Protection...\n";
        $this->writeLog("\n=== CSRF PROTECTION TESTS ===");

        // Test 1: Submit form without CSRF token
        $this->writeLog("\nTest: Form submission without CSRF token");
        $result = $this->makeRequest('/index.php', 'POST', [
            'country' => 'EU'
            // Missing csrf_token
        ]);

        if (stripos($result, 'invalid request') !== false) {
            $this->addResult('CSRF Protection', 'PASS', 'Form rejected without CSRF token');
        } else {
            $this->addResult('CSRF Protection', 'FAIL', 'Form accepted without CSRF token', $result);
        }

        // Test 2: Submit with invalid CSRF token
        $this->writeLog("\nTest: Form submission with invalid CSRF token");
        $result = $this->makeRequest('/index.php', 'POST', [
            'country' => 'EU',
            'csrf_token' => 'invalid_token_12345'
        ]);

        if (stripos($result, 'invalid request') !== false) {
            $this->addResult('CSRF - Invalid Token', 'PASS', 'Invalid token rejected');
        } else {
            $this->addResult('CSRF - Invalid Token', 'FAIL', 'Invalid token accepted', $result);
        }

        echo "\n";
    }

    private function testSessionSecurity() {
        echo "Testing Session Security...\n";

        // Test 1: Check session cookie flags
        $headers = get_headers($this->baseUrl . '/index.php', 1);

        $hasHttpOnly = false;
        if (isset($headers['Set-Cookie'])) {
            $cookies = is_array($headers['Set-Cookie']) ? $headers['Set-Cookie'] : [$headers['Set-Cookie']];
            foreach ($cookies as $cookie) {
                if (stripos($cookie, 'httponly') !== false) {
                    $hasHttpOnly = true;
                    break;
                }
            }
        }

        if ($hasHttpOnly) {
            $this->addResult('Session HttpOnly Flag', 'PASS', 'Session cookies use HttpOnly');
        } else {
            $this->addResult('Session HttpOnly Flag', 'WARNING', 'HttpOnly flag not detected');
        }

        echo "\n";
    }

    private function testDirectFileAccess() {
        echo "Testing Direct File Access Protection...\n";

        // Test 1: Try to access config.php directly
        $result = $this->makeRequest('/includes/config.php');

        if (stripos($result, 'Direct access not permitted') !== false ||
            http_response_code() === 403) {
            $this->addResult('Config File Protection', 'PASS', 'Config file protected');
        } else {
            $this->addResult('Config File Protection', 'FAIL', 'Config file accessible');
        }

        // Test 2: Try to access functions.php directly
        $result = $this->makeRequest('/includes/functions.php');

        if (stripos($result, 'Direct access not permitted') !== false ||
            http_response_code() === 403) {
            $this->addResult('Functions File Protection', 'PASS', 'Functions file protected');
        } else {
            $this->addResult('Functions File Protection', 'FAIL', 'Functions file accessible');
        }

        // Test 3: Try to access log files
        $result = $this->makeRequest('/logs/access.log');

        if (http_response_code() === 403 || stripos($result, 'forbidden') !== false) {
            $this->addResult('Log File Protection', 'PASS', 'Log files protected');
        } else {
            $this->addResult('Log File Protection', 'FAIL', 'Log files accessible');
        }

        echo "\n";
    }

    private function testPathTraversal() {
        echo "Testing Path Traversal Protection...\n";

        $traversalAttempts = [
            '../../../etc/passwd',
            '..\\..\\..\\windows\\system32\\config\\sam',
            '....//....//....//etc/passwd',
            '%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd',
            '..%252f..%252f..%252fetc%252fpasswd'
        ];

        foreach ($traversalAttempts as $attempt) {
            $result = $this->makeRequest('/download.php?id=' . urlencode($attempt) . '&lang=en');

            if (stripos($result, 'not found') !== false ||
                stripos($result, 'invalid') !== false ||
                http_response_code() === 404) {
                $this->addResult('Path Traversal - ' . substr($attempt, 0, 20), 'PASS', 'Attempt blocked');
            } else {
                $this->addResult('Path Traversal - ' . substr($attempt, 0, 20), 'FAIL', 'Potential vulnerability');
            }
        }

        echo "\n";
    }

    private function testSQLInjection() {
        echo "Testing SQL Injection Protection...\n";

        $sqlPayloads = [
            "' OR '1'='1",
            "1; DROP TABLE users--",
            "admin'--",
            "' UNION SELECT NULL--",
            "1' AND '1'='1"
        ];

        foreach ($sqlPayloads as $payload) {
            $result = $this->makeRequest('/index.php', 'POST', [
                'country' => $payload,
                'csrf_token' => 'test'
            ]);

            // Should not execute SQL or show SQL errors
            if (stripos($result, 'sql') === false &&
                stripos($result, 'mysql') === false &&
                stripos($result, 'database') === false) {
                $this->addResult('SQL Injection - ' . substr($payload, 0, 15), 'PASS', 'No SQL error exposed');
            } else {
                $this->addResult('SQL Injection - ' . substr($payload, 0, 15), 'FAIL', 'Potential SQL injection');
            }
        }

        echo "\n";
    }

    private function testXSSProtection() {
        echo "Testing XSS Protection...\n";

        $xssPayloads = [
            '<script>alert("XSS")</script>',
            '<img src=x onerror=alert("XSS")>',
            '<svg/onload=alert("XSS")>',
            'javascript:alert("XSS")',
            '<iframe src="javascript:alert(\'XSS\')"></iframe>'
        ];

        foreach ($xssPayloads as $payload) {
            $result = $this->makeRequest('/index.php', 'POST', [
                'country' => $payload,
                'csrf_token' => 'test'
            ]);

            // Check if script tags are escaped
            if (stripos($result, '<script>') === false &&
                stripos($result, 'onerror=') === false &&
                stripos($result, 'javascript:') === false) {
                $this->addResult('XSS Protection - ' . substr($payload, 0, 20), 'PASS', 'XSS payload escaped');
            } else {
                $this->addResult('XSS Protection - ' . substr($payload, 0, 20), 'FAIL', 'XSS vulnerability detected');
            }
        }

        echo "\n";
    }

    private function testAccessControl() {
        echo "Testing Access Control...\n";

        // Test 1: Access files.php without country selection
        $result = $this->makeRequest('/en/files.php');

        if (stripos($result, 'Location: /index.php') !== false ||
            stripos($result, 'redirect') !== false) {
            $this->addResult('Access Control - Files Page', 'PASS', 'Redirected to index');
        } else {
            $this->addResult('Access Control - Files Page', 'WARNING', 'Check if redirect works');
        }

        // Test 2: Access disclaimer.php without country selection
        $result = $this->makeRequest('/en/disclaimer.php');

        if (stripos($result, 'Location: /index.php') !== false ||
            stripos($result, 'redirect') !== false) {
            $this->addResult('Access Control - Disclaimer Page', 'PASS', 'Redirected to index');
        } else {
            $this->addResult('Access Control - Disclaimer Page', 'WARNING', 'Check if redirect works');
        }

        echo "\n";
    }

    private function testFileDownloadSecurity() {
        echo "Testing File Download Security...\n";

        // Test 1: Try to download without authentication
        $result = $this->makeRequest('/download.php?id=doc1&lang=en');

        if (stripos($result, 'not found') !== false ||
            stripos($result, 'redirect') !== false ||
            http_response_code() === 404) {
            $this->addResult('Download - No Auth', 'PASS', 'Download blocked without auth');
        } else {
            $this->addResult('Download - No Auth', 'FAIL', 'File accessible without auth');
        }

        // Test 2: Try to access PDF directly
        $result = $this->makeRequest('/assets/pdf/en/document1.pdf');

        // PDFs should not be directly accessible OR should be protected
        $this->addResult('Direct PDF Access', 'INFO', 'Check if PDFs are directly accessible');

        // Test 3: Invalid document ID
        $result = $this->makeRequest('/download.php?id=../../etc/passwd&lang=en');

        if (stripos($result, 'not found') !== false || http_response_code() === 404) {
            $this->addResult('Download - Invalid ID', 'PASS', 'Invalid ID rejected');
        } else {
            $this->addResult('Download - Invalid ID', 'FAIL', 'Invalid ID accepted');
        }

        echo "\n";
    }

    private function testHTTPHeaders() {
        echo "Testing HTTP Security Headers...\n";

        $headers = get_headers($this->baseUrl . '/index.php', 1);

        // Check for X-Content-Type-Options
        if (isset($headers['X-Content-Type-Options'])) {
            $this->addResult('X-Content-Type-Options Header', 'PASS', 'Header present');
        } else {
            $this->addResult('X-Content-Type-Options Header', 'WARNING', 'Header missing');
        }

        // Check for X-Frame-Options
        if (isset($headers['X-Frame-Options'])) {
            $this->addResult('X-Frame-Options Header', 'PASS', 'Header present');
        } else {
            $this->addResult('X-Frame-Options Header', 'WARNING', 'Header missing');
        }

        // Check for X-XSS-Protection
        if (isset($headers['X-XSS-Protection'])) {
            $this->addResult('X-XSS-Protection Header', 'PASS', 'Header present');
        } else {
            $this->addResult('X-XSS-Protection Header', 'WARNING', 'Header missing');
        }

        echo "\n";
    }

    private function testInputValidation() {
        echo "Testing Input Validation...\n";

        // Test 1: Invalid country
        $result = $this->makeRequest('/index.php', 'POST', [
            'country' => 'INVALID_COUNTRY',
            'csrf_token' => 'test'
        ]);

        if (stripos($result, 'invalid') !== false || stripos($result, 'error') !== false) {
            $this->addResult('Input Validation - Country', 'PASS', 'Invalid country rejected');
        } else {
            $this->addResult('Input Validation - Country', 'FAIL', 'Invalid country accepted');
        }

        // Test 2: Invalid language
        $result = $this->makeRequest('/en/files.php?lang=invalid');

        // Should default to 'en' or reject
        $this->addResult('Input Validation - Language', 'INFO', 'Check language validation');

        // Test 3: Long input (buffer overflow attempt)
        $longString = str_repeat('A', 10000);
        $result = $this->makeRequest('/index.php', 'POST', [
            'country' => $longString,
            'csrf_token' => 'test'
        ]);

        if (stripos($result, 'invalid') !== false || stripos($result, 'error') !== false) {
            $this->addResult('Input Validation - Buffer Overflow', 'PASS', 'Long input rejected');
        } else {
            $this->addResult('Input Validation - Buffer Overflow', 'WARNING', 'Long input accepted');
        }

        echo "\n";
    }

    private function makeRequest($path, $method = 'GET', $data = []) {
        $url = $this->baseUrl . $path;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // Don't follow redirects
        curl_setopt($ch, CURLOPT_HEADER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function addResult($test, $status, $message, $details = '') {
        $this->results[] = [
            'test' => $test,
            'status' => $status,
            'message' => $message
        ];

        // Log to file with details
        $logEntry = sprintf("[%s] %s: %s", $status, $test, $message);
        $this->writeLog($logEntry);

        if ($details && ($status === 'FAIL' || $status === 'WARNING')) {
            $this->detailedLog[] = [
                'test' => $test,
                'status' => $status,
                'message' => $message,
                'details' => $this->sanitizeForLog($details)
            ];
            $this->writeLog("  Details: " . substr($this->sanitizeForLog($details), 0, 200) . "...");
        }
    }

    private function writeLog($message) {
        file_put_contents($this->logFile, $message . "\n", FILE_APPEND);
    }

    private function sanitizeForLog($text) {
        // Remove binary data and long responses
        $text = substr($text, 0, 1000);
        $text = preg_replace('/[^\x20-\x7E\n\r\t]/', '', $text);
        return $text;
    }

    private function printResults() {
        echo "\n========================================\n";
        echo "TEST RESULTS SUMMARY\n";
        echo "========================================\n\n";

        $this->writeLog("\n========================================");
        $this->writeLog("TEST RESULTS SUMMARY");
        $this->writeLog("========================================\n");

        $passed = 0;
        $failed = 0;
        $warnings = 0;
        $info = 0;

        foreach ($this->results as $result) {
            $color = '';
            switch ($result['status']) {
                case 'PASS':
                    $color = "\033[32m"; // Green
                    $passed++;
                    break;
                case 'FAIL':
                    $color = "\033[31m"; // Red
                    $failed++;
                    break;
                case 'WARNING':
                    $color = "\033[33m"; // Yellow
                    $warnings++;
                    break;
                case 'INFO':
                    $color = "\033[36m"; // Cyan
                    $info++;
                    break;
            }
            $reset = "\033[0m";

            printf("%s[%-7s]%s %-40s %s\n",
                $color,
                $result['status'],
                $reset,
                $result['test'],
                $result['message']
            );
        }

        $summary = "\n========================================";
        echo $summary . "\n";
        $this->writeLog($summary);

        $total = sprintf("Total Tests: %d", count($this->results));
        echo $total . "\n";
        $this->writeLog($total);

        $passedStr = sprintf("Passed: %d", $passed);
        printf("\033[32m%s\033[0m\n", $passedStr);
        $this->writeLog($passedStr);

        $failedStr = sprintf("Failed: %d", $failed);
        printf("\033[31m%s\033[0m\n", $failedStr);
        $this->writeLog($failedStr);

        $warningsStr = sprintf("Warnings: %d", $warnings);
        printf("\033[33m%s\033[0m\n", $warningsStr);
        $this->writeLog($warningsStr);

        $infoStr = sprintf("Info: %d", $info);
        printf("\033[36m%s\033[0m\n", $infoStr);
        $this->writeLog($infoStr);

        echo "========================================\n";
        $this->writeLog("========================================");

        if ($failed > 0) {
            $msg = "\n⚠️  CRITICAL: Some security tests failed! Review and fix immediately.";
            echo $msg . "\n";
            $this->writeLog($msg);
        } elseif ($warnings > 0) {
            $msg = "\n⚠️  WARNING: Some security checks need attention.";
            echo $msg . "\n";
            $this->writeLog($msg);
        } else {
            $msg = "\n✅ All critical security tests passed!";
            echo $msg . "\n";
            $this->writeLog($msg);
        }

        echo "\nLog file saved: " . $this->logFile . "\n";
    }

    private function generateSummaryReport() {
        $this->writeLog("\n\n========================================");
        $this->writeLog("DETAILED FAILURE REPORT");
        $this->writeLog("========================================\n");

        if (empty($this->detailedLog)) {
            $this->writeLog("No failures or warnings detected!");
            return;
        }

        foreach ($this->detailedLog as $entry) {
            $this->writeLog("\n----------------------------------------");
            $this->writeLog("Test: " . $entry['test']);
            $this->writeLog("Status: " . $entry['status']);
            $this->writeLog("Message: " . $entry['message']);
            $this->writeLog("Details:");
            $this->writeLog($entry['details']);
            $this->writeLog("----------------------------------------");
        }

        $this->writeLog("\n\n========================================");
        $this->writeLog("RECOMMENDED ACTIONS");
        $this->writeLog("========================================\n");

        $failedTests = array_filter($this->results, function($r) { return $r['status'] === 'FAIL'; });

        if (!empty($failedTests)) {
            $this->writeLog("CRITICAL ISSUES TO FIX:\n");
            foreach ($failedTests as $test) {
                $this->writeLog("❌ " . $test['test'] . ": " . $test['message']);
                $this->writeLog("   Action: " . $this->getRecommendation($test['test']));
                $this->writeLog("");
            }
        }

        $warnings = array_filter($this->results, function($r) { return $r['status'] === 'WARNING'; });

        if (!empty($warnings)) {
            $this->writeLog("\nWARNINGS TO ADDRESS:\n");
            foreach ($warnings as $test) {
                $this->writeLog("⚠️  " . $test['test'] . ": " . $test['message']);
                $this->writeLog("   Action: " . $this->getRecommendation($test['test']));
                $this->writeLog("");
            }
        }

        $this->writeLog("\nTest completed: " . date('Y-m-d H:i:s'));
        $this->writeLog("========================================");
    }

    private function getRecommendation($testName) {
        $recommendations = [
            'CSRF Protection' => 'Ensure all forms have CSRF token validation. Check index.php form submission.',
            'CSRF - Invalid Token' => 'Verify CSRF token validation logic in all POST handlers.',
            'Config File Protection' => 'Add .htaccess rules to block direct access to includes/ directory.',
            'Functions File Protection' => 'Add .htaccess rules to block direct access to includes/ directory.',
            'Log File Protection' => 'Add .htaccess in logs/ directory to deny all access.',
            'Download - No Auth' => 'Add session/country check at the beginning of download.php.',
            'Access Control - Files Page' => 'Ensure checkAccess() function is called in en/files.php and de/files.php.',
            'Access Control - Disclaimer Page' => 'Ensure checkAccess() is called in disclaimer pages.',
            'Session HttpOnly Flag' => 'Set ini_set("session.cookie_httponly", 1) in config.php.',
            'X-Content-Type-Options Header' => 'Add "Header set X-Content-Type-Options nosniff" to .htaccess.',
            'X-Frame-Options Header' => 'Add "Header set X-Frame-Options SAMEORIGIN" to .htaccess.',
            'X-XSS-Protection Header' => 'Add "Header set X-XSS-Protection 1; mode=block" to .htaccess.',
        ];

        foreach ($recommendations as $key => $value) {
            if (stripos($testName, $key) !== false) {
                return $value;
            }
        }

        return 'Review the test details and implement appropriate security measures.';
    }
}

// Run tests if executed from command line
if (php_sapi_name() === 'cli') {
    $baseUrl = $argv[1] ?? 'http://localhost';
    $tester = new SecurityTester($baseUrl);
    $tester->runAllTests();
}