<?php
$single = getSingle($id, $this->table_name);
if( !empty( $single ) ) {
	print_array($single);
	return $single;
}else{
	return FALSE;
}
