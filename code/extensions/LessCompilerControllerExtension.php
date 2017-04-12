<?php

class LessCompilerControllerExtension extends Extension
{
    
    /**
     * Perform the crunch work of compiling less files on initilisation,
     * but only do this when we are running on dev (and the file is in
     * need of updating).
     * 
     */
    public function onBeforeInit() {
        $only_dev = LessCompilerConfig::config()->only_dev;
        
        // Only check and compile either on dev, or on all environments (if set)
        if (!$only_dev || $only_dev && Director::isDev()) {
            $files = LessCompilerConfig::config()->file_mappings;
            $root_path = LessCompilerConfig::config()->root_path;
            $temp_folder = TEMP_FOLDER;
            
            if (is_array($files)) {
                $theme_dir = Controller::join_links(
                    "themes",
                    SSViewer::current_theme()
                );
                $base_theme = Controller::join_links(
                    $theme_dir,
                    SSViewer::current_theme()
                );
                
                $options = array('cache_dir' => $temp_folder);
                
                if (LessCompilerConfig::config()->compress) {
                    $options['compress'] = true;
                }
                
                // First loop through all files and deal with inputs
                foreach ($files as $input => $output) {
                    if ($input && $output) {
                        
                        // Does output and input contain a path
                        if (strpos($input, '/') === false) {
                            $input = Controller::join_links(
                                $theme_dir,
                                "less",
                                $input
                            );
                        }
                        
                        if (strpos($output, '/') === false) {
                            $output = Controller::join_links(
                                $theme_dir,
                                "css",
                                $output
                            );
                        }
                        
                        // Now append the full system path to the input
                        // and output file.
                        $input = Controller::join_links(BASE_PATH, $input);
                        $output = Controller::join_links(BASE_PATH, $output);
                        
                        // Finally try to compile our less files
                        try {
                            $css_file_name = Less_Cache::Get(
                                array( $input => $root_path),
                                $options
                            );
                            $css = file_get_contents(Controller::join_links($temp_folder,$css_file_name));
                            
                            $output_file = fopen($output, "w");
                            fwrite($output_file, $css);
                            fclose($output_file);
                        } catch (exception $e) {
                            error_log($e->getMessage());
                        }
                    }
                }
            }
        }
    }
    
}
