<?php

/**
 * Add palettes to tl_iso_attribute
 */
$GLOBALS['TL_DCA']['tl_iso_attribute']['palettes']['multiListWizard'] =
    '{attribute_legend},name,field_name,type,legend;{description_legend:hide},description;{config_legend},multilistwizard,multilistwizard_template,mandatory,multilingual';

/**
 * Add fields to tl_iso_attribute
 */
$GLOBALS['TL_DCA']['tl_iso_attribute']['fields']['multilistwizard'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_iso_attribute']['multilistwizard'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => array
    (
        'columnFields' => array
        (
            'column' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_iso_attribute']['column'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array
                (
                    'style'              => 'width:230px',
                    'includeBlankOption' => true,
                ),
            ),
            'label'  => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_iso_attribute']['label'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array
                (
                    'style'              => 'width:230px',
                    'includeBlankOption' => true,
                ),
            ),
            'width'  => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_iso_attribute']['width'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('style' => 'width:100px'),
            ),
        ),
    ),
    'sql'       => "blob NULL",
);

$GLOBALS['TL_DCA']['tl_iso_attribute']['fields']['multilistwizard_template'] = array(
    'label'            => &$GLOBALS['TL_LANG']['tl_iso_attribute']['multilistwizard_template'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => function () {
        return Controller::getTemplateGroup('multilistwizard_');
    },
    'eval'             => array(
        'includeBlankOption' => true,
        'tl_class'           => 'clr',
        'chosen'             => true,
    ),
    'sql'              => "varchar(64) NOT NULL default ''",
);