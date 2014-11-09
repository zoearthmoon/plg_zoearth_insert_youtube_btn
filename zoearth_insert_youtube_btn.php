<?php
defined('_JEXEC') or die;

class plgButtonZoearth_Insert_Youtube_Btn extends JPlugin
{
    public function onDisplay($name)
    {
		static $showed;
		if (!$showed):
		$lang = JFactory::getLanguage();
		$lang->load('plg_zoearth_insert_youtube_btn',JPATH_ADMINISTRATOR);
		?>
		<script language="Javascript">
		var showYutubeInput = function (editorName){
			jQuery.data(document.body,"editorName",editorName);
			jQuery('#showyoutubeInsertModal').modal('show');			
		};
		jQuery(document).ready(function() {
			jQuery('#showyoutubeInsertModal').on('show',function (){
				//出現modal時清空textarea
				jQuery("#youtubelink").val("");
			});
			//儲存
			jQuery("#zoearthInsertInput").click(function(){
				var editorName    = jQuery.data(document.body,"editorName");
				var youtubelink   = jQuery("#youtubelink").val().trim();
				var youtubewidth  = parseInt(jQuery("#youtubewidth").val());
				var youtubeheight = parseInt(jQuery("#youtubeheight").val());
				var regExp = /v=([0-9a-zA-Z-_]*)/;
				var getV = youtubelink.match(regExp);
				if (getV && getV[1])
				{
					var html = '<iframe width="'+(youtubewidth > 0 ? youtubewidth:560)+'" height="'+(youtubeheight > 0 ? youtubeheight:315)+'" src="//www.youtube.com/embed/'+getV[1]+'" frameborder="0" allowfullscreen></iframe>';
					jInsertEditorText(html, editorName);
					jQuery('#showyoutubeInsertModal').modal('hide');
				}
				else
				{
					alert('<?php echo JText::_('PLG_ZOEARTH_CANT_FIND_YOUTUBE_ID')?>');
				}
			});
		});
		</script>
		<div id="showyoutubeInsertModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel"><?php echo JText::_('PLG_ZOEARTH_INSERT_YOUTUBE_BTN')?></h3>
			</div>
			<div class="modal-body">
				<label><?php echo JText::_('PLG_ZOEARTH_YOUTUBE_LINK')?></label>
					<input id="youtubelink" class="span12" />
				<label><?php echo JText::_('PLG_ZOEARTH_YOUTUBE_WIDTH')?></label>
					<input id="youtubewidth" class="span12" value="560" />
				<label><?php echo JText::_('PLG_ZOEARTH_YOUTUBE_HEIGHT')?></label>
					<input id="youtubeheight" class="span12" value="315" />
			</div>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JOFF') ?></a>
				<a class="btn btn-primary" id="zoearthInsertInput" ><?php echo JText::_('JSUBMIT') ?></a>
			</div>
		</div>
		<?php
		$showed = TRUE;
		endif;
		
        $button = new JObject();				
		$button->modal = FALSE;
		$button->class = 'btn';
		$button->title = JText::_('PLG_ZOEARTH_INSERT_YOUTUBE_BTN');
        $button->text = JText::_('PLG_ZOEARTH_INSERT_YOUTUBE_BTN');
        $button->name = 'comment';
        $button->onclick = 'showYutubeInput(\''.$name.'\');return false;';
        $button->link = '#';
        return $button;
    }
}
?>