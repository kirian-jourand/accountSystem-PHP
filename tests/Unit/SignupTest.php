<?php

use PHPUnit\Framework\TestCase;

require_once '../../includes/signup_contr.inc.php'; // adapte le chemin

class SignupTest extends TestCase
{

    public function test_isEmailInvalid_true(): void {
        $this->assertTrue(isEmailInvalid("not-an-email"));
        $this->assertTrue(isEmailInvalid("missing@dotcom"));
        $this->assertTrue(isEmailInvalid("@nodomain.com"));
        $this->assertTrue(isEmailInvalid(""));
    }

    public function test_isEmailInvalid_false(): void {
        $this->assertFalse(isEmailInvalid("test@example.com"));
        $this->assertFalse(isEmailInvalid("user.name+@domain.fr"));
    }

    public function testNoEmptyFieldsReturnsEmptyArray(): void {
        $result = getEmptyFields("john", "john@mail.com", "Password1!", "Password1!");
        $this->assertEmpty($result);
    }

    public function testAllEmptyFieldsReturnsAllFields(): void {
        $result = getEmptyFields("", "", "", "");
        $this->assertCount(4, $result);
        $this->assertContains("username", $result);
        $this->assertContains("e-mail", $result);
        $this->assertContains("pwd", $result);
        $this->assertContains("confirmPwd", $result);
    }

    public function testEmptyUsernameReturnsUsername(): void {
        $result = getEmptyFields("", "john@mail.com", "Password1!", "Password1!");
        $this->assertContains("username", $result);
        $this->assertCount(1, $result);
    }

    public function testEmptyEmailReturnsEmail(): void {
        $result = getEmptyFields("john", "", "Password1!", "Password1!");
        $this->assertContains("e-mail", $result);
        $this->assertCount(1, $result);
    }

    public function testEmptyPasswordReturnsPassword(): void {
        $result = getEmptyFields("john", "john@mail.com", "", "Password1!");
        $this->assertContains("pwd", $result);
        $this->assertCount(1, $result);
    }

    public function testEmptyConfirmPasswordReturnsConfirmPassword(): void {
        $result = getEmptyFields("john", "john@mail.com", "Password1!", "");
        $this->assertContains("confirmPwd", $result);
        $this->assertCount(1, $result);
    }

}
