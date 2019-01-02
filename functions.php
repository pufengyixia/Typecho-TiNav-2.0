<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    
    // $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    // array('ShowRecentPosts' => _t('显示最新文章'),
    // 'ShowRecentComments' => _t('显示最近回复'),
    // 'ShowCategory' => _t('显示分类'),
    // 'ShowArchive' => _t('显示归档'),
    // 'ShowOther' => _t('显示其它杂项')),
    // array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    // $form->addInput($sidebarBlock->multiMode());
    /*<?php $this->options->socialqq(); ?> 调用方法*/

    //首页名称
    $IndexName = new Typecho_Widget_Helper_Form_Element_Text('IndexName', NULL, NULL, _t('首页的名称'), _t('输入你的首页显示的名称'));
    $form->addInput($IndexName);
    //首页名称后缀（必填）
    $Indexdict = new Typecho_Widget_Helper_Form_Element_Text('Indexdict', NULL, NULL, _t('首页的名称后缀'), _t('输入你的首页显示的名称后缀'));
    $form->addInput($Indexdict);
    //博主名称
    $BlogName = new Typecho_Widget_Helper_Form_Element_Text('BlogName', NULL, NULL, _t('博主的名称'), _t('输入你的名称建议为英文，中文也可'));
    $form->addInput($BlogName);
    //博主头像
    $BlogPic = new Typecho_Widget_Helper_Form_Element_Text('BlogPic', NULL, NULL, _t('头像图片地址'), _t('logo头像地址，尺寸在80*80左右即可'));
    $form->addInput($BlogPic);
    //主页头像下方描述
    $BlogAdd = new Typecho_Widget_Helper_Form_Element_Text('BlogAdd', NULL, NULL, _t('主页头像下方描述'), _t('输入主页头像下方描述'));
    $form->addInput($BlogAdd);
    //备案号
    $BlogBa = new Typecho_Widget_Helper_Form_Element_Text('BlogBa', NULL, NULL, _t('备案号'), _t('输入网站备案号'));
    $form->addInput($BlogBa);
}


//获取评论的锚点链接
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));
    $parent = @$prow['parent'];
    if ($parent != "0") {//子评论
        $arow = $db->fetchRow($db->select('author,status')->from('table.comments')
            ->where('coid = ?', $parent));//查询该条评论的父评论的作者的名称
        @$author = @$arow['author'];//作者名称
        if(@$author && $arow['status'] == "approved"){//父评论作者存在且父评论已经审核通过
            if (@$prow['status'] == "waiting"){
                echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
            }
            echo '<a href="#comment-' . $parent . '"><div>@' . $author . '</div></a>';
        }else{//父评论作者不存在或者父评论没有审核通过
            if (@$prow['status'] == "waiting"){
                echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
            }else{
                echo '';
            }
        }
    } else {
        //母评论，无需输出锚点链接
        if (@$prow['status'] == "waiting"){
            echo '<em class="awaiting">'."您的评论正等待审核！".'</em>';
        }else{
            echo '';
        }
    }

}


//评论时间
function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);

for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';

return $output;
}

//get_post_view($this)
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    }
    echo $row['views'];
}

//输出导航
function themeFields($layout) {
    $url = new Typecho_Widget_Helper_Form_Element_Text('url', NULL, NULL, _t('跳转链接'), _t('请输入跳转URL'));
    $text = new Typecho_Widget_Helper_Form_Element_Text('text', NULL, NULL, _t('链接描述'), _t('请输入链接描述'));
    $logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, NULL, _t('链接logo'), _t('请输入Logo URL链接'));
    $layout->addItem($url);
    $layout->addItem($text);
    $layout->addItem($logo);
}