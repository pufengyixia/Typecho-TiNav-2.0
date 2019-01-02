<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </section> <!-- / .hbox -->
   </section> 
  </section> <!-- / .vbox -->
  <script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('js/bootstrap.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('js/jquery.slimscroll.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('js/app.plugin.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('js/app.js'); ?>"></script>
<script>
    $('.dropdown-stop').click(function(e) {
        e.stopPropagation();
    });
  </script>
 </body>
</html>