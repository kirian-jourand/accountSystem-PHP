<?php
declare(strict_types=1);

require_once './includes/utils.inc.php';

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase {

    // ==================== isEmailInvalid ====================

    public function testValidEmailReturnsFalse(): void {
        $this->assertFalse(isEmailInvalid("john@mail.com"));
        $this->assertFalse(isEmailInvalid("user.name@domain.fr"));
        $this->assertFalse(isEmailInvalid("user+tag@domain.com"));
    }

    public function testInvalidEmailReturnsTrue(): void {
        $this->assertTrue(isEmailInvalid("not-an-email"));
        $this->assertTrue(isEmailInvalid("missing@dotcom"));
        $this->assertTrue(isEmailInvalid("@nodomain.com"));
    }

    public function testEmptyEmailReturnsTrue(): void {
        $this->assertTrue(isEmailInvalid(""));
    }

    public function testEmailWithoutAtReturnsTrue(): void {
        $this->assertTrue(isEmailInvalid("johndomain.com"));
    }

    public function testEmailWithSpaceReturnsTrue(): void {
        $this->assertTrue(isEmailInvalid("john @mail.com"));
    }
}