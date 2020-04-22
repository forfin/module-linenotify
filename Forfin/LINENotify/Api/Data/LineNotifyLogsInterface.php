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

namespace Forfin\LINENotify\Api\Data;


interface LineNotifyLogsInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CREATED_AT = 'created_at';
    const MESSAGE = 'message';
    const LINENOTIFYLOGS_ID = 'linenotifylogs_id';
    const STATUS = 'status';
    const ORDER_ID = 'order_id';

    /**
     * Get linenotifylogs_id
     * @return string|null
     */
    public function getLinenotifylogsId();

    /**
     * Set linenotifylogs_id
     * @param string $linenotifylogsId
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     */
    public function setLinenotifylogsId($linenotifylogsId);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $createdAt
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     */
    public function setMessage($createdAt);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Forfin\LINENotify\Api\Data\LineNotifyLogsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Forfin\LINENotify\Api\Data\LineNotifyLogsExtensionInterface $extensionAttributes
    );

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     */
    public function setStatus($status);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Forfin\LINENotify\Api\Data\LineNotifyLogsInterface
     */
    public function setOrderId($orderId);
}

