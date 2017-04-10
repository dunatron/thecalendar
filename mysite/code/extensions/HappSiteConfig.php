<?php

/**
 * Created by PhpStorm.
 * User: Heath
 * Date: 13/02/17
 * Time: 9:24 PM
 */
class HappSiteConfig extends DataExtension
{
    private static $db = array(
        'ClientColor' => 'Varchar(20)',
        'SecondBarColor' => 'Varchar(20)',
        'EventBackgroundColor' => 'Varchar(20)',
        'EventBackgroundHoverColor' => 'Varchar(20)',
        'LetterColor'   =>  'Varchar(20)',
        'LetterHoverColor'  =>  'Varchar(20)',
        'CurrentDayColor'   =>  'Varchar(20)',
        'CurrentDayBackground'  =>  'Varchar(20)',
        'MenuIconColors'    =>  'Varchar(20)'
    );

    private static $has_one = array(
        'HappLogo' => 'Image',
        'ClientLogo' => 'Image'
    );

    public function updateCMSFields(FieldList $fields)
    {

        /** Colors
         * ClientColor
         */
        $fields->addFieldToTab('Root.Colors',
            TextField::create('ClientColor', 'Client Color')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // SecondBarColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('SecondBarColor', 'second bar containing the days')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // MenuIconColors
        $fields->addFieldToTab('Root.Colors',
            TextField::create('MenuIconColors', 'Color for the menu Icons, search, add, filter')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // EventBackgroundColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('EventBackgroundColor', 'event background color')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // EventBackgroundHoverColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('EventBackgroundHoverColor', 'event background hover stop')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // LetterColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('LetterColor', 'Letter Color for the events')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // LetterHoverColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('LetterHoverColor', 'Letter Hover Color for the events')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // CurrentDayColor
        $fields->addFieldToTab('Root.Colors',
            TextField::create('CurrentDayColor', 'Current Day number color')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));
        // CurrentDayBackground
        $fields->addFieldToTab('Root.Colors',
            TextField::create('CurrentDayBackground', 'Background color for the current day')
                ->setDescription('Please enter rgb or hex value as varchar e.g #425968 or rgba(66,89,104)'));

        // Logos
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