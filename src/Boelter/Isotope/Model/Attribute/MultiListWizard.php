<?php

namespace Boelter\Isotope\Model\Attribute;

use Contao\FrontendTemplate;
use Isotope\Interfaces\IsotopeProduct;
use Isotope\Model\Attribute;

class MultiListWizard extends Attribute
{

    public function getBackendWidget()
    {
        if (!isset($GLOBALS['BE_FFL']['multiColumnWizard'])) {
            throw new \LogicException('Backend widget for attribute type "multiColumnWizard" does not exist.');
        }

        return $GLOBALS['BE_FFL']['multiColumnWizard'];
    }

    /**
     * @inheritdoc
     */
    public function saveToDCA(array &$arrData)
    {
        parent::saveToDCA($arrData);

        // get wizard config
        $wizardConfig = deserialize($this->multilistwizard, true);
        $dcaConfig    = array();

        // generate mcw config based on attribute config
        foreach ($wizardConfig as $field) {
            $dcaConfig[$field['column']] = array
            (
                'label'     => array(($field['label'] ?: $field['column'])),
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array
                (
                    'style' => 'width:' . $field['width'],
                ),
            );
        }

        // add the fields to the attribute
        $arrData['fields'][$this->field_name]['eval']['columnFields'] = $dcaConfig;
        $arrData['fields'][$this->field_name]['sql']                  = "blob NULL";
    }

    /**
     * @inheritdoc
     */
    public function generate(IsotopeProduct $product, array $arrOptions = array())
    {
        // get the list items from database
        $listItems = deserialize($product->{$this->field_name}, true);

        // generate attribute based on mcw config and template
        $template                  = new FrontendTemplate($this->multilistwizard_template ?: 'multilistwizard');
        $template->listItems       = $listItems;
        $template->multilistwizard = deserialize($this->multilistwizard, true);

        return $template->parse();
    }
}