<?php

class JSONView {
    public function response($body, $status) {
        header("Content-Type: application/json");
        $statusText = $this->_requestStatus($status);
        header("HTTP/1.1 $status $statusText");
        echo json_encode($body);
    }

    private function _requestStatus($code) {
        $status = array(
            200 => "OK",
            201 => "Created",
            400 => "Bad Request",
            404 => "Not Found",
            500 => "Internal Server Error",
        );

        // Si el código de estado no existe en el array, se establece en 500
        if (!isset($status[$code])) {
            $code = 500;
        }

        return $status[$code];
    }
}
