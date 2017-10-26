<?php
	use Assetic\Asset\FileAsset;
	use Assetic\Asset\GlobAsset;

	use Assetic\FilterManager;
	use Assetic\Filter\JSMinFilter;

	use Assetic\AssetManager;

	use Assetic\Factory\AssetFactory;

	use Assetic\AssetWriter;

	echo "Collecting JavaScript files...\r\n";	
	$vendor_js_asset_manager = new AssetManager();
	$core_js_asset_manager = new AssetManager();
	$app_js_asset_manager = new AssetManager();

	echo "Fetching filters...\r\n";
	$js_filter_manager = new FilterManager();

	echo "vendor/JSMinPlusFilter.php\r\n";
	require_once $PROJECT_DIR . 'vendor/build/JSMin.php';
	$js_minify = new JSMinFilter( $PROJECT_DIR . 'vendor/build/JSMin.php');
	$js_filter_manager->set('js_minify', $js_minify);

	

	// Vendor code compilation

	echo "vendor/js/*\r\n";
	$jquery_vendor_js = new FileAsset( $PROJECT_DIR . 'vendor/js/jquery.min.js' );
	$dust_vendor_js = new FileAsset( $PROJECT_DIR . 'vendor/js/dust-full.js' );
	$bootstrap_vendor_js = new FileAsset( $PROJECT_DIR . 'vendor/js/bootstrap.min.js' );


	$vendor_js_asset_manager->set('jquery_vendor_js', $jquery_vendor_js);
	$vendor_js_asset_manager->set('dust_vendor_js', $dust_vendor_js);
	$vendor_js_asset_manager->set('bootstrap_vendor_js', $bootstrap_vendor_js);


	echo "Compiling Vendor JavaScript files...\r\n";
	$vendor_js_factory = new AssetFactory($PROJECT_DIR);

	$vendor_js_factory->setAssetManager($vendor_js_asset_manager);
	$vendor_js_factory->setFilterManager($js_filter_manager);

	$vendor_js_factory->setDebug($DEBUG_MODE);

	$vendor_asset = $vendor_js_factory->createAsset(array(
		'@jquery_vendor_js',
		'@dust_vendor_js',
		'@bootstrap_vendor_js',
	), array(
		'?js_minify'
	));

	echo "Writing to public/js/vendor.js\r\n";
	$vendor_asset->setTargetPath('vendor.js');

	// Core Code Compilation

	echo "application/js/core/*\r\n";
	$core_js = new GlobAsset( $PROJECT_DIR . 'application/js/core/*' );
	$core_js_asset_manager->set('core_js', $core_js);

	echo "Fetching filters...\r\n";
	$js_filter_manager = new FilterManager();

	echo "vendor/JSMinPlusFilter.php\r\n";
	require_once $PROJECT_DIR . 'vendor/build/JSMin.php';
	$js_minify = new JSMinFilter( $PROJECT_DIR . 'vendor/build/JSMin.php');
	$js_filter_manager->set('js_minify', $js_minify);



	echo "Compiling Core JavaScript files...\r\n";
	$core_js_factory = new AssetFactory($PROJECT_DIR);

	$core_js_factory->setAssetManager($core_js_asset_manager);
	$core_js_factory->setFilterManager($js_filter_manager);

	$core_js_factory->setDebug($DEBUG_MODE);

	$core_asset = $core_js_factory->createAsset(array(
		'@core_js'
	), array(
		'?js_minify'
	));

	echo "Writing to public/js/core.js\r\n";
	$core_asset->setTargetPath('core.js');


	// Application Code Compilation

	echo "application/js/*\r\n";
	$application_js = new GlobAsset( $PROJECT_DIR . 'application/js/*' );
	$app_js_asset_manager->set('application_js', $application_js);


	echo "Compiling JavaScript files...\r\n";
	$js_factory = new AssetFactory($PROJECT_DIR);

	$js_factory->setAssetManager($app_js_asset_manager);
	$js_factory->setFilterManager($js_filter_manager);

	$js_factory->setDebug($DEBUG_MODE);

	$application_asset = $js_factory->createAsset(array(
		'@application_js'
	), array(
		'?js_minify'
	));

	echo "Writing to public/js/app.js\r\n";
	$application_asset->setTargetPath('app.js');

	$js_writer = new AssetWriter($PROJECT_DIR . '/public/js');
	$js_writer->writeAsset($vendor_asset);
	$js_writer->writeAsset($core_asset);
	$js_writer->writeAsset($application_asset);

	echo "JavaScript build complete.\r\n"
?>