# Silverstripe Lesscompiler Module

A module that compiles defined less files on execution and exportes them
to a defined CSS file.

Currently this is a proof of concept and has lots of possible options
for expansion.

This module uses the ["less.php"](https://github.com/oyejorge/less.php)
module to compile less files. If not installing via composer you will
need this installed to your path.

## Installation via Composer

    composer require i-lateral/silverstripe-lesscompiler 0.*

## Operation

This module checks for updates to defined less files before controller
initilisaton. If there are changes then new CSS is compiled and saved
to the defined output path.

This process is only run on dev (as to not detrimentally effect
performance on live sites) and all cache files are stored in the default
Silverstripe temp directory.

## Basic usage

Start off by setting the file_mappings config variable on
LessCompilerConfig. This should be a list of less files to convert with
their equivilent export file, eg:

config.yml

    LessCompilerConfig:
      file_mappings:
        "styles.less": "styles.css"
        "typography.less": "typography.css"
      
_config.php

    LessCompilerConfig::config()->file_mappings = array(
        "styles.less" => "styles.css",
        "typography.less" => "typography.css"
    );

If you do not include a path to the less/css files then the module assumes
that you are using the default theme directory and using folders named
"less" and "css" respectively.

## Custom file paths

You can define custom less and css file paths but using the following:

config.yml
    LessCompilerConfig:
      file_mappings:
        "themes/themename/less/styles.less": "themes/themename/css/styles.css"
        "themes/themename/less/typography.less": "themes/themename/css/typography.css"
      
_config.php

    LessCompilerConfig::config()->file_mappings = array(
        "themes/themename/less/styles.less" => "themes/themename/css/styles.css",
        "themes/themename/less/typography.less" => "themes/themename/css/typography.css"
    );

## Compressing output

By default all output is compressed, this can be disabled using the
"compress" config variable, EG:

config.yml

    LessCompilerConfig:
      compress: false
      
_config.php

    LessCompilerConfig::config()->compress = false;
    
## Relative image URLS

The compiler attempts converts all relative image URLs to be prefixed
prefixed with ../ (this assumes that the output css will be in a seperate
folder to the images, but with a common root). This can be altered using
the "root_path" config variable

config.yml

    LessCompilerConfig:
      root_path: "../../imports"
      
_config.php

    LessCompilerConfig::config()->root_path = "../../imports";
