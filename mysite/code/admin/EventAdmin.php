<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/12/16
 * Time: 2:11 PM
 */
class EventAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array('Event');

    /**
     * @var string
     */
    private static $url_segment = "Events-awaiting-approval";

    /**
     * @var string
     */
    private static $menu_title = "Event's";

    public function getList()
    {
        $list = parent::getList();
//        if($this->modelClass == 'Event'){
//            $list = $list->exclude('EventApproved', 1);
//        }
        return $list;
    }

    /**
     * @param null $id
     * @param null $fields
     * @return \Form
     */
    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        $gridField = $form->Fields()
            ->fieldByName($this->sanitiseClassName($this->modelClass));

        $config = $gridField->getConfig();

        $config->getComponentByType('GridFieldPaginator')->setItemsPerPage(20);
        $config->getComponentByType('GridFieldDataColumns')
            ->setDisplayFields(array(
                'EventTitle'  => 'EventTitle',
                'EventDate' => 'EventDate',
                'EventApproved' => 'EventApproved'
            ));

        return $form;
    }


}