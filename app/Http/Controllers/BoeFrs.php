<?php
namespace App\Http\Controllers;
/**
 * interface for boefrs
 */
interface BoeFrs
{
	/* get all symptoms */
	public function getSymptoms();

	/* get all title_name */
	public function getTitleName();

	/* get all patient */
	public function getPatient();

	/* get patient by status */
	public function getPatientByField($data=array('field'=>'value'));
}
?>
