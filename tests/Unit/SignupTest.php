<?php
declare(strict_types=1);

require_once './includes/signup_contr.inc.php';

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase {

    // ==================== getSignupEmptyFields ====================

    public function testGetSignupEmptyFieldsNoEmptyReturnsEmptyArray(): void {
        $result = getSignupEmptyFields("john", "john@mail.com", "Password1!", "Password1!");
        $this->assertEmpty($result);
    }

    public function testGetSignupEmptyFieldsAllEmptyReturnsAllFields(): void {
        $result = getSignupEmptyFields("", "", "", "");
        $this->assertCount(4, $result);
        $this->assertContains("username", $result);
        $this->assertContains("e-mail", $result);
        $this->assertContains("pwd", $result);
        $this->assertContains("confirmPwd", $result);
    }

    public function testGetSignupEmptyFieldsEmptyUsernameReturnsUsername(): void {
        $result = getSignupEmptyFields("", "john@mail.com", "Password1!", "Password1!");
        $this->assertContains("username", $result);
        $this->assertCount(1, $result);
    }

    public function testGetSignupEmptyFieldsEmptyEmailReturnsEmail(): void {
        $result = getSignupEmptyFields("john", "", "Password1!", "Password1!");
        $this->assertContains("e-mail", $result);
        $this->assertCount(1, $result);
    }

    public function testGetSignupEmptyFieldsEmptyPasswordReturnsPassword(): void {
        $result = getSignupEmptyFields("john", "john@mail.com", "", "Password1!");
        $this->assertContains("pwd", $result);
        $this->assertCount(1, $result);
    }

    public function testGetSignupEmptyFieldsEmptyConfirmPasswordReturnsConfirmPassword(): void {
        $result = getSignupEmptyFields("john", "john@mail.com", "Password1!", "");
        $this->assertContains("confirmPwd", $result);
        $this->assertCount(1, $result);
    }

    // ==================== isUsernameLengthInvalid ====================

    public function testShortUsernameReturnsFalse(): void {
        $this->assertFalse(isUsernameLengthInvalid("john"));
    }

    public function testExactly30CharsReturnsFalse(): void {
        $this->assertFalse(isUsernameLengthInvalid(str_repeat("a", 30)));
    }

    public function test31CharsReturnsTrue(): void {
        $this->assertTrue(isUsernameLengthInvalid(str_repeat("a", 31)));
    }

    public function testEmptyUsernameReturnsFalse(): void {
        $this->assertFalse(isUsernameLengthInvalid(""));
    }

    // ==================== isPasswordComplex ====================

    public function testComplexPasswordReturnsAllTrue(): void {
        $result = isPasswordComplex("Password1!");
        $this->assertTrue($result["length"]);
        $this->assertTrue($result["uppercase letter"]);
        $this->assertTrue($result["number"]);
        $this->assertTrue($result["special character"]);
    }

    public function testShortPasswordReturnsFalseLength(): void {
        $result = isPasswordComplex("Pa1!");
        $this->assertFalse($result["length"]);
    }

    public function testExactly8CharsReturnsTrueLength(): void {
        $result = isPasswordComplex("Passw1!x");
        $this->assertTrue($result["length"]);
    }

    public function testNoUppercaseReturnsFalse(): void {
        $result = isPasswordComplex("password1!");
        $this->assertFalse($result["uppercase letter"]);
    }

    public function testNoNumberReturnsFalse(): void {
        $result = isPasswordComplex("Password!");
        $this->assertFalse($result["number"]);
    }

    public function testNoSpecialCharReturnsFalse(): void {
        $result = isPasswordComplex("Password1");
        $this->assertFalse($result["special character"]);
    }

    public function testEmptyPasswordReturnsAllFalse(): void {
        $result = isPasswordComplex("");
        $this->assertFalse($result["length"]);
        $this->assertFalse($result["uppercase letter"]);
        $this->assertFalse($result["number"]);
        $this->assertFalse($result["special character"]);
    }

    // ==================== confirmPasswordTest ====================

    public function testMatchingPasswordsReturnsTrue(): void {
        $this->assertTrue(confirmPasswordTest("Password1!", "Password1!"));
    }

    public function testDifferentPasswordsReturnsFalse(): void {
        $this->assertFalse(confirmPasswordTest("Password1!", "Password2!"));
    }

    public function testEmptyPasswordsReturnsTrue(): void {
        $this->assertTrue(confirmPasswordTest("", ""));
    }

    public function testOneEmptyPasswordReturnsFalse(): void {
        $this->assertFalse(confirmPasswordTest("Password1!", ""));
    }

    public function testCaseSensitiveReturnsFalse(): void {
        $this->assertFalse(confirmPasswordTest("password1!", "Password1!"));
    }
}