<?php
/**
 * @company    Bytes Technolab<www.bytestechnolab.com> 
 * @author     Bytes Technolab<info@bytestechnolab.com>
*/

class Shopalize_Productsharing_Block_Button extends Mage_Core_Block_Template{

    protected $_isIntegration = false;
	const PRODUCT_IMAGE_SIZE = 256;

    public function isIntegration(){
        $this->_isIntegration = true;
        return $this;
    }

	/**
     * Product
     *
     * @return Mage_Catalog_Model_Product
    */
    public function getProduct(){

        if ($product = Mage::registry('current_product')){
            return $product;
        }
        return false;
	}

	/**
     * Product URL
    */
	public function getCanonicalUrl(){
        $params = array();
        if (Mage::helper('catalog/product')->canUseCanonicalTag()){
            $params = array('_ignore_category'=>true);
        }
		
        /** @var Mage_Catalog_Model_Product $product  */
        $product = $this->getProduct();
        return $product->getUrlModel()->getUrl($product, $params);
    }

	/**
     * Product URL
    */
	public function getProductUrl(){
        return $this->getCanonicalUrl();
    }

	/**
     * Product Short Description
    */
	public function getShortDescription($_product){
        $shortDescription = strip_tags($_product->getShortDescription());		
		$shortDescription = Mage::helper('catalog/output')->productAttribute($_product, strip_tags(str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $shortDescription)), 'short_description');
		$shortDescription = str_replace('\'', '\\\'', $shortDescription);		

        return $shortDescription;
    }
	
	/**
     * Product Name
    */
	public function getProductName(){
        $name = strip_tags($this->getProduct()->getName());
		$name = str_replace("'", "", $name);
		return addslashes($name);
    }
	
	/**
     * Product Image
    */
	public function getProductImage($_product){
		return Mage::helper('catalog/image')->init($_product, 'image', $_product->getImage())->resize(self::PRODUCT_IMAGE_SIZE)->__toString();
	}

	/**
     * Product Price
    */
	public function getProductPrice($_product){
		if($this->getProduct()->getTypeId() == 'bundle'){			
			 $_priceModel  = $_product->getPriceModel();
			list($_minimalPriceInclTax, $_maximalPriceInclTax) = $_priceModel->getTotalPrices($_product, null, true, false);
			return $_minimalPriceInclTax;
		} else {
			return $this->getProduct()->getPrice();
		}
	}
	
	/**
     * Product Special Price
    */
	public function getProductSpecialPrice($_product){
		if($this->getProduct()->getTypeId() == 'bundle'){			
			 $_priceModel  = $_product->getPriceModel();
			list($_minimalPriceInclTax, $_maximalPriceInclTax) = $_priceModel->getTotalPrices($_product, null, true, false);
			return $_minimalPriceInclTax;
		} else {
			$special_price = $this->getProduct()->getSpecialPrice();
			
			if($special_price == '')
				return $this->getProduct()->getProductPrice();
			else
				return $special_price;
		}
	}
	
	/*
	* Get Product Category URL
	*/
	public function getProductCategoryURL($_product){
		$categories = $_product->getCategoryIds();

		$cat_name = '';
		$cat_url = '';
		foreach($categories as $k => $_category_id):
			$_category = Mage::getModel('catalog/category')->load($_category_id);
			$cat_url = $_category->getUrl();
			break;
		endforeach;

		return $cat_url;
	}

	/**
     * Shopalized Product Sharing Enabled
    */
	public function isEnabled(){
		return Mage::getStoreConfig('productsharing/settings/active');
	}
	
	/**
     * Product Shopalized Merchant Id
    */
	public function getShopalizeMerchantId(){
		/* if(Mage::getStoreConfig('purchasesharing/settings/active')){
			return Mage::getStoreConfig('purchasesharing/settings/merchant_id');
		}else{
			return Mage::getStoreConfig('productsharing/settings/merchant_id');
		}*/
	}

	/**
     * Product Shopalized Store Id
    */
	public function getShopalizeStoreId(){
		if(Mage::getStoreConfig('purchasesharing/settings/active')){
			return Mage::getStoreConfig('purchasesharing/settings/store_id');
		}else{
			return Mage::getStoreConfig('productsharing/settings/store_id');
		}
	}
	
	public function isPurchaseSharingEnabled(){
		return Mage::getStoreConfig('purchasesharing/settings/active');
	}
	
	public function getButtonClassName(){
		return Mage::getStoreConfig('productsharing/settings/share_button_class');
	}
	
	public function getButtonTextName(){
		return Mage::getStoreConfig('productsharing/settings/share_button_text');
	}

}