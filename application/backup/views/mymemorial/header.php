<div id="header-wrapper">
<div id="header" class="clearfix">
    <h1><a href="index.php"><img src="<?php echo base_url();?>/images/memorial.gif" border="0" /></a></h1>
    <div id="langselect">
        <a href="<?php echo base_url().'language/set/english';?>" <?php if($this->session->userdata('language')=='english') { echo 'class="current"'; } ?>>EN</a>
        <a href="<?php echo base_url().'language/set/french';?>" <?php if($this->session->userdata('language')=='french') { echo 'class="current"'; } ?>>FR</a>
    </div>
    <div id="topnav">
        <ul>
            <li><a href="<?php echo base_url();?>"><?php echo lang('home');?></a></li>
            <li><a href="<?php echo base_url();?>support"><?php echo lang('support');?></a></li>
            <li><a href="<?php echo base_url();?>sessions/logout"><?php echo lang('logout');?></a></li>
        </ul>
    </div>
  <div id="main-menu">
    <?php //include_once("menu.php"); ?>
  </div><!-- Main-Menu //-->
  <div id="path">
    Home &raquo;
  </div>
  <span id="clock"></span>
  </div><!-- Header //-->
</div><!-- Header-Wrapper //-->
<div id="wrapper">
  <div id="contents" class="clearfix">
