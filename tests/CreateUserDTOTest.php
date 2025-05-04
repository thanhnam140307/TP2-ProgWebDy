<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__ . "/CreateUserDTO.class.php";

class CreateUserDTOTest extends TestCase
{
    private const INPUT_TYPE_EMAIL = "email";
    private const INPUT_TYPE_PASSWORD = "password";
    private const VALIDE_EMAIL = "newEmail@gmail.com";
    private const VALIDE_PASSWORD = "12345678";
    private const INVALIDE_EMAIL = "newEmail@gmail.";
    private const INVALIDE_PASSWORD = "1234567";

    public function testCanCreateUserDTO()
    {
        // Arrange
        $userDTO = new UserDTO(self::VALIDE_EMAIL, self::VALIDE_PASSWORD, self::VALIDE_PASSWORD);

        //Act
        $email = $userDTO->getEmail();
        $password = $userDTO->getPassword();
        $confirmPassword = $userDTO->getConfirmPassword();

        // Assert
        $this->assertEquals(self::VALIDE_EMAIL, $email);
        $this->assertEquals(self::VALIDE_PASSWORD, $password);
        $this->assertEquals(self::VALIDE_PASSWORD, $confirmPassword);
    }

    public function testMethodIsEmptyCanCheckIfInputsEmpty()
    {
        // Arrange
        $userDTO = new UserDTO("", "", "");

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
        $userDTO = new UserDTO(self::VALIDE_EMAIL, self::VALIDE_PASSWORD, self::VALIDE_PASSWORD);

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
        $userDTO = new UserDTO(self::INVALIDE_EMAIL, self::INVALIDE_PASSWORD, self::INVALIDE_PASSWORD);

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
        $userDTO = new UserDTO("", "", "");

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
        $userDTO = new UserDTO(self::VALIDE_EMAIL, self::VALIDE_PASSWORD, self::VALIDE_PASSWORD);

        //Act
        $isConfirmPasswordCorrect = $userDTO->isConfirmPasswordCorrect();

        // Assert
		$this->assertTrue($isConfirmPasswordCorrect);
    }

    public function testMethodIsConfirmPasswordCorrectReturnFalseIfConfirmPasswordNotEqualPassword()
    {
        // Arrange
        $userDTO = new UserDTO(self::VALIDE_EMAIL, self::VALIDE_PASSWORD, self::INVALIDE_PASSWORD);

        //Act
        $isConfirmPasswordCorrect = $userDTO->isConfirmPasswordCorrect();

        // Assert
		$this->assertFalse($isConfirmPasswordCorrect);
    }
}
