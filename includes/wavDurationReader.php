<?php

function wavDur($file)
{
    $fp = fopen($file, 'r');
    if (fread($fp, 4) == "RIFF") {
        fseek($fp, 20);
        $rawheader = fread($fp, 16);
        $header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits', $rawheader);
        $pos = ftell($fp);
        while (fread($fp, 4) != "data" && !feof($fp)) {
            $pos++;
            fseek($fp, $pos);
        }
        $rawheader = fread($fp, 4);
        $data = unpack('Vdatasize', $rawheader);
        $sec = $data["datasize"] / $header["bytespersec"];
        $minutes = intval(($sec / 60) % 60);
        $seconds = intval($sec % 60);
        if ($minutes < 10) {
            return str_pad($minutes, 1, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
        } else {
            return str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
        }
    }
}
