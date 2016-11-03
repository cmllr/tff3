<?php

class music
{
    public static function doDefault()
    {
        /* MediaBrowser ansteuern */
        global $TPL, $SQL, $template;
        $media = _request('media', 0);
        $TPL['music']['albums'] = $SQL->fetch('SELECT * FROM '.DB.'albums ORDER BY alb_id desc');
        foreach ($TPL['music']['albums'] as $album => $krams) {
            $albtitle[$krams['alb_id']] = $krams['alb_title'];
            $albart[$krams['alb_id']] = $krams['artwork'];
            $tracks[$krams['alb_id']] = $SQL->fetch('SELECT * FROM '.DB.'songs where alb_id = '.$media);
        }
        reset($TPL);
        $albums = $TPL['music']['albums'];
        $keys = 'Download, MP3, OGG, XM, RNS, XRNS, ';
        // Liste vorbereiten
        foreach ($albums as $row => $value) {
            $albums[$row]['url'] = urlencode($value['alb_title']);
            $keys .= $value['alb_title'].', ';
        }
        $template->assign('PAGETITLE', 'Musik');

        reset($albums);
        // Array neu sortieren, falls MEDIA gesetzt wurde
        $template->assign('albums', $albums);

        if (isset($tracks[$media])) {
            foreach ($tracks[$media] as $row => $value) {
                if (strpos($value['filename'], '.mp3') or strpos($value['filename'],
                        '.ogg')) {
                    $tracks[$media][$row]['stream'] = true;
                }
                $tracks[$media][$row]['songname_url'] = urlencode($value['song_name']);
                $tracks[$media][$row]['filename'] = urlencode($value['filename']);
            }
            reset($tracks);
            $template->assign('tracks', $tracks[$media]);
            $template->assign('KEYWORDS', $keys);
            $template->assign('albumart', $albart[$media]);
            $template->assign('albumtitle', $albtitle[$media]);
            $template->assign('PAGETITLE', $albtitle[$media]);
        }
    }

    // Album auswählen
    public function doAlbum($entry)
    {
        global $SQL, $template;
        $check = isset($entry[0]) ? _sanitize($entry[0], '') : false;
        if (!$check) {
            $check = 0;
        }

        $check = mysql_escape_string(urldecode($check));

        $albid = $SQL->fetch('SELECT * FROM '.DB.'albums where alb_title="'.$check.'"');
        if (!$albid) {
            return false;
        }

        $media = $albid[0]['alb_id'];
        $TPL['music']['albums'] = $SQL->fetch('SELECT * FROM '.DB.'albums ORDER BY alb_id desc');
        foreach ($TPL['music']['albums'] as $album => $krams) {
            $tracks[$krams['alb_id']] = $SQL->fetch('SELECT * FROM '.DB.'songs where alb_id = '.$media);
        }
        reset($TPL);
        $albums = $TPL['music']['albums'];

        // Liste vorbereiten
        foreach ($albums as $row => $value) {
            $albums[$row]['url'] = urlencode($value['alb_title']);
        }
        reset($albums);
        // Array neu sortieren, falls MEDIA gesetzt wurde
        $template->assign('albums', $albums);

        if (isset($tracks[$media])) {
            foreach ($tracks[$media] as $row => $value) {
                if (strpos($value['filename'], '.mp3') or strpos($value['filename'],
                        '.ogg')) {
                    $tracks[$media][$row]['stream'] = true;
                }
                $tracks[$media][$row]['songname_url'] = urlencode($value['song_name']);
                $tracks[$media][$row]['filename'] = urlencode($value['filename']);
            }
            reset($tracks);
            $template->assign('tracks', $tracks[$media]);
            $template->assign('PAGETITLE', 'Music');
        }
    }

    public function doPls($id, $download = false)
    {
        global $SQL;
        // Generate Playlist
        if (!$download) {
            header('Content-type: audio/x-Mpegurl');
        }
        $id = _sanitize($id[0], 0);
        if ($id != 0) {
            $pls = '';
            $file = $SQL->fetch('SELECT * FROM '.DB.'songs where song_id='.$id);
            if (count($file)) {
                if ($download) {
                    header('location:'.MP3ROOT.rawurlencode($file[0]['filename']));
                    exit();
                }
                $pls .= MP3ROOT.rawurlencode($file[0]['filename'])."\r\n";
            }
            echo $pls;
            exit();
        }
    }

    public function doDownload($id)
    {
        global $SQL;
        $this->doPls($id, 1);
    }
}
