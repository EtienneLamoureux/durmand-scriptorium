<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use MyCLabs\Enum\Enum;

/**
 * ISO 639-1 locales supported by the GW2 API
 */
class Locale extends Enum
{

    /**
     * English
     */
    const ENGLISH = 'en';

    /**
     * Español
     */
    const SPANISH = 'es';

    /**
     * Deutsch
     */
    const GERMAN = 'de';

    /**
     * Français
     */
    const FRENCH = 'fr';

    /**
     * 한국어 (Hangugeo)
     */
    const KOREAN = 'ko';

    /**
     * 中文; Zhōngwén
     */
    const CHINESE = 'zh';

}
