<?php
class CeckosLab_OscRegisteredFreeShipping_Model_Observer
{
    public function clearSession(Varien_Event_Observer $observer) {

        $quote = Mage::getSingleton('checkout/type_onepage')->getQuote();

        $freeshippingSession = Mage::getSingleton('oscregisteredfreeshipping/session');
        $freeshippingSession->setData('will_register',false);

        $quote->getShippingAddress()->setCollectShippingRates(true);
        $quote->collectTotals()->save();

        return $this;
    }
}