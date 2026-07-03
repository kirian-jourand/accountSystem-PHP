<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once './includes/login_contr.inc.php';


class LoginTest extends TestCase {

    // ==================== getEmptyFields ====================

    public function testGetEmptyFieldsNoEmptyReturnsEmptyArray(): void {
        $result = getEmptyFields("john@mail.com", "Password1!");
        $this->assertEmpty($result);
    }

    public function testGetEmptyFieldsBothEmptyReturnsBothFields(): void {
        $result = getEmptyFields("", "");
        $this->assertCount(2, $result);
        $this->assertContains("e-mail", $result);
        $this->assertContains("pwd", $result);
    }

    public function testGetEmptyFieldsEmptyEmailReturnsEmail(): void {
        $result = getEmptyFields("", "Password1!");
        $this->assertContains("e-mail", $result);
        $this->assertCount(1, $result);
    }

    public function testGetEmptyFieldsEmptyPasswordReturnsPassword(): void {
        $result = getEmptyFields("john@mail.com", "");
        $this->assertContains("pwd", $result);
        $this->assertCount(1, $result);
    }

    // ==================== isEmailInvalid ====================

    public function testValidEmailReturnsFalse(): void {
        $this->assertFalse(isEmailInvalid("john@mail.com"));
    }

    public function testInvalidEmailReturnsTrue(): void {
        $this->assertTrue(isEmailInvalid("not-an-email"));
        $this->assertTrue(isEmailInvalid("missing@dotcom"));
        $this->assertTrue(isEmailInvalid("@nodomain.com"));
        $this->assertTrue(isEmailInvalid(""));
    }

    // ==================== isBruteForce ====================

    protected function setUp(): void {
        // Initialise une session propre avant chaque test
        $_SESSION = [];
    }

    public function testNoBruteForceOnFirstAttempt(): void {
        $this->assertFalse(isBruteForce());
    }

    public function testBruteForceAfter5Attempts(): void {
        $_SESSION["login_attempts"] = 5;
        $_SESSION["last_attempt"] = time();
        $this->assertTrue(isBruteForce());
    }

    public function testNotBruteForceBelow5Attempts(): void {
        $_SESSION["login_attempts"] = 4;
        $_SESSION["last_attempt"] = time();
        $this->assertFalse(isBruteForce());
    }

    public function testBruteForceResetsAfter2Minutes(): void {
        $_SESSION["login_attempts"] = 5;
        $_SESSION["last_attempt"] = time() - 121; // 2 minutes + 1 seconde
        $this->assertFalse(isBruteForce());
        $this->assertEquals(0, $_SESSION["login_attempts"]);
    }

    // ==================== incrementLoginAttempts ====================

    public function testIncrementLoginAttemptsIncrementsCounter(): void {
        $_SESSION["login_attempts"] = 0;
        $_SESSION["last_attempt"] = time();
        incrementLoginAttempts();
        $this->assertEquals(1, $_SESSION["login_attempts"]);
    }

    public function testIncrementLoginAttemptsUpdatesLastAttempt(): void {
        $_SESSION["login_attempts"] = 0;
        $before = time();
        incrementLoginAttempts();
        $this->assertGreaterThanOrEqual($before, $_SESSION["last_attempt"]);
    }

    // ==================== resetLoginAttempts ====================

    public function testResetLoginAttemptsResetsCounter(): void {
        $_SESSION["login_attempts"] = 5;
        resetLoginAttempts();
        $this->assertEquals(0, $_SESSION["login_attempts"]);
    }
}