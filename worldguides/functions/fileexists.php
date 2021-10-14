<?php
function get_http_response($url) {
    $headers = get_headers($url);
    return substr($headers[0],9,3);
}
?>