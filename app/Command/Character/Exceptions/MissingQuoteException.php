<?php

declare(strict_types=1);

namespace App\Command\Character\Exceptions;

use App\Helpers\ResponseCodeHelper;
use Exception;
use Throwable;

class MissingQuoteException extends Exception
{
    public function __construct($message = 'The quote is missing', $code = ResponseCodeHelper::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
