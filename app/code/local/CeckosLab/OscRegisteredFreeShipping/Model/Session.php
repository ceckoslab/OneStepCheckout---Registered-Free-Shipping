<?php
class CeckosLab_OscRegisteredFreeShipping_Model_Session extends Mage_Core_Model_Session_Abstract
{

    public function __construct()
    {
        $namespace = 'oscregisteredfreeshipping';
        $namespace .= '_' . (Mage::app()->getStore()->getWebsite()->getCode());

        $this->init($namespace);
        Mage::dispatchEvent('oscregisteredfreeshipping_session_init', array('oscregisteredfreeshipping_session'=>$this));
    }

}