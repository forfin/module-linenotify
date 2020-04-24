# Mage2 Module Forfin LINENotify

    ``forfin/module-linenotify``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities


## Installation
\* = in production please use the `--keep-generated` option

### Type 0: Use from this repository directly

 - Install the module composer by running `composer require forfin/module-linenotify`
 - enable the module by running `php bin/magento module:enable Forfin_LINENotify`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 1: Zip file

 - Unzip the zip file in `app/code/Forfin`
 - Enable the module by running `php bin/magento module:enable Forfin_LINENotify`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
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



