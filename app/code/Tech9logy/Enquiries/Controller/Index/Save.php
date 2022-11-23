<?php


namespace Tech9logy\Enquiries\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Store\Model\StoreManagerInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $messageManager;
    protected $storeManager;

    public function __construct(
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        StoreManagerInterface $storeManager,
        Context $context
    ) {
        $this->messageManager = $messageManager;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPost();
        if(!$data){
            //echo '<script>window.top.location.href = "https://staging.bargainbuyz.co.uk/enquiries.html";</script>';
            return false;
        }
        $name = $data['namepost'];
        $email = $data['emailpost'];
        $telephone = $data['telephonepost'];
        $units = $data['unitspost'];
        $message = $data['messagepost'];
        //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
       try {

        $this->_inlineTranslation->suspend();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $scopeConfig = $objectManager->create('\Magento\Framework\App\Config\ScopeConfigInterface');
        $sendername = $scopeConfig->getValue('trans_email/ident_support/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         
            $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID);            
            $transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');    
            $templateVars = array(
                        'name'  => $name,
                        'email'  => $email,
                        'telephone' => $telephone,
                        'units' => $units,
                        'message' => $message,
                        'storename' => $this->storeManager->getStore()->getName()
                      );
            $sender = [
                'email' => $email,
                'name' => $name                
            ];


            //Need to change this data
            $to = 'raghvendra.prajapati@tech9logy.in'; 
            $toname = 'sender name';

            $transport = $transport->setTemplateIdentifier('enquiriesmail_email_template');
             
            $transport = $transport->setTemplateOptions($templateOptions);

                       $transport = $transport->setTemplateVars($templateVars);
                      
                       $transport = $transport->setFrom($sender);
                      
                       $transport = $transport->addTo($to, $toname);

                       $transport = $transport->getTransport();
            $transport->sendMessage();   

            $this->_inlineTranslation->resume();
            
            $this->messageManager->addSuccess('Mail send successfully on '.$to.".");
            echo '<script>window.top.location.href = "https://staging.bargainbuyz.co.uk/enquiries.html";</script>';
        } catch(\Exception $e) {
            
            $this->messageManager->addError($e->getMessage());
            echo '<script>window.top.location.href = "https://staging.bargainbuyz.co.uk/enquiries.html";</script>';
        }
        
        

    }
}
