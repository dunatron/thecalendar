<?php
/**
 * Created by PhpStorm.
 * User: Heath
 * Date: 13/02/17
 * Time: 9:24 PM
 */
class HappSiteConfig extends DataExtension
{
    private static $db = array();

    private static $has_one = array(
        'HappLogo'  =>  'Image',
        'ClientLogo'    =>  'Image'
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Logos",
           UploadField::create('HappLogo', 'Happ Logo')
            ->setDescription('The Happ Logo goes here')
            ->setFolderName('Logos')
        );
        $fields->addFieldToTab("Root.Logos",
            UploadField::create('ClientLogo', 'The client logo goes here')
                ->setDescription('Please put the client logo here')
                ->setFolderName('Logos')
        );

    }
}