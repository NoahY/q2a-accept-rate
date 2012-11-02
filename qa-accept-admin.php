<?php
	class qa_accept_admin {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				case 'accept_plugin_css':
					return '.accept-rate {
	color: #999999 !important;
}';
				default:
					return null;
			}
			
		}

		function admin_form(&$qa_content)
		{

		//	Process form input

			$ok = null;
			if (qa_clicked('accept_save_button')) {
				qa_opt('accept_plugin_css',qa_post_text('accept_plugin_css'));

				qa_opt('accept_plugin_show',(bool)qa_post_text('accept_plugin_show'));
				qa_opt('accept_plugin_shade',(bool)qa_post_text('accept_plugin_shade'));
				$ok = qa_lang('admin/options_saved');
			}
			else if (qa_clicked('accept_reset_button')) {
				foreach($_POST as $i => $v) {
					$def = $this->option_default($i);
					if($def !== null) qa_opt($i,$def);
				}
				$ok = qa_lang('admin/options_reset');
			}			
		
		//	Create the form for display
		
			$fields = array();
			$fields[] = array(
				'label' => 'Show accept rate below user meta',
				'tags' => 'NAME="accept_plugin_show"',
				'value' => qa_opt('accept_plugin_show'),
				'type' => 'checkbox',
			);
			$fields[] = array(
				'label' => 'Color accept rate according to percentage',
				'tags' => 'NAME="accept_plugin_shade"',
				'value' => qa_opt('accept_plugin_shade'),
				'note' => 'goes from red (0%) to green (100%)',
				'type' => 'checkbox',
			);
			$fields[] = array(
				'type' => 'blank',
			);			

			$fields[] = array(
				'label' => 'Custom css',
				'tags' => 'NAME="accept_plugin_css"',
				'value' => qa_opt('accept_plugin_css'),
				'type' => 'textarea',
				'rows' => 20
			);

			return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,
				
				'fields' => $fields,
				
				'buttons' => array(
					array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="accept_save_button"',
					),
					array(
					'label' => qa_lang_html('admin/reset_options_button'),
					'tags' => 'NAME="accept_reset_button"',
					),
				),
			);
		}
	}
