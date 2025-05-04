<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__ . "\CreateUserDTO.class.php";

class CreateUserDTOTest extends TestCase
{
    private const INPUT_TYPE_EMAIL = "email";
    private const INPUT_TYPE_PASSWORD = "password";

    public function testCanCreateUserDTO()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars("newEmail@gmail.com"), htmlspecialchars("12345678"), htmlspecialchars("12345678"));

        //Act
        $email = $userDTO->getEmail();
        $password = $userDTO->getPassword();
        $confirmPassword = $userDTO->getConfirmPassword();

        // Assert
        $this->assertEquals("newEmail@gmail.com", $email);
        $this->assertEquals("12345678", $password);
        $this->assertEquals("12345678", $confirmPassword);
    }

    public function testMethodIsEmptyCanCheckIfInputsEmpty()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars(""), htmlspecialchars(""), htmlspecialchars(""));

        //Act
        $email = $userDTO->getEmail();
        $password = $userDTO->getPassword();
        $confirmPassword = $userDTO->getConfirmPassword();

        // Assert
		$this->assertTrue($userDTO->isEmpty($email));
        $this->assertTrue($userDTO->isEmpty($password));
		$this->assertTrue($userDTO->isEmpty($confirmPassword));
    }

    public function testMethodIsEqualToRegexReturnTrueIfEmailAndPasswordFilledAndRespectRegex()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars("newEmail@gmail.com"), htmlspecialchars("12345678"), htmlspecialchars("12345678"));

        //Act
        $isEmailValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_EMAIL);
        $isPasswordValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_PASSWORD);

        // Assert
		$this->assertTrue($isEmailValide);
        $this->assertTrue($isPasswordValide);
    }

    public function testMethodIsEqualToRegexReturnFalseIfEmailAndPasswordFilledAndNotRespectRegex()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars("newEmail@gmail."), htmlspecialchars("1234567"), htmlspecialchars("1234567"));

        //Act
        $isEmailValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_EMAIL);
        $isPasswordValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_PASSWORD);

        // Assert
		$this->assertFalse($isEmailValide);
        $this->assertFalse($isPasswordValide);
    }

    public function testMethodIsEqualToRegexReturnTrueIfEmailAndPasswordEmpty()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars(""), htmlspecialchars(""), htmlspecialchars(""));

        //Act
        $isEmailValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_EMAIL);
        $isPasswordValide = $userDTO->isEqualToRegex(self::INPUT_TYPE_PASSWORD);

        // Assert
		$this->assertTrue($isEmailValide);
        $this->assertTrue($isPasswordValide);
    }

    public function testMethodIsConfirmPasswordCorrectReturnTrueIfConfirmPasswordEqualPassword()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars("newEmail@gmail.com"), htmlspecialchars("12345678"), htmlspecialchars("12345678"));

        //Act
        $isConfirmPasswordCorrect = $userDTO->isConfirmPasswordCorrect();

        // Assert
		$this->assertTrue($isConfirmPasswordCorrect);
    }

    public function testMethodIsConfirmPasswordCorrectReturnFalseIfConfirmPasswordNotEqualPassword()
    {
        // Arrange
        $userDTO = new UserDTO(htmlspecialchars("newEmail@gmail.com"), htmlspecialchars("12345678"), htmlspecialchars("1234567"));

        //Act
        $isConfirmPasswordCorrect = $userDTO->isConfirmPasswordCorrect();

        // Assert
		$this->assertFalse($isConfirmPasswordCorrect);
    }
}
