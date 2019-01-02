<?php
/**
 * 这是SEOGO改自<a href="http://www.molerose.com" target="_blank">molerose</a>的一款分类导航主题，感谢原作者。演示站点：https://web.geekji.cn
 * 
 * @package TiNav
 * @author SEOGO
 * @version 2.0
 * @link https://www.seogo.me/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
 <?php $this->need('sidebar.php'); ?>
     <section class="blog-box"> 
      <section class="vbox"> 
       <section class="scrollable wrapper"> 
        <div class="row"> 
         <div class="col-sm-9"> 
          <div class="blog-post"> 
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
  			  <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
      		    <?php while ($categories->next()): ?>
                  <?php if(count($categories->children) === 0): ?>
                  <?php $this->widget('Widget_Archive@category-' . $categories->mid, 'pageSize=10000&type=category', 'mid=' . $categories->mid)->to($posts); ?> 
            <ol class="breadcrumb clearfix"><i class="fa <?php $categories->slug(); ?> icon-muted"> </i> <span id="<?php $categories->name(); ?>"><?php $categories->name(); ?></span></ol>
            <div class="post-item"> 
              <ul class="clearfix blog-links-box">
                  <?php while ($posts->next()): ?> 
                    <li class="col-md-6 col-sm-12 col-xs-12 pull-left">
                      <?php if(isset($posts->fields->url)){ //跳转链接” ?>  
                       <a href="<?php echo $posts->fields->url;?>" rel="external nofollow" target="_blank" class="thumbnail clearfix" title="<?php $posts->title() ?>">
                      <?php };?>
            <?php if(isset($posts->fields->logo)){ //头像地址” ?>   
                         <img src="<?php echo $posts->fields->logo;?>" alt="<?php $posts->title(); ?>" class="blog-link-pic pull-left">
             <?php };?>
                         <div class="link-tit pull-left">
                           <p class="font-bold"><?php $posts->title(); ?></p>
               <?php if(isset($posts->fields->text)){ //网站描述 ?>
                           <small><?php echo $posts->fields->text;?></small>
               <?php };?>
                         </div>
                       </a>
                    </li>
                  <?php endwhile; ?>   
              </ul>
            </div>                      
        <?php else: ?>
      <?php endif; ?>
  <?php endwhile; ?>

             <?php if (class_exists("Links_Plugin")): ?>
                <div <?php
                if ($this->options->sidebarFlinks == 'hide') {
                    echo 'hidden';
                } ?>>
             <ol class="breadcrumb clearfix"><i class="fa fa-link icon-muted"> </i> <span id="links">友情链接</span></ol>
            <div class="post-item"> 
              <ul class="clearfix blog-links-box"> 
                    <?php Links_Plugin::output("<li class=\"col-md-6 col-sm-12 col-xs-12 pull-left\"><a href=\"{url}\" title=\"{name}\"  target=\"_blank\" class=\"thumbnail clearfix\"><img src=\"{image}\" alt=\"{name}\"  class=\"blog-link-pic pull-left\"><div class=\"link-tit pull-left\"><p>{name}</p><small>{title}</small></div></a></li>");?>
              </ul>
                </div>
            <?php endif; ?>

            </div>
          </div> 
         </div>
        </div> 
       </section> 
       <?php $this->need('global.php'); ?>
      </section> 
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a> 
     </section> 
<?php $this->need('footer.php'); ?>
   