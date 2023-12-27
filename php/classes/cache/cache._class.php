<?php

class Cache
{
    static $dir = 'cache/';
    static $_CACHE = [];

    use Cache_init;
    use Cache_get;
    use Cache_set;

}
