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

namespace Forfin\LINENotify\Api;

use Magento\Framework\Api\SearchCriteriaInterface;


interface LineNotifyLogsRepositoryInterface
{

    /**
     * Save LineNotifyLogs
     * @param \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
    );

    /**
     * Retrieve LineNotifyLogs
     * @param string $linenotifylogsId
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($linenotifylogsId);

    /**
     * Retrieve LineNotifyLogs matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete LineNotifyLogs
     * @param \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface $lineNotifyLogs
    );

    /**
     * Delete LineNotifyLogs by ID
     * @param string $linenotifylogsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($linenotifylogsId);
}

