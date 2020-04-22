<?php declare(strict_types=1);
/**
 * Copyright (c) 2019  
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Forfin\LINENotify\Model;

use Forfin\LINENotify\Api\Data\LineNotifyLogsInterfaceFactory;
use Forfin\LINENotify\Api\Data\LineNotifyLogsSearchResultsInterfaceFactory;
use Forfin\LINENotify\Api\LineNotifyLogsRepositoryInterface;
use Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs as ResourceLineNotifyLogs;
use Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs\CollectionFactory as LineNotifyLogsCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;


class LineNotifyLogsRepository implements LineNotifyLogsRepositoryInterface
{

    protected $extensionAttributesJoinProcessor;

    protected $searchResultsFactory;

    private $storeManager;

    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    protected $dataLineNotifyLogsFactory;

    protected $extensibleDataObjectConverter;
    protected $lineNotifyLogsFactory;

    protected $resource;

    protected $lineNotifyLogsCollectionFactory;

    private $collectionProcessor;


    /**
     * @param ResourceLineNotifyLogs $resource
     * @param LineNotifyLogsFactory $lineNotifyLogsFactory
     * @param LineNotifyLogsInterfaceFactory $dataLineNotifyLogsFactory
     * @param LineNotifyLogsCollectionFactory $lineNotifyLogsCollectionFactory
     * @param LineNotifyLogsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceLineNotifyLogs $resource,
        LineNotifyLogsFactory $lineNotifyLogsFactory,
        LineNotifyLogsInterfaceFactory $dataLineNotifyLogsFactory,
        LineNotifyLogsCollectionFactory $lineNotifyLogsCollectionFactory,
        LineNotifyLogsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->lineNotifyLogsFactory = $lineNotifyLogsFactory;
        $this->lineNotifyLogsCollectionFactory = $lineNotifyLogsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLineNotifyLogsFactory = $dataLineNotifyLogsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
    ) {
        /* if (empty($lineNotifyLogs->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $lineNotifyLogs->setStoreId($storeId);
        } */
        
        $lineNotifyLogsData = $this->extensibleDataObjectConverter->toNestedArray(
            $lineNotifyLogs,
            [],
            \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface::class
        );
        
        $lineNotifyLogsModel = $this->lineNotifyLogsFactory->create()->setData($lineNotifyLogsData);
        
        try {
            $this->resource->save($lineNotifyLogsModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the lineNotifyLogs: %1',
                $exception->getMessage()
            ));
        }
        return $lineNotifyLogsModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($lineNotifyLogsId)
    {
        $lineNotifyLogs = $this->lineNotifyLogsFactory->create();
        $this->resource->load($lineNotifyLogs, $lineNotifyLogsId);
        if (!$lineNotifyLogs->getId()) {
            throw new NoSuchEntityException(__('LineNotifyLogs with id "%1" does not exist.', $lineNotifyLogsId));
        }
        return $lineNotifyLogs->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->lineNotifyLogsCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
    ) {
        try {
            $lineNotifyLogsModel = $this->lineNotifyLogsFactory->create();
            $this->resource->load($lineNotifyLogsModel, $lineNotifyLogs->getLinenotifylogsId());
            $this->resource->delete($lineNotifyLogsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the LineNotifyLogs: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($lineNotifyLogsId)
    {
        return $this->delete($this->get($lineNotifyLogsId));
    }
}

