<?php
/**
 * @company    Bytes Technolab<www.bytestechnolab.com> 
 * @author     Bytes Technolab<info@bytestechnolab.com>
*/
class Shopalize_Productsharing_Block_System_Config_Info
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface{

    /**
     * Render fieldset html
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
    */
    public function render(Varien_Data_Form_Element_Abstract $element){
        $html = '<div style="background:url(\'http://www.shopalize.com/images/shopalize_icon.png\') no-repeat scroll 15px center #EAF0EE;border:1px solid #CCCCCC;margin-bottom:10px;padding:10px 5px 5px 200px;">
                    <h4>About Shopalize</h4>
                    <p>Shopalize provides a comprehensive Social Commerce platform for online retailers to help increase social sharing and customer referrals from Social Media to their eCommerce stores.<br />Shopalize&acute;s Product Sharing Plugin appears on your store&acute;s product detail page.Shoppers are prompted and rewarded for sharing product or your store with their friends on Facebook or Twitter. Shopalize also provide an A/B Testing platform to experiment with various campaigns and social analytics suite to measure ROI and track influential customers.<br />
          					<h4>Contact Us</h4>	
          			Website:  <a href="http://www.shopalize.com" target="_blank">www.shopalize.com</a><br />
                    Email: <a href="mailto:help@shopalize.com">help@shopalize.com</a><br />
                    Skype: adikot<br />
                    </p>
                </div>';

        return $html;
    }
}
