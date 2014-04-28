<?php

namespace Model;

class CacheEntry extends Base implements \Interfaces\Model {

	public function get($key) {
        return apc_fetch($key);
    }

}