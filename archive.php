<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('sidebar.php'); ?>
     <section id="content" class="blog-box"> 
      <section class="vbox"> 
       <section class="scrollable wrapper"> 
        <div class="row"> 
         <div class="col-sm-9"> 
          <div class="blog-post"> 
          <ol class="breadcrumb clearfix">
            <i class="fa <?php echo $this->category; ?> icon-muted"> </i>
            <?php if ($this->is('index')): ?>
            <?php elseif ($this->is('post')): ?>
            <span class="pull-left"><?php $this->category(); ?></span>
            <span class="active text-ellipsis pull-left"><?php $this->title() ?></span>
            <?php else: ?>
              <span><?php $this->archiveTitle(' &raquo; ','',''); ?></span>
            <?php endif; ?>
          </ol>
           <div class="post-item"> 
           <ul class="clearfix blog-links-box">
           <?php while($this->next()): ?>
            <li class="col-md-6 col-sm-12 col-xs-12 pull-left">
           <?php if(isset($this->fields->url)){ //跳转链接” ?>
            <a href="<?php echo $this->fields->url;?>" rel="external nofollow" target="_blank" class="thumbnail clearfix" title="<?php $this->title() ?>">
            <?php };?>
            <?php if(isset($this->fields->logo)){ //LOGO地址” ?>    
                         <img src="<?php echo $this->fields->logo;?>" alt="<?php $this->title(); ?>" class="blog-link-pic pull-left">
             <?php };?>
                         <div class="link-tit pull-left">
                           <p class="font-bold"><?php $this->title(); ?></p>
               <?php if(isset($this->fields->text)){ //网站描述 ?>
                           <small><?php echo $this->fields->text;?></small>
               <?php };?>
                         </div>
                       </a> 
                      </li>
            <!-- /.post-item -->
           <?php endwhile; ?> 
</ul></div>
          </div> 
          <div class="text-center"> 
           <?php $this->pageNav('«', '»', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination pagination-sm', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?> 
          </div> 
         </div> 
        </div> 
       </section> 
       <?php $this->need('global.php'); ?>
      </section> 
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a> 
     </section> 
<?php $this->need('footer.php'); ?>