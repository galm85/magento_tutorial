<?php

namespace Macademy\Minerva\Setup\Patch\Data;

use Macademy\Minerva\Model\ResourceModel\Faq;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialFaqs implements DataPatchInterface
{

    /** @var ModuleDataSetupInterface */
    protected $moduleDataSetup;

    /** @var ResourceConnection */
    protected $resource;


    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ResourceConnection $resource
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup, ResourceConnection $resource)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->resource = $resource;
    }


    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }



    public function apply():self
    {
        $connection = $this->resource->getConnection();
        $data = [
            [
                'question'=>'What is your best selling item?',
                'answer'=>'the item you but',
                'is_published'=>1
            ],
            [
                'question'=>'what is your customer support number?',
                'answer'=>'058-99858785',
                'is_published'=>1
            ],
            [
                'question'=>'when will i get my order?',
                'answer'=>'2 weeks',
                'is_published'=>0
            ]
        ];

        $connection->insertMultiple(Faq::MAIN_TABLE,$data);
        return $this;

    }




}