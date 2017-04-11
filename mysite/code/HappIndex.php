<?php

class HappIndex extends SolrIndex {
    function init()
    {
        //https://github.com/silverstripe/silverstripe-fulltextsearch/blob/master/docs/en/Solr.md
        $this->addClass('Event');
        $this->addAllFulltextFields();
        //$this->addFulltextField('_versionedstage');
        $this->addStoredField('EventTitle');
        $this->addStoredField('EventDescription');
        // $this->addFulltextField('Title');
        // $this->addFulltextField('Content');
    }
}