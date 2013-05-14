<?php
class Tblsection extends Eloquent
{
	/*
	 * This class holds different sections that we can have on our website, example being 'Upcoming Events', 'Featured Products' etc.
	* */
	public static $table="sections";
	
	public function products()
	{
		/*
		 * A Section can have multiple products, hence the relation has_many_and_belongs_to()
		 */
		return $this->has_many_and_belongs_to('Product','product_section','section_id','product_id');
	}
		
	public function events()
	{
		/*
		 * A Section can have multiple events, hence the relation has_many_and_belongs_to()
		 */
		return $this->has_many_and_belongs_to('Tblevent','event_section','section_id','event_id');
	} 
}
?>