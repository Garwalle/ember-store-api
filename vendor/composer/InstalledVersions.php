<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => '1.0.0+no-version-set',
    'version' => '1.0.0.0',
    'aliases' => 
    array (
    ),
    'reference' => NULL,
    'name' => 'phpmv/ubiquity-project',
  ),
  'versions' => 
  array (
    'frameworks/jquery' => 
    array (
      'pretty_version' => '2.1.4',
      'version' => '2.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ef9c4fe9fcb23914bba6ec6d32c556e4a38a0fd9',
    ),
    'phpmv/php-mv-ui' => 
    array (
      'pretty_version' => '2.3.21',
      'version' => '2.3.21.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd4bd11beeab50e45a591e613911ea317ae841db4',
    ),
    'phpmv/ubiquity' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
        0 => '2.4.x-dev',
      ),
      'reference' => 'd6004be887d9fdb6603cc9ce6cc3c09579136de9',
    ),
    'phpmv/ubiquity-attributes' => 
    array (
      'pretty_version' => '0.0.7',
      'version' => '0.0.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a7f0c6d3899eb6715a879c2c9a28b67d89158869',
    ),
    'phpmv/ubiquity-codeception' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '74e44a9a46ab63d6c0dd27b520d7bb952984e108',
    ),
    'phpmv/ubiquity-commands' => 
    array (
      'pretty_version' => '0.0.22',
      'version' => '0.0.22.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ff6a042f6301ab2c16f9b0469bd75cbf6db102e7',
    ),
    'phpmv/ubiquity-dev' => 
    array (
      'pretty_version' => '0.1.13',
      'version' => '0.1.13.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a7644b86939616da3550eeb419b5a55cfc4c2338',
    ),
    'phpmv/ubiquity-devtools' => 
    array (
      'pretty_version' => '1.2.26',
      'version' => '1.2.26.0',
      'aliases' => 
      array (
      ),
      'reference' => '80c2c2c3fbc647b2f5897a87479701cb438b69a2',
    ),
    'phpmv/ubiquity-project' => 
    array (
      'pretty_version' => '1.0.0+no-version-set',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => NULL,
    ),
    'phpmv/ubiquity-webtools' => 
    array (
      'pretty_version' => '2.4.7',
      'version' => '2.4.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '0b56462d0b3cc369c6540e18f00233c610972cdc',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5232de97ee3b75b0360528dae24e73db49566ab1',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dc3063ba22c2a1fd2f45ed856374d79114998f91',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v5.2.4',
      'version' => '5.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '313a38f09c77fbcdc1d223e57d368cea76a2fd2f',
    ),
    'twig/twig' => 
    array (
      'pretty_version' => 'v3.3.0',
      'version' => '3.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1f3b7e2c06cc05d42936a8ad508ff1db7975cdc5',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
