<?php

namespace Kingdom\Shared\Domain\Contracts;

interface MessageContract
{
    public function sendSMS(string $to, string $message): array;
}
