# Mage2 Module Forfin LINENotify

    ``forfin/module-linenotify``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities


## Installation
 - Install the module composer by running `composer require forfin/module-linenotify`
 - enable the module by running `php bin/magento module:enable Forfin_LINENotify`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration

 - Line Notify Token (line_notify_general/line/line_token)


## Specifications

 - Observer
	- sales_model_service_quote_submit_success > Forfin\LINENotify\Observer\Sales\ModelServiceQuoteSubmitSuccess

 - Model
	- LineNotifyLogs


## Attributes



