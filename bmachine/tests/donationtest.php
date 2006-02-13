<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class DonationTest extends BMTestCase {

	function DonationTest() {
		$this->BMTestCase();
	}

	function TestCreatePage() {

    error_log("DonationTest/TestCreatePage");
		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		$publish_url = get_base_url() . "donation.php";
		
		$donation = array();
		$title = "donation unit test " . rand(0, 10000);
		print "create donation $title<br>";
		$donation['donation_title'] = $title;
		$donation['donation_text'] = "donation text!";

		$this->Login();		
		$this->post( $publish_url, $donation );

		$this->assertResponse("200", "EncodingTest/TestUTFDonation: didn't get 200 response");		

		global $store;
		$donations = $store->getAllDonations();
		$got_it = $this->Find($donations, "title", encode($donation['donation_title']));

		$this->assertTrue( $got_it, "DonationTest/TestCreatePage: didn't find new donation");
	}

	function TestEdit() {

    error_log("DonationTest/TestEdit");

		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		$publish_url = get_base_url() . "donation.php";

		global $store;	
		$donations = $store->getAllDonations();

		foreach($donations as $id => $d) {

			if ( stristr($d["title"], "unit test") ) {
				$donation = array();
				$donation['donation_title'] = "edited donation unit test " . rand(0, 10000);
				$donation['donation_text'] = "edited donation text!";
				$donation['id'] = $id;
		
				$this->Login();		
				$this->post( $publish_url, $donation );
		
				$this->assertResponse("200", "EncodingTest/TestUTFDonation: didn't get 200 response");		
		
				global $store;
				$donations2 = $store->getAllDonations();
//				$got_it = $this->Find($donations2, "id", $id);
				
				$this->assertTrue( isset($donations2[$id]), "DonationTest/TestEdit: donation edit didn't work");
			}
		}
	}
	
	function TestAddFileToDonation() {

    error_log("DonationTest/TestAddFileToDonation");

		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;	
		$donations = $store->getAllDonations();
		$files = $store->getAllFiles();

		foreach ($files as $filehash => $f) {
			$keys = array_keys($donations);
			$d = $keys[0];
			$store->addFileToDonation($filehash, $d);

			$donations = $store->getAllDonations();
      //      print_r($donations);
			$this->assertTrue( isset($donations[$d]['Files'][$filehash]), "DonationTest/TestAddFileToDonation: donation id wasn't added to donation store" );

			$store->removeFileFromDonation($filehash, $d);

			$donations = $store->getAllDonations();
			$this->assertTrue( !isset($donations[$d]['Files'][$filehash]), 
						"DonationTest/TestAddFileToDonation: donation id wasn't removed from donation store" );

			break;
		}

	}

	function TestDelete() {

    error_log("DonationTest/TestDelete");

		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		$this->Logout();
		$this->Login();

		global $store;	
		$donations = $store->getAllDonations();
		
		foreach($donations as $id => $d) {
			if ( stristr($d["title"], "unit test") ) {

				$this->get(	get_base_url() . "donation.php?id=" . $id . "&action=delete" );

				$donations = $store->getAllDonations();
				$got_it = $this->Find($donations, "title", encode($d['title']));
				
				$this->assertTrue( !$got_it, "didnt delete donation: " . $d["title"] );
			}
		}
	}

}

/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>