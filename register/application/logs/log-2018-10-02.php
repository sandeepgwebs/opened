<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-02 22:03:32 --> Unable to load the requested class: Author
ERROR - 2018-10-02 22:04:21 --> Unable to load the requested class: Author
ERROR - 2018-10-02 22:04:34 --> Query error: Table 'icrmr_registration.country' doesn't exist - Invalid query: select *, `name` as country_name from `country` where 1
ERROR - 2018-10-02 22:04:54 --> Query error: Table 'icrmr_registration.tbl_journal_master' doesn't exist - Invalid query: select c.*, jm.`title` as journal_master_title from `tbl_content` c left join `tbl_journal_master` jm on jm.id = c.journal_master_id where 1 and c.`slug` = 'registration_fee' order by c.`sort_order` asc
ERROR - 2018-10-02 22:05:50 --> Query error: Table 'icrmr_registration.tbl_stock_basket' doesn't exist - Invalid query: select b.* from `tbl_stock_basket` b where 1 order by b.`sort_order` asc
ERROR - 2018-10-02 22:05:53 --> Query error: Table 'icrmr_registration.tbl_stock_basket' doesn't exist - Invalid query: select b.* from `tbl_stock_basket` b where 1 order by b.`sort_order` asc
ERROR - 2018-10-02 22:05:53 --> Query error: Table 'icrmr_registration.tbl_stock_basket' doesn't exist - Invalid query: select b.* from `tbl_stock_basket` b where 1 order by b.`sort_order` asc
ERROR - 2018-10-02 22:06:55 --> Severity: error --> Exception: Unable to locate the model you have specified: Model_stock_basket C:\wamp\www\ishmeet\icrmr\register\system\core\Loader.php 344
