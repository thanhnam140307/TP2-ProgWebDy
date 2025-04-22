<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class UserDTO
{
    public $email;
    public $password;
    public $confirmPassword;

    public function __construct($email, $password, $confirmPassword) {
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function isEmpty(string $input): bool {
        if (empty(trim($input)))
            return true;

        return false;
    }

    public function isEqualToRegex(string $inputType): bool {
        $regex = '';

        if ($inputType == "email") {
            $regex = '/^[\w.]{1,}@[a-z]{2,}.[a-z]{2,}$/';
            $input = $this->email;
        }

        else if ($inputType == "password") {
            $regex = '/^.{8,}$/';
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
}
