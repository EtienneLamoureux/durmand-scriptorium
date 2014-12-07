<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

class Settings
{

    const MAX_PAGE_SIZE = 200;
    const FIRST_PAGE_NB = 0;
    const NB_OF_PARALLEL_REQUESTS = 20;
    const MAX_IDS_SINGLE_REQUEST = 200;
    const TIMEOUT_LIMIT_IN_SECONDS = 300;
    const MEMORY_LIMIT = "100M";
    const ID = 'id';
    const IDS = 'ids';
    const PAGE = 'page';
    const LANG = 'lang';
    const ID_SEPARATOR = ',';
    const PAGE_SIZE = 'page_size';
    const QUANTITY = 'quantity';
    const INPUT = 'input';
    const OUTPUT = 'output';
    const GET = 'GET';
    const TOTAL_PAGE_HEADER = 'x-page-total';
    const BASE_URL = 'https://api.guildwars2.com';
    const QUAGGANS_ENDPOINT = '/v2/quaggans';
    const LISTINGS_ENDPOINT = '/v2/commerce/listings';
    const PRICES_ENDPOINT = '/v2/commerce/prices';
    const ITEMS_ENDPOINT = '/v2/items';
    const GEMS_ENDPOINT = '/v2/commerce/exchange/gems';
    const COINS_ENDPOINT = '/v2/commerce/exchange/coins';
    const WORLDS_ENDPOINT = '/v2/worlds';
    const RECIPES_ENDPOINT = '/v2/recipes';
    const RECIPES_SEARCH_ENDPOINT = '/v2/recipes/search';

    public static $CREATE_REQUEST_OPTIONS = ['verify' => false];
    public static $LOCALE;

}
