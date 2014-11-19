<?php
class Ndsl_Paymentfilter_Helper_Data extends Mage_Core_Helper_Abstract
{	
	protected $_allowedPaymentMethodsForCart;
	public function getAllowedPaymentMethodsForCurrentSku(){
		if (null === $this->_allowedPaymentMethodsForCart)
		{
			$methods = array();
			$items  = Mage::getSingleton('checkout/cart')->getQuote()->getAllItems();
			//$skulist = Mage::getStoreConfig('paymentfilter/paymentselection/skulist';	
			//$skulist = "Default";	
			foreach ($items as $item)
			{
				try
				{
					$product = Mage::getModel('catalog/product')->load($item->getProductId());
					$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
					$attributeSetModel->load($product->getAttributeSetId());
					$attributeSetName = $attributeSetModel->getAttributeSetName();
					$methods[] = $attributeSetName;
				}catch(Exception $e){
						Mage::getSingleton('core/session')->addError($e->getMessage());
				}
			}
			$this->_allowedPaymentMethodsForCart = $methods;
		}
		return $this->_allowedPaymentMethodsForCart;
	}
}
	 