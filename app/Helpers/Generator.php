<?php

declare(strict_types=1);

namespace App\Helpers;

use Ramsey\Uuid\Uuid;
use Sajya\Server\Exceptions\InvalidParams;

class Generator
{
    /**
     * @param string $algo
     *
     * @return string
     */
    public static function generateToken(string $algo = 'sha256', ?string $secretKey = null): string
    {
        if (! in_array($algo, hash_hmac_algos(), true)) {
            throw new InvalidParams(['algo' => "Unsupported hashing algorithm: $algo."]);
        }

        $secretKey ??= self::generateSecretKey();

        return hash_hmac($algo, self::generateUuid4(), $secretKey);
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public static  function generateSecretKey(int $length = 32): string
    {
        if ($length < 1) {
            throw new InvalidParams(['algo' => 'Length must be greater than 0.']);
        }

        return bin2hex(random_bytes($length));
    }

    /**
     * @return string
     */
    public static  function generateUuid4(): string
    {
        return Uuid::uuid4()->toString();
    }
}
