<?php
class Tblevent extends Eloquent
{
	/*
	 * Class containing all the events
	 */
public static $table="events";

public function user()
{
	/*
	 * Event is created by a user, so it belongs to some user
	 * TODO : How to define the foriegn key explicitly in this case?
	 */
	return $this->belongs_to('User','user_id');
}

public function products()
{
	/*
	 * An event can have multiple products associated with it
	 * If the table names do not follow naming convention, then we have to define them explicitly(Like we did in this case)
	 * First parameter is the Model name with which the relationship is present.
	 * Second parameter is the name of the Pivot Table
	 * Third parameter is the foreign key name of the Current Model
	 * Fourth parameter is the foreign key name of the Other Model
	 */
	return $this->has_many_and_belongs_to('Product','event_product','event_id','product_id');
}

}
?>