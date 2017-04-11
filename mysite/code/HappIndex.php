<?php

class HappIndex extends SolrIndex {
    function init()
    {
        //https://github.com/silverstripe/silverstripe-fulltextsearch/blob/master/docs/en/Solr.md
        $this->addClass('Event');
        $this->addAllFulltextFields();
        $this->addStoredField('Content');
        $this->addStoredField('Title');
        // $this->addFulltextField('Title');
        // $this->addFulltextField('Content');
    }
}