<?php

class MDN_PrivateSales_Block_Admin_FlashSales_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('flashSaleForm');
    }

    /**
     * Prepare form data
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
		$obj = mage::registry('current_flash_sale');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getData('action'),
            'method'    => 'post',
			'enctype'   => 'multipart/form-data'
        ));
		
		$dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
       
		$fieldset = $form->addFieldset('flashsale_fieldset', array(
			'legend' => Mage::helper('PrivateSales')->__('Information')
		));

		if ($obj)
		{
			$fieldset->addField('fs_id', 'hidden', array(
				'name'      => 'fs_id',
				'label'     => mage::helper('PrivateSales')->__('Id')
			));
		}
		
		$fieldset->addField('fs_name', 'text', array(
			'name'      => 'fs_name',
			'label'     => mage::helper('PrivateSales')->__('Name'),
			'required'  => true,
		));

		$fieldset->addField('fs_enabled', 'select', array(
			'name'      => 'fs_enabled',
			'label'     => mage::helper('PrivateSales')->__('Enabled'),
			'options'	=> array('0' => $this->__('No'), '1' => $this->__('Yes'))
		));
		
		$fieldset->addField('fs_start_date', 'date', array(
			'name'      => 'fs_start_date',
			'label'     => mage::helper('PrivateSales')->__('From date'),
			'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => $dateFormatIso,
		));
		
		$fieldset->addField('fs_start_time', 'time', array(
			'name'      => 'fs_start_time',
			'label'     => mage::helper('PrivateSales')->__('From hour'),
		));
		
		$fieldset->addField('fs_end_date', 'date', array(
			'name'      => 'fs_end_date',
			'label'     => mage::helper('PrivateSales')->__('To at'),
			'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => $dateFormatIso,
		));
		
		$fieldset->addField('fs_end_time', 'time', array(
			'name'      => 'fs_end_time',
			'label'     => mage::helper('PrivateSales')->__('To hour'),
		));
		
		$fieldset->addField('fs_category_id', 'select', array(
			'name'      => 'fs_category_id',
			'label'     => mage::helper('PrivateSales')->__('Category'),
			'options'	=> mage::helper('PrivateSales/Category')->geAllOptions()
		));
		
		$fieldset->addField('fs_description', 'textarea', array(
			'name'      => 'fs_description',
			'label'     => mage::helper('PrivateSales')->__('Description')
		));
				
		$fieldset->addField('fs_picture', 'image', array(
			'name'      => 'fs_picture',
			'label'     => mage::helper('PrivateSales')->__('Picture'),
		));
		
		if ($obj)
			$form->addValues($obj->getData());
		
        $form->setAction($this->getUrl('*/*/save'));
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
