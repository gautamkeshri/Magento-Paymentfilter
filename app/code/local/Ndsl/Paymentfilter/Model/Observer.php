<?php
class Ndsl_Paymentfilter_Model_Observer
{

			public function paymentMethodIsActive(Varien_Event_Observer $observer)
			{
				$checkResult = $observer->getEvent()->getResult();
				$method = $observer->getEvent()->getMethodInstance();
				$status = true;
				if ($checkResult->isAvailable) {
					if($method->getCode() == 'cashondelivery'){
						//Mage::log(Mage::helper('paymentfilter')->getAllowedPaymentMethodsForCurrentSku(),null,'attribute.log');
						$attributes = Mage::helper('paymentfilter')->getAllowedPaymentMethodsForCurrentSku();
						foreach($attributes as $attribute)
						{
							if($attribute != 'Default'){
								$status = false;
								break;
							}
						}
						if($status){
							$checkResult->isAvailable = true;
						}else{
							$checkResult->isAvailable = false;
						}
					}		
				}
			}
}
