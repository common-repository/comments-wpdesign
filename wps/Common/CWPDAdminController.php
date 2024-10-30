<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Common;

use CWPD\Api\CWPDSettingsApi;
use CWPD\Api\Callbacks\CWPDAdminCallbacks;


class CWPDAdminController
{

  public $settings;

  public $callbacks;

  public $pages = array();


  public function cwpd_register()
  {
      if ( version_compare( PHP_VERSION, '5.6.0', '>=' ) ) {
        /*if ( ! $this->cwpd_last_code() ) return;
        if ( ! $this->cwpd_wp_version_check() ) return;*/
        $this->settings = new CWPDSettingsApi();

        $this->callbacks = new CWPDAdminCallbacks();

        $this->setPages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Settings' )->cwpd_register();
      }else{
          add_action( 'admin_notices',  'cwpd_php_version_error_warning');
      }
  }

  public function setPages()
  {
    $this->pages = array(
      array(
        'page_title' => 'Settings', 
		'menu_title' => 'wpDesign', 
		'capability' => 'manage_options', 
		'menu_slug' => 'cwpd', 
		'callback' => array( $this->callbacks, 'cwpd_setting_view' ), 
		'icon_url' => 'dashicons-admin-comments', 
		'position' => 80
      ),
      
    );
  }

  public function setSettings()
  {
    $args = array(
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_read_more_enable',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_enable_load_byclick',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_read_text',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_loading',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_comment_avater_size',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_comment_budget_icon',
      ),
      array(
        'option_group' => 'cwpd_setting_form_settings',
        'option_name' => 'cwpd_comment_perpage',
      ),
      
    );

    $this->settings->setSettings($args);
  }

  public function setSections()
  {
    $args = array(
      array(
        'id' => 'cwpd_settings_index',
        'title' => '',
        'page' => 'cwpd_setting_page'
      ),
    );

    $this->settings->setSections($args);
  }

  public function setFields()
  {
    $args = array(
      array(
        'id' => 'cwpd_read_more_enable',
        'title' => 'Enable Load More',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_read_more_enable',
          'placeholder' => '',
           'default'  =>   1,
           'input_type' => 'checkbox',
        )
      ),
      array(
        'id' => 'cwpd_enable_load_by_scroll',
        'title' => 'Scrolling to load',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_enable_load_by_scroll',
          'placeholder' => '',
           'default'  =>   '',
           'input_type' => 'checkbox',
        )
      ),
      array(
        'id' => 'cwpd_comment_budget_icon',
        'title' => 'Budget Icon',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_comment_budget_icon',
          'placeholder' => '',
           'default'  =>   1,
           'input_type' => 'checkbox',
        )
      ),
      array(
        'id' => 'cwpd_read_text',
        'title' => 'Button Text',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_read_text',
          'placeholder' => 'Enter Load More Button Text',
           'default'  =>   'Load More',
           'input_type' => 'text',
        )
      ),
      array(
        'id' => 'cwpd_loading',
        'title' => 'Loading Text',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_loading',
          'placeholder' => 'Enter Loading Text',
           'default'  =>   'Loading...',
           'input_type' => 'text',
        )
      ),
      array(
        'id' => 'cwpd_comment_perpage',
        'title' => 'Per Click',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_comment_perpage',
          'placeholder' => 'Enter Avater Size',
           'default'  =>   5,
           'input_type' => 'number',
        )
      ),
      array(
        'id' => 'cwpd_comment_avater_size',
        'title' => 'Avater Size',
        'callback' => array($this->callbacks, 'cwpd_optionField'),
        'page' => 'cwpd_setting_page',
        'section' => 'cwpd_settings_index',
        'args' => array(
          'option_name' => 'cwpd_settings',
          'label_for' => 'cwpd_comment_avater_size',
          'placeholder' => 'Enter Avater Size',
           'default'  =>   '60',
           'input_type' => 'number',
        )
      ),

    );

    $this->settings->setFields($args);
  }
}