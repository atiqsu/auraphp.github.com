<?php
$packages = [
    'Aura.Autoload' => '1.0.2',
    'Aura.Cli'      => '1.1.1',
    'Aura.Di'       => '1.1.1',
    'Aura.Filter'   => '1.0.0',
    'Aura.Http'     => '1.0.2',
    'Aura.Input'    => '1.1.0',
    'Aura.Intl'     => '1.0.0',
    'Aura.Marshal'  => '1.2.0',
    'Aura.Router'   => '1.1.1',
    'Aura.Session'  => '1.0.1',
    'Aura.Signal'   => '1.0.2',
    'Aura.Sql'      => '1.3.0',
    'Aura.Uri'      => '1.1.1',
    'Aura.View'     => '1.2.1',
    'Aura.Web'      => '1.0.2',
];

$html = [];

$html[] = "Package | "
        . "API Version | "
        . "Description | "
        . "Release Date | "
        . "Downloads | "
        . "Development ";

$html[] = "--- | "
        . "--- | "
        . "--- | "
        . "--- | "
        . "--- | "
        . "--- ";

foreach ($packages as $package => $version) {
    echo "{$package} ...\n";
    $json = json_decode(file_get_contents(
        "https://raw.github.com/auraphp/{$package}/master/composer.json"
    ));
    $name = substr($package, 5);
    $html[] = "[{$name}](/packages/{$package}/{$version}) | "
            . "[{$version}](/packages/{$package}/{$version}/api) | "
            . str_replace("\n", " ", $json->description) . " | "
            . "{$json->time} | "
            . "[.zip](https://github.com/auraphp/{$package}/zipball/{$version}), "
            . "[.tar.gz](https://github.com/auraphp/{$package}/tarball/{$version}) | "
            . "[Github](https://github.com/auraphp/{$package})";
}

$html[] = "";
file_put_contents(dirname(__DIR__) . '/_includes/packages.md', implode("\n", $html));
echo "Done.\n";
