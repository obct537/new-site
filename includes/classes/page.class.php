<?php

	class page extends super {
	
	public $content = '';
	public $name = '';
	public $level = '';	

	public $table = DB_TBL_PAGES;

	public $form_options = array( 'content'=> '1', 'name'=>'1', 'active'=>'1');
	public $create_success = "Page created.";
	public $edit_success = "Page edited successfully";

		public function __construct( $page_name = NULL, $level = NULL ) {
		
			$this->profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());	
			$titles = new title();
			$newTitle = $titles->pickTitle();
			
			if( $level == NULL ) {

				require_once( TPL_START );

			}elseif( $level != NULL ) {

				$this->level = $level;
				global $Sess;
				global $Mem;

				if( $Sess->logged_in == 1 ) {
					$member = $Mem->getSingle($Sess->userid);
					$access = $member['level'];

					if( $access <= $this->level && $access > 0) {
						require_once( TPL_START );
					}else{
						deny();
					}
				}else{
					deny();
				}
			}else{
				deny();
			}



			if( !empty($page_name) ) {
				$this->name = $page_name;

				$sql = "SELECT * FROM `" . DB_TBL_PAGES . "` WHERE `name`='" . $page_name . "'";
				if($result = mysql_query($sql)) {
					if($row = mysql_fetch_assoc($result)) {
						$this->content = $row['content'];
						
					}else{
					
						$sql = "INSERT INTO `" . DB_TBL_PAGES . "` SET
							`name`='" . $page_name . "', `active`='0'";
						if($result = query($sql)) {
							successBox("Page Created");
						}else{
							errorBox("Failed to create page");
							echo mysql_error();
						}
					}
				}
			}
			
		}
		
		public function __destruct() {
		
			require_once( TPL_STOP );
			if( DEBUG == "on" ) {
				global $DB;
				$this->profiler->display($DB);
			}
		}
	}
