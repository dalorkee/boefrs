<?php
namespace App\Http\Controllers;
/**
 * interface for boefrs
 */
interface BoeFrs
{
	/* get all symptoms */
	public function symptoms();

	/* all title_name */
	public function titleName();

	/* all patient */
	public function patients();

	/* patient by status */
	public function patientByField($field=null, $value=null);

	/* random pin */
	public function randPin($prefix=null, $separator=null);

	/* hospital */
	public function hospitals();

	public function hospitalByProv($prov_id=null);

	public function provinces();

}
?>
