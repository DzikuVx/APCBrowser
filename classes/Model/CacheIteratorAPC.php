<?php

namespace Model;

use General\Formater;

class CacheIteratorAPC extends Base implements \Interfaces\Model {

	public function iterate($query = '', $bWithValue = false) {

        //TODO add regexp to get only some

        $oIterator = new \APCIterator("user");

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

    public function processEntries(&$results) {

        foreach ($results as &$result) {
            $result['mtime'] = Formater::formatDateTime($result['mtime']);
            $result['atime'] = Formater::formatDateTime($result['access_time']);
            $result['ctime'] = Formater::formatDateTime($result['creation_time']);
            $result['nhits'] = $result['num_hits'];

            unset($result['access_time']);
            unset($result['creation_time']);
            unset($result['num_hits']);
        }

    }

}