
<?php

//This is the ajax loading indicator, you can use this function to call this indicator, on any page. 
function Loading_indicator() {
    $var_load_in = '<img src="dist/img/ajax-loader_icon.gif" class="pull-right responsive" id="loading-indicator" style="display: none;" />';
    return($var_load_in);
}

