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
}
