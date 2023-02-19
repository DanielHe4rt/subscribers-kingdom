<?php

namespace Kingdom\Phone\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PhoneNumberException extends Exception
{
    public static function alreadyRegistered(): self
    {
        return new self(
            'O número inserido já está registrado em outra conta :/',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public static function invalidToken(): self
    {
        return new self(
            'Token não vinculado à nenhum dispositivo :/',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
