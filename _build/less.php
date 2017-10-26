<?php
	use Assetic\Asset\FileAsset;
	use Assetic\Asset\GlobAsset;

	use Assetic\FilterManager;
	use Assetic\Filter\LessphpFilter;

	use Assetic\AssetManager;

	use Assetic\Factory\AssetFactory;

	use Assetic\AssetWriter;

	echo "Collecting LESS files...\r\n";	
	$less_asset_manager = new AssetManager();

	echo "application/less/*\r\n";
	$application_less = new GlobAsset( $PROJECT_DIR . 'application/less/*' );
	$less_asset_manager->set('application_less', $application_less);

	echo "Fetching filters...\r\n";
	$less_filter_manager = new FilterManager();

	echo "vendor/build/lessc.inc.php\r\n";
	require_once $PROJECT_DIR . 'vendor/build/lessc.inc.php';
	$lessify = new LessphpFilter( $PROJECT_DIR . 'vendor/build/lessc.inc.php');
	$less_filter_manager->set('lessify', $lessify);

	echo "Compiling LESS files...\r\n";
	$less_factory = new AssetFactory($PROJECT_DIR);

	$less_factory->setAssetManager($less_asset_manager);
	$less_factory->setFilterManager($less_filter_manager);

	$less_factory->setDebug($DEBUG_MODE);

	$css = $less_factory->createAsset(array(
		'@application_less'
	), array(
		'lessify'
	));

	echo "Writing to public/css/main.css\r\n";
	$css->setTargetPath('main.css');

	$less_writer = new AssetWriter($PROJECT_DIR . '/public/css');
	$less_writer->writeAsset($css);

	echo "LESS build complete.\r\n"


?>