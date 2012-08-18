<?php
/**
 * Hans2103
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Hans2103
 * @package     Hans2103_FixCacheBlockHtml
 * @copyright   Copyright (c) 2012 Hans2103 Internet. (http://www.hkweb.nl)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Sitemap model
 *
 * @category   Hans2103
 * @package    Hans2103_FixCacheBlockHtml
 * @author     Magento Core Team <core@magentocommerce.com>
 * @editor     Hans2103 <support@hkweb.nl>
 */
 
class Hans2103_FixCacheBlockHtml_Model_Rule extends Mage_CatalogRule_Model_Rule
{
   /**
     * Apply all price rules to product
     *
     * @param int|Mage_Catalog_Model_Product $product
     * @return Mage_CatalogRule_Model_Rule
     */
    public function applyAllRulesToProduct($product)
    {
        $this->_getResource()->applyAllRulesForDateRange(NULL, NULL, $product);
        $this->_invalidateCache();
 
        //Notice this little line
    Mage::app()->getCacheInstance()->cleanType('block_html');
 
        $indexProcess = Mage::getSingleton('index/indexer')->getProcessByCode('catalog_product_price');
        if ($indexProcess) {
            $indexProcess->reindexAll();
        }
    }
}