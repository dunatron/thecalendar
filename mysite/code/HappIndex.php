<?php

class HappIndex extends SolrIndex {
    function init()
    {
        //https://github.com/silverstripe/silverstripe-fulltextsearch/blob/master/docs/en/Solr.md
        $this->addClass('Event');
        $this->addAllFulltextFields('EventTitle');
        $this->addStoredField('EventTitle');
        $this->addStoredField('EventDescription');

        $this->addBoostedField('EventTitle', null, array(), 1.5);
		$this->setFieldBoosting('Event_SearchBoost', 2);

    }
}