<?php
class CeckosLab_OscRegisteredFreeShipping_AjaxController extends Mage_Core_Controller_Front_Action
{
    /**
     * Get one page checkout model
     *
     * @return Mage_Checkout_Model_Type_Onepage
     */
    public function getOnepage()
    {
        return Mage::getSingleton('checkout/type_onepage');
    }

    /**
     * Update shopping cart data action
     */
    public function updateAction()
    {
        $registerState = $this->getRequest()->getParam('register');

        $customerSession = Mage::getSingleton('customer/session');
        $freeshippingSession = Mage::getSingleton('oscregisteredfreeshipping/session');


        if (!$customerSession->isLoggedIn() && $registerState == 1) {
            $freeshippingSession->setData('will_register',true);
        } else {
            $freeshippingSession->setData('will_register',false);
        }

        $this->getOnepage()->getQuote()->getShippingAddress()->setCollectShippingRates(true);
        $this->getOnepage()->getQuote()->collectTotals()->save();

        // Add updated shipping HTML to the output
        $shippingHtml = $this->getLayout()
            ->createBlock('checkout/onepage_shipping_method_available')
            ->setTemplate('onestepcheckout/shipping_method.phtml')
            ->toHtml();

        $response = array();
        $response['shipping'] = $shippingHtml;

        $this->getResponse()->setBody(Zend_Json::encode($response));
    }

}
