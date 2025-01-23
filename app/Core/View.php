<?php

namespace App\Core;

class View {

    /**
     * Render a view within a layout.
     * 
     * @param string $layout  The layout to be used (e.g., 'templates/layout').
     * @param array  $data    The data to be passed to the view (e.g., page title, content, etc.).
     */
    public static function render($layout, $data = []) {
        // Extract the data array into variables for easier use in the layout/view
        extract($data);

        // Start buffering the content
        ob_start();

        // Include the content view file dynamically
        include VIEW_PATH . "/{$data['view']}.php";  // Use 'view' from the data array for the content

        // Get the contents of the output buffer and clean it
        $content = ob_get_clean();

        // Now render the layout, passing the content and other data
        include VIEW_PATH . "/{$layout}.php";
    }
    
}
