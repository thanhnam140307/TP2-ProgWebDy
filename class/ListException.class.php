<?php
//Charly Paradis
declare(strict_types=1);

class ListException extends \Exception{

    private $messages = [];

    public function __construct(array $messages, string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->messages = $messages;
    }

    public function getMessages(): array {
        return $this->messages;
    }
}