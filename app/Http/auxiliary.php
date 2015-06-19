<?php
function active($uris) {
    if (is_array($uris)) {
        foreach($uris as $uri) {
            if(Request::is($uri)) {
                return 'open';
            }
        }
        return '';
    }
    return Request::is($uris) ? 'active' : '';
}


