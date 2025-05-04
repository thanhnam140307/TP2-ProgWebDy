<?php
//Par Charly Paradis
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/LogUserDTO.class.php';

class LogUserDTOTest extends TestCase {
    private const VALID_EMAIL = '2437527@csfoy.ca';
    private const INVALID_EMAIL_END = '2437527@ca';
    private const INVALID_EMAIL_START = '@csfoy.ca';
    private const VALID_PASSWORD = '12345678';
    private const INVALID_PASSWORD = '1234567';

    public function testif_validEmailAndPassword_then_canCreateObject(){
        $logDTO = new LogUserDTO(self::VALID_EMAIL, self::VALID_PASSWORD);
        // Il n'y a pas de validations, car si la validation ne fonctionnait pas, il y aurait une ListException
    }

    public function testif_invalidEmailEnd_then_cannotCreateObject() {
        try {
            $logDTO = new LogUserDTO(self::INVALID_EMAIL_END, self::VALID_PASSWORD);
        } catch (ListException $e) {
            $errors = $e->getMessages();
        }
        $this->assertEquals('Le courriel n\'est pas un courriel valide.', $errors[0]);
    }

    public function testif_invalidEmailStart_then_cannotCreateObject() {
        try {
            $logDTO = new LogUserDTO(self::INVALID_EMAIL_START, self::VALID_PASSWORD);
        } catch (ListException $e) {
            $errors = $e->getMessages();
        }
        $this->assertEquals('Le courriel n\'est pas un courriel valide.', $errors[0]);
    }

    public function testif_emptyEmail_then_cannotCreateObject() {
        try {
            $logDTO = new LogUserDTO('', self::VALID_PASSWORD);
        } catch (ListException $e) {
            $errors = $e->getMessages();
        }
        $this->assertEquals('Le courriel ne peut pas être vide.', $errors[0]);
        $this->assertEquals('Le courriel n\'est pas un courriel valide.', $errors[1]);
    }

    public function testif_invalidPassword_then_cannotCreateObject() {
        try {
            $logDTO = new LogUserDTO(self::VALID_EMAIL, self::INVALID_PASSWORD);
        } catch (ListException $e) {
            $errors = $e->getMessages();
        }
        $this->assertEquals('Le mot de passe doit contenir au moins 8 charactères.', $errors[0]);
    }

    public function testif_emptyPassword_then_cannotCreateObject() {
        try {
            $logDTO = new LogUserDTO(self::VALID_EMAIL, '');
        } catch (ListException $e) {
            $errors = $e->getMessages();
        }
        $this->assertEquals('Le mot de passe ne peut pas être vide.', $errors[0]);
        $this->assertEquals('Le mot de passe doit contenir au moins 8 charactères.', $errors[1]);
    }
}
