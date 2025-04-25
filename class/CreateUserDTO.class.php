<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class UserDTO
{
    private const EMAIL_REGEX = '/^[\w.]{1,}@[a-z]{2,}+.[a-z]{2,}$/';
    private const PASSWORD_REGEX = '/^.{8,}$/';

    private $email;
    private $password;
    private $confirmPassword;

    public function __construct($email, $password, $confirmPassword) {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setConfirmPassword($confirmPassword);
    }

    public function isEmpty(string $input): bool {
        return empty(trim($input));
    }

    public function isEqualToRegex(string $inputType): bool {
        $regex = '';

        if ($inputType == "email") {
            $regex = self::EMAIL_REGEX;
            $input = $this->email;
        }

        else if ($inputType == "password") {
            $regex = self::PASSWORD_REGEX;
            $input = $this->password;
        }

        if (!$this->isEmpty($input) && !preg_match($regex, $input))
            return false;

        if (!$this->isEmpty($input) && preg_match($regex, $input))
            return true;

        return true;
    }

    public function isConfirmPasswordCorrect(): bool {
        if ($this->confirmPassword == $this->password)
            return true;

        return false;
    }

    
    private function setEmail(string $email) : void { 
		$this->email = $email; 
	}

    private function setPassword(string $password) : void { 
		$this->password = $password; 
	}

    private function setConfirmPassword(string $confirmPassword) : void { 
		$this->confirmPassword = $confirmPassword; 
	}

    public function getEmail() : string { 
		return $this->email; 
	}

    public function getPassword() : string { 
		return $this->password; 
	}

    public function getConfirmPassword() : string { 
		return $this->confirmPassword; 
	}
}
