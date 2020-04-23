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

namespace Forfin\LINENotify\Observer\Sales;


class ModelServiceQuoteSubmitSuccess implements \Magento\Framework\Event\ObserverInterface
{

    /** @var \Forfin\LINENotify\Model\LineNotifyLogsFactory */
    private $lineNotifyLogsFactory;

    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $scopeConfig;

    /** @var \Psr\Http\Client\ClientInterface */
    private $httpClient;

    /** @var \Psr\Http\Message\RequestFactoryInterface */
    private $httpRequestFactory;

    /** @var \Psr\Http\Message\StreamFactoryInterface */
    private $streamFactory;

    public function __construct(
        \Forfin\LINENotify\Model\LineNotifyLogsFactory $lineNotifyLogsFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Psr\Http\Client\ClientInterface $httpClient,
        \Psr\Http\Message\RequestFactoryInterface $httpRequestFactory,
        \Psr\Http\Message\StreamFactoryInterface $streamFactory
    ) {
        $this->lineNotifyLogsFactory = $lineNotifyLogsFactory;
        $this->scopeConfig = $scopeConfig;
        $this->httpClient = $httpClient;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        /** @var \Magento\Sales\Api\Data\OrderInterface $order */
        $order = $observer->getData('order');
        $lineToken = $this->scopeConfig->getValue(
            'line_notify_general/line/line_token',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $order->getStoreId()
        );

        $notifyMessage = sprintf('Customer order %s.', $order->getIncrementId());
        $logMessage = $notifyMessage;
        $notifiedSuccess = true;

        try {
            $this->sendLineNotify($notifyMessage, $lineToken);
        } catch (\Psr\Http\Client\ClientExceptionInterface $clientException) {
            $notifiedSuccess = false;
            $logMessage = $clientException->getMessage();
        } finally {
            $this->logLineNotified($order->getEntityId(), $logMessage, $notifiedSuccess);
        }

    }


    /**
     * @param string $message
     * @param string $lineToken
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function sendLineNotify(string $message, string $lineToken)
    {
        $notifyRequest = ($this->httpRequestFactory->createRequest('POST', 'https://notify-api.line.me/api/notify'))
            ->withHeader('Content-type', 'application/x-www-form-urlencoded')
            ->withHeader('Authorization', "Bearer {$lineToken}")
            ->withBody($this->streamFactory->createStream(sprintf('message=%s', \urlencode($message))));

        $this->httpClient->sendRequest($notifyRequest);
    }

    /**
     * @param int $orderId
     * @param string $message
     * @param bool $isSuccess
     */
    private function logLineNotified(int $orderId, string $message, bool $isSuccess)
    {
        $this->lineNotifyLogsFactory->create([
            \Forfin\LINENotify\Model\Data\LineNotifyLogs::ORDER_ID => $orderId,
            \Forfin\LINENotify\Model\Data\LineNotifyLogs::MESSAGE => $message,
            \Forfin\LINENotify\Model\Data\LineNotifyLogs::STATUS => $isSuccess ? 'fail':'success',
                                             ]);
    }


}

