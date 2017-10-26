<?php
	// @author: ttse
	class Zip{

		// Array that holds zipcode keys and neighborhood names

		private static $zip_to_neighborhood = array(
			"94102" => "Tenderloin/Hayes Valley/North of Market",
			"94103" => "South of Market",
			"94107" => "Potrero Hill",
			"94108" => "Chinatown",
			"94109" => "Polk/Russian Hill/Nob Hill",
			"94110" => "Inner Misson/Bernal Heights",
			"94112" => "Ingelside-Excelsior/Crocker-Amazon",
			"94114" => "Castro/Noe Valley",
			"94115" => "Western Addition/Japantown",
			"94116" => "Parkside/Forest Hill",
			"94117" => "Haight-Ashbury",
			"94118" => "Inner Richmond",
			"94121" => "Outer Richmond",
			"94122" => "Sunset",
			"94132" => "Marina",
			"94124" => "Bayview/Hunter\'s Point",
			"94127" => "St. Francis Wood/Miraloma/West Portal",
			"94131" => "Twin Peaks/Glen Park",
			"94132" => "Lake Merced",
			"94133" => "North Beach",
			"94134" => "Visitacion Valley/Sunnydale"
			);

		private static $neighborhood_to_zip = array(
			"tenderloin" => "94102",
			"hayesvalley" => "94012",
                        "northofmarket" => "94012",
			"southofmarket" => "94103",
                        "potrerohill" => "94107",
                        "chinatown" => "94108",
                        "nobhill" => "94109",
                        "russianhill" => "94109",
                        "polk" => "94109",
                        "innermission" => "94110",
                        "bernalheights" => "94110",
                        "ingelside" => "94112",
                        "excelsior" => "94112",
                        "crockeramazon" => "94112",
                        "castro" => "94114",
                        "noevalley" => "94114",
                        "westernaddition" => "94115",
                        "japantown" => "94115",
			"haightashbury" => "94",
                        "innerrichmond" => "94118",
                        "outerrichmond" => "94121",
                        "sunset" => "94122",
                        "marina" => "94123",
                        "bayview" => "94124",
                        "hunterspoint" => "94124",
                        "stfranciswood" => "94127",
                        "miraloma" => "94127",
                        "westportal" => "94127",
                        "twinpeaks" => "94131",
                        "glenpark" => "94131",
                        "lakemerced" => "94132",
                        "northbeach" => "94133",
                        "visitacionvalley" => "94134",
                        "sunnydale" => "94134"
			);
		// function to grab the correct neighborhood name from the array
		// else, return the param.

		public static function getNeighborhoodFromZip(/*string*/ $name = null){
			if($name !== null and array_key_exists($name, self::$zip_to_neighborhood)){
				return self::$zip_to_neighborhood[$name];
			}
			
			return $name;
			
		}
	
		public static function getZipFromNeighborhood(/*string*/ $name = null){
			if($name !== null){
				$name = strtolower(preg_replace("[\W]", "", $name))
				
				if(array_key_exists($name, self::$neighborhood_to_zip)){
					return self::$neighborhood_to_zip[$name];
			}
			return $name;
		}

	}
	
?>
