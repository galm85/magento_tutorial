<?php

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Macademy\Minerva\Model\FaqFactory;
use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action implements HttpGetActionInterface
{

    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_delete';


    private FaqFactory $faqFactory;
    private FaqResource $faqResource;

    /**
     * @param Context $context
     * @param FaqFactory $faqFactory
     * @param FaqResource $faqResource
     */
    public function __construct(Context $context, FaqFactory $faqFactory, FaqResource $faqResource)
    {
        parent::__construct($context);
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;
    }

    public function execute():Redirect
    {
        try {
            $id = $this->getRequest()->getParam('id');

            /** @var Faq $faq */
            $faq = $this->faqFactory->create();
            $this->faqResource->load($faq, $id);

            if ($faq->getId()) {
                $this->faqResource->delete($faq);
                $this->messageManager->addSuccessMessage(__('The record has been deleted'));
            } else {
                $this->messageManager->addErrorMessage(__('The record does not exist'));
            }
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        /** @var Redirect $redirect */
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//      return $redirect->setPath('minerva/faq');
        return $redirect->setPath('*/*');

    }
}