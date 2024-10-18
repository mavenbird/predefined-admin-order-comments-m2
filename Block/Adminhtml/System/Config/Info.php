<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category   Mavenbird
 * @package    Mavenbird_PredefinedAdminOrderComments
 * @author     Mavenbird Team
 * @copyright  Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license    http://mavenbird.com/Mavenbird-Module-License.txt
 */
namespace Mavenbird\PredefinedAdminOrderComments\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Mavenbird\PredefinedAdminOrderComments\Helper\Data as Helper;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Backend\Block\AbstractBlock;

class Info extends AbstractBlock implements RendererInterface
{
    /**
     * @var Helper
     */
    protected $helper;
    
    /**
     * Constructor
     * @param Context $context
     * @param Helper $helper
     */
    public function __construct(
        Context $context,
        Helper $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context);
    }
    
    /**
     * Render form element as HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $version  = $this->helper->getExtensionVersion();
        $name = $this->helper->getExtensionName();
        $logoUrl = 'https://www.Mavenbird.com/pub/media/logo/default/Mavenbird.png';
        
        $html  =
        '<div style="background: url('.$logoUrl.') no-repeat scroll 15px 15px #fff;
border:1px solid #e3e3e3; min-height:100px; display;block;
padding:15px 15px 15px 130px;">
<p>
<strong>$name Extension v$version</strong> by <strong><a href="https://www.Mavenbird.com" target="_blank">Mavenbird</a></strong><br/>
Create predefined admin order comments depending on different order status.
</p>
<p>
Check more extensions you might be interested in our <a href="https://www.Mavenbird.com/magento-2-extensions" target="_blank">website</a>.
<br />Like and follow us on 
<a href="https://www.facebook.com/Mavenbird" target="_blank">Facebook</a>,
<a href="https://www.linkedin.com/company/Mavenbird" target="_blank">LinkedIn</a> and
<a href="https://twitter.com/Mavenbird" target="_blank">Twitter</a>.<br />
If you need support or have any questions, please contact us at
<a href="mailto:support@Mavenbird.com">support@Mavenbird.com</a>.
</p>
</div>';
        return $html;
    }
}
