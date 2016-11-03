<?php

class adminvertrag
{
    public function doVertrag($params)
    {
        $action = isset($params[0]) ? $params[0] : false;
        switch ($action) {
            case 'create': {
                $this->doCreate();
            }
        }
    }

    public function doCreate()
    {
        global $template;
        // Do something with the input-data. At least create a PDF
        $out['Vorname'] = _request('vorname', '');
        $out['Nachname'] = _request('nachname', '');
        $out['Telefon'] = _request('phone', '');
        $out['Geburtstag'] = _request('birthday', '');
        $out['Geburtsort'] = _request('birthplace', '');
        $out['Paketwahl'] = _request('paket', '');
        $out['IBAN'] = _request('iban', '');
        $out['BIC'] = _request('bic', '');
        $out['Kontoinhaber'] = _request('kontoinhaber', '');

        $template->assign('out', $out);
        $template->display('vertrag.pdf.php');

        exit();
    }
}

$admin_vertrag = new adminvertrag();
