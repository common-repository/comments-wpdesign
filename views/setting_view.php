<div id="wrapper" class="mobile">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body _buttonss">
              <h4 class="heading pull-left display-block">Change Settings</h4>
            </div>
          <div class="panel-body">
          <div class="tab-content">
            <div class="row">
              <div class="col-md-12">
               <ul class="nav nav-tabs tabs-nav" role="tablist">
                  <li role="presentation" class="active"> 
                    <a href="#admin_settings" aria-controls="admin_settings" role="tab" data-toggle="tab">
                      Settings
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="admin_settings">
                    <div class="col-md-4">
                      <?php do_action('cwpd_admin_email_setting'); ?>
                    </div>
                </div>
              </div>                         
              </div>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>

