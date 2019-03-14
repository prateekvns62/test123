<?php
namespace Ninedotmedia\ThemeConfiguration\Block;

use Magento\Framework\View\Element\Template;
use Ninedotmedia\ThemeConfiguration\Helper\Configuration;

class HeaderLink extends Template
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * HeaderLink constructor.
     * @param Template\Context $context
     * @param Configuration $configuration
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Configuration $configuration,
        array $data = []
    ) {
        $this->configuration = $configuration;
        parent::__construct($context, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('Ninedotmedia_ThemeConfiguration::header/link.phtml');
        return $this;
    }

    /**
     * @return string
     */
    public function getBlockContentHtml()
    {
        $type = $this->getData('type');
        $result = '';
        switch ($type) {
            case 'contact':
                $result = $this->getContactHtml();
                break;
            case 'visit':
                $result = $this->getVisitHtml();
                break;
        }
        return $result;
    }

    /**
     * @return string
     */
    private function getVisitHtml()
    {
        $html = '';
        $config = $this->configuration->getVisitOption();
        if ($config['url'] && $config['label']) {
            $html .= '<li class="header-links-visit">';
            $html .= '<li class="header-links-visit"><a href="'.$config['url'].'">'.$config['label'].'</a></li>';
            $html .= '</li>';
        }
        return $html;
    }

    /**
     * @return string
     */
    private function getContactHtml()
    {
        return ($content = $this->configuration->getContactMessage() ) ? $content : '';
    }
}
