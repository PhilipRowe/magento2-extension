<?php

/*
 * @author     M2E Pro Developers Team
 * @copyright  M2E LTD
 * @license    Commercial use is forbidden
 */

namespace Ess\M2ePro\Model\Walmart\Template\Category;

/**
 * Class \Ess\M2ePro\Model\Walmart\Template\Category\AffectedListingsProducts
 */
class AffectedListingsProducts extends \Ess\M2ePro\Model\Template\AffectedListingsProducts\AbstractModel
{
    protected $walmartFactory;

    //########################################

    public function __construct(
        \Ess\M2ePro\Model\ActiveRecord\Component\Parent\Walmart\Factory $walmartFactory,
        \Ess\M2ePro\Model\ActiveRecord\Factory $activeRecordFactory,
        \Ess\M2ePro\Helper\Factory $helperFactory,
        \Ess\M2ePro\Model\Factory $modelFactory,
        array $data = []
    ) {
        $this->walmartFactory = $walmartFactory;
        parent::__construct($activeRecordFactory, $helperFactory, $modelFactory, $data);
    }

    //########################################

    public function getObjects(array $filters = [])
    {
        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Collection $listingCollection */
        $listingCollection = $this->walmartFactory->getObject('Listing')->getCollection();
        $listingCollection->addFieldToFilter('template_category_id', $this->model->getId());
        $listingCollection->getSelect()->reset(\Zend_Db_Select::COLUMNS);
        $listingCollection->getSelect()->columns('id');

        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Product\Collection $listingProductCollection */
        $listingProductCollection = $this->walmartFactory->getObject('Listing\Product')->getCollection();
        $listingProductCollection->addFieldToFilter('listing_id', ['in' => $listingCollection->getSelect()]);

        if (!empty($filters['only_physical_units'])) {
            $listingProductCollection->addFieldToFilter('is_variation_parent', 0);
        }

        return $listingProductCollection->getItems();
    }

    public function getObjectsData($columns = '*', array $filters = [])
    {
        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Collection $listingCollection */
        $listingCollection = $this->walmartFactory->getObject('Listing')->getCollection();
        $listingCollection->addFieldToFilter('template_category_id', $this->model->getId());
        $listingCollection->getSelect()->reset(\Zend_Db_Select::COLUMNS);
        $listingCollection->getSelect()->columns('id');

        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Product\Collection $listingProductCollection */
        $listingProductCollection = $this->walmartFactory->getObject('Listing\Product')->getCollection();
        $listingProductCollection->addFieldToFilter('listing_id', ['in' => $listingCollection->getSelect()]);

        if (!empty($filters['only_physical_units'])) {
            $listingProductCollection->addFieldToFilter('is_variation_parent', 0);
        }

        if (is_array($columns) && !empty($columns)) {
            $listingProductCollection->getSelect()->reset(\Zend_Db_Select::COLUMNS);
            $listingProductCollection->getSelect()->columns($columns);
        }

        return $listingProductCollection->getData();
    }

    public function getIds(array $filters = [])
    {
        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Collection $listingCollection */
        $listingCollection = $this->walmartFactory->getObject('Listing')->getCollection();
        $listingCollection->addFieldToFilter('template_category_id', $this->model->getId());
        $listingCollection->getSelect()->reset(\Zend_Db_Select::COLUMNS);
        $listingCollection->getSelect()->columns('id');

        /** @var \Ess\M2ePro\Model\ResourceModel\Listing\Product\Collection $listingProductCollection */
        $listingProductCollection = $this->walmartFactory->getObject('Listing\Product')->getCollection();
        $listingProductCollection->addFieldToFilter('listing_id', ['in' => $listingCollection->getSelect()]);

        if (!empty($filters['only_physical_units'])) {
            $listingProductCollection->addFieldToFilter('is_variation_parent', 0);
        }

        return $listingProductCollection->getAllIds();
    }

    //########################################
}
