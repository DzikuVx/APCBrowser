<?php

namespace Model;

class CacheIterator extends Base implements \Interfaces\Model {

	public function iterate($query = '', $bWithValue = false) {

        //TODO add regexp to get only some

        $oIterator = new \APCIterator("");

        $aRetVal = array();

        while ($current = $oIterator->current()) {
            if (!$bWithValue) {
                unset($current['value']);
            }
            $aRetVal[] = $current;
            $oIterator->next();
        }

        return $aRetVal;
    }

}