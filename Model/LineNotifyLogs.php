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

use Forfin\LINENotify\Api\Data\LineNotifyLogsInterface;
use Forfin\LINENotify\Api\Data\LineNotifyLogsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;


class LineNotifyLogs extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'forfin_linenotify_linenotifylogs';
    protected $linenotifylogsDataFactory;

    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param LineNotifyLogsInterfaceFactory $linenotifylogsDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs $resource
     * @param \Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        LineNotifyLogsInterfaceFactory $linenotifylogsDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs $resource,
        \Forfin\LINENotify\Model\ResourceModel\LineNotifyLogs\Collection $resourceCollection,
        array $data = []
    ) {
        $this->linenotifylogsDataFactory = $linenotifylogsDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve linenotifylogs model with linenotifylogs data
     * @return LineNotifyLogsInterface
     */
    public function getDataModel()
    {
        $linenotifylogsData = $this->getData();
        
        $linenotifylogsDataObject = $this->linenotifylogsDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $linenotifylogsDataObject,
            $linenotifylogsData,
            LineNotifyLogsInterface::class
        );
        
        return $linenotifylogsDataObject;
    }
}

