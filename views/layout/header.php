    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="<?= url('index')?>">Dashboard</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Tables</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="<?= url('normaltable')?>">Normal Table</a></li>
                                        <li><a href="<?= url('datatable')?>">Data Table</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="header-top-area main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li><a href="<?= url('dashboard')?>"><i class="notika-icon notika-house"></i> Dashboard</a>
                        </li>
                        <li><a data-toggle="tab" href="#tables"><i class="notika-icon notika-windows"></i> Tables</a>
                        </li>
                        <li><a data-toggle="tab" href="#forms"><i class="notika-icon notika-form"></i> Forms</a>
                        </li>
                        <li><a data-toggle="tab" href="#appviews"><i class="notika-icon notika-app"></i> App views</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= url('normaltable') ?>">Normal table</a>
                                </li>
                                <li><a href="<?= url('datatable') ?>">Data table</a>
                                </li>
                            </ul>
                        </div>
                        <div id="forms" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= url('form1') ?>">Form 1</a>
                                </li>
                                <li><a href="<?= url('form2') ?>">Form 2</a>
                                </li>
                                <li><a href="<?= url('form3') ?>">Form 3</a>
                                </li>
                            </ul>
                        </div>
                        <div id="appviews" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= url('notifications') ?>">Notifications</a>
                                </li>
                                <li><a href="<?= url('alerts') ?>">Alerts</a>
                                </li>
                                <li><a href="<?= url('modals') ?>">Modals</a>
                                </li>
                                <li><a href="<?= url('buttons') ?>">Buttons</a>
                                </li>
                                <li><a href="<?= url('tabs') ?>">Tabs</a>
                                </li>
                                <li><a href="<?= url('accordian') ?>">Accordian</a>
                                </li>
                                <li><a href="<?= url('dialogs') ?>">Dialogs</a>
                                </li>
                                <li><a href="<?= url('dropdowns') ?>">Dropdowns</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->