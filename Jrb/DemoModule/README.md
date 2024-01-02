## Main Functionalities
Custom SQL Query in Magento 2 With Standard Way. magento 2 direct sql query. magento 2 select query limit. magento 2 write sql query. 

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Jrb`
 - Enable the module by running `php bin/magento module:enable Jrb_DemoModule`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer
 - Install the module composer by running `composer require jrb/module-demomodule`
 - enable the module by running `php bin/magento module:enable Jrb_DemoModule`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Specifications

 - Console Command
	- demomodule:run_customscript

