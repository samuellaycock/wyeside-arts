<?php

namespace App\Model\Tmdb;

use Tmdb\ApiToken;
use Tmdb\Client;

/**
 * @author james.dobb@gmail.com
 */
abstract class TmdbClientFactory
{

    CONST ACCESS_TOKEN = "28d795ba2fd6e6bb814be52765852b16";
    CONST IMG_PREFIX = "https://image.tmdb.org/t/p/original/";

    /**
     * @return Client
     */
    public static function build(array $configs = null)
    {
        if (is_null($configs)) {
            $configs = [

            ];
        }

        return new Client(
            new ApiToken(self::ACCESS_TOKEN),
            $configs
        );
    }

}