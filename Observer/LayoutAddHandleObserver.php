<?php

namespace Wyganowski\Example\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

class LayoutAddHandleObserver implements ObserverInterface
{
    public function __construct(
        private readonly Registry $registry,
    ) {
    }

    public function execute(Observer $observer): void
    {
        // Your current category
        $category = $this->registry->registry('current_category');

        // Your current product
        $product = $this->registry->registry('current_product');

        // If you want to only change layout for a categories add this validation:
        if (!$category || $product) {
            return;
        }

        // If you want to only change layout for a products add this validation:
        // if (!$product) {
        //     return;
        // }

        $selectedCategoryIds = [1,2,3];
        $categoryId = $category->getId(); // for product use $product->getId()

        if (in_array($categoryId, $selectedCategoryIds)) {
            $layout = $observer->getLayout();

            // Below add your layout XML file
            $layout->getUpdate()->addHandle('example_layout');
        }
    }
}