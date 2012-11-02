<?php
	class qa_html_theme_layer extends qa_html_theme_base
	{
		function head_custom()
		{
			qa_html_theme_base::head_custom();
			
			$this->output('
<style>
'.qa_opt('accept_plugin_css').'				
</style>');
		}
		function post_meta_who($post, $class)
		{

			if($class == 'qa-q-view' && qa_opt('accept_plugin_show')) {

				$handle = strip_tags($post['who']['data']);
				$uids = qa_handles_to_userids(array($handle));
				$uid = $uids[$handle];
				if(!$uid)
					return qa_html_theme_base::post_meta_who($post, $class);

				$post_query = qa_db_query_sub(
					'SELECT postid, selchildid FROM ^posts '.
					'WHERE userid=# AND type=$',
					$uid, 'Q'
				);
				
				$total = 0;
				$accepted = 0;
				while ( ($apost=qa_db_read_one_assoc($post_query,true)) !== null ) {
					$total++;
					if(@$apost['selchildid'])
						$accepted++;
				}
				
				$rate = round($accepted/$total*100);
				
				if(qa_opt('accept_plugin_shade')) {
					if ($rate <= 50) {
						$col = round($rate/50*255);
						$col = dechex($col);
						if (strlen($col) == 1) $col = '0'.$col;
						$col = '#'. 'FF' . $col . '00';
					}
					else {
						$col = round(($rate - 50)/50*255)*(-1)+255;
						$col = dechex($col);
						if (strlen($col) == 1) $col = '0'.$col;
						$col = '#' . $col .'FF' . '00';
					}				
				}
				$text = '<span class="accept-rate"'.(@$col?' style="color:'.$col.'"':'').' title="'.qa_lang_sub('accept/accept_rate_hint',$handle).'">'.qa_lang_sub('accept/accept_rate',$rate).'</span>';
				
				$post['who']['suffix'] = @$post['who']['suffix'].'<br/>'.$text;
				
			}

			qa_html_theme_base::post_meta_who($post, $class);
		}
				
	}