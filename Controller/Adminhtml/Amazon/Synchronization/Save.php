<?php

/*
 * @author     M2E Pro Developers Team
 * @copyright  M2E LTD
 * @license    Commercial use is forbidden
 */

namespace Ess\M2ePro\Controller\Adminhtml\Amazon\Synchronization;

use Ess\M2ePro\Controller\Adminhtml\Amazon\Settings;

class Save extends Settings
{
    //########################################

    public function execute()
    {
        $this->modelFactory->getObject('Config\Manager\Synchronization')->setGroupValue(
            '/amazon/templates/', 'mode',
            (int)$this->getRequest()->getParam('templates_mode')
        );

        $this->setJsonContent(['success' => true]);
        return $this->getResult();
    }

    //########################################
}