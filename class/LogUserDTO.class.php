<?php
declare(strict_types=1);

class LogUserDTO {
    
    public const EMAIL_REGEX = '/^[\w.]{1,}@[a-z]{2,}+.[a-z]{2,}$/';
    public const PASSWORD_REGEX = '/^.{8,}$/';

    public const EX_EMPTY_EMAIL = 'Le courriel ne peut pas être vide.';
    public const EX_INVALID_EMAIL = 'Le courriel n\'est pas un courriel valide.';
    public const EX_EMPTY_PASSWORD = 'Le mot de passe ne peut pas être vide.';
    public const EX_INVALID_PASSWORD = 'Le mot de passe doit contenir au moins 8 charactères.';


    private $email;
    private $password;

    private $errors = [];

    public function __construct($email, $password) {
        if ($this->isEmpty($email)) $this->errors = self::EX_EMPTY_EMAIL;
        if (!$this->validateEmail($email)) $this->errors = self::EX_INVALID_EMAIL;
        if ($this->isEmpty($password)) $this->errors = self::EX_EMPTY_PASSWORD;
        if (!$this->validateEmail($password)) $this->errors = self::EX_INVALID_PASSWORD;
        if (!empty($this->errors)) throw new InvalidArgumentException($this->errors);
        $this->email = $email;
        $this->password = $password;
    }

    private function isEmpty(string $text) : bool {
        return empty(trim($text));
    }

    private function validateEmail(string $email): bool {
        return preg_match(self::EMAIL_REGEX, trim($email));
    }

    private function validatePassword(string $password): bool {
        return preg_match(self::PASSWORD_REGEX, trim($password));
    }

}