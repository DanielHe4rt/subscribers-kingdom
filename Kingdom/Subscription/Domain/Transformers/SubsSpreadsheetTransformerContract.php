<?php

namespace Kingdom\Subscription\Domain\Transformers;

interface SubsSpreadsheetTransformerContract
{
    public function fromCSV(array $payload): array;
}
