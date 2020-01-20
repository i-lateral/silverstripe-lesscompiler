<?php

/**
 * Simple config class to hold global settings
 * 
 */
class LessCompilerConfig extends SS_Object
{

    /**
     * File mappings that are to be compiled. This is a multidimestional
     * array listing the input file as the key and the output file as
     * the value, EG:
     * 
     *      LessCompilerConfig::config()->file_mappings = array(
     *          "themes/themename/less/layout.less" => "themes/themename/css/layout.css",
     *          "themes/themename/less/typography.less" => "themes/themename/css/typography.css"
     *      );
     * 
     * NOTE in the case above you must provide path's relative to
     * Silverstripe's root directory.
     * 
     * You can also provide just filenames. If you do this then
     * LessCompiler will assume you are using the default theme, that
     * the less files are in a directory called "less" and the css files
     * are in a directory called "css". The below would be the
     * equivalent to the aboce example.
     * 
     *      LessCompilerConfig::config()->file_mappings = array(
     *          "layout.less" => "layout.css",
     *          "typography.less" => "typography.css"
     *      );
     * 
     * @var array
     * @config
     */
    private static $file_mappings = array();
     
    /**
     * Do we want to compress the output files?
     * 
     * @var Boolean
     * @config
     */
    private static $compress = true;
     
    /**
     * The url root to prepend to any relative image or
     * @import urls in the .less file.
     * 
     * This defaults to "../" as it is assumed that all images are
     * located in a directory above the less files
     * 
     * @var String
     * @config
     */
    private static $root_path = "../";

    /**
     * Should less files be compiled only on dev? If set to false
     * less files will be compiled on all environments (dev,
     * stage, live)
     * 
     * @var Boolean
     * @config
     */
    private static $only_dev = true;
}
