<?php 
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
use CWPD\Library\CWPDGetFunction;

/**
 * Enable Load Comment Button
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_enable_comment_load(){
    return CWPDGetFunction::cwpd_last_code_load_enable();
}
/**
 * Enable Budget Icon
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_enable_comment_budget(){
    return CWPDGetFunction::cwpd_last_code_budget_icon();
}
/**
 * Load Comment Button Text
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_comment_load_text(){
     return CWPDGetFunction::cwpd_last_code_load_text();
}
/**
 * Loading Comment Button Text
 * @return string
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_comment_loading_text(){
     return CWPDGetFunction::cwpd_last_code_loading_text();
}
/**
 * Avater Size
 * @return number
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_avater_size(){
     return CWPDGetFunction::cwpd_last_code_avater_size();
}
/**
 * Perpage
 * @return number
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_comment_perpage(){
     return CWPDGetFunction::cwpd_last_code_per_page();
}
/**
 * Scroll to loading
 * @return number
 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
 * Date       : 19.04.2020
*/
function cwpd_comment_scroll(){
     return CWPDGetFunction::cwpd_last_code_scroll();
}
?>