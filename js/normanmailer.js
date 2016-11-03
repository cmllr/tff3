var formular = {
    'Name': 'text',
    'email': 'text',
    'Website': 'text',
    'Kommentar': 'comment',
    'fight': 'cbh',
    'Mail verschicken': 'submit'
};
var f;

function norman_mailer(bid) {
    var data;
    f = document.createElement('form');
    f.setAttribute('method', 'post');
    f.setAttribute('action', '[{$PAGEROOT}]contact/save/' + bid);
    for (data in formular) {
        def = (formular[data]);
        g = document.createElement('legend');
        g.innerHTML = data;
        switch (def) {
            case 'text':
                l = document.createElement('label');
                i = document.createElement('input');
                i.setAttribute('type', 'text');
                i.setAttribute('class', 'textfeld');
                i.setAttribute('name', data);
                break;
            case 'comment':
                l = document.createElement('label');
                i = document.createElement('textarea');
                i.setAttribute('type', 'text');
                i.setAttribute('cols', 80);
                i.setAttribute('rows', 25);
                i.setAttribute('class', 'textfeld multirow')
                i.setAttribute('name', data);
                break;
            case 'cbh':
                i = document.createElement('input');
                i.setAttribute('type', 'checkbox');
                i.setAttribute('name', data);
                i.setAttribute('value', 1);
                i.setAttribute('style', 'display:none');
                break;
            case 'submit':
                l = document.createElement('label');
                i = document.createElement('input');
                i.setAttribute('type', 'submit');
                i.setAttribute('name', data);
                i.setAttribute('value', 'Abschicken');
                break;

        }
        if (def != 'cbh') {
            l.appendChild(g);
        }
        l.appendChild(i);
        f.appendChild(l);

    }
    document.getElementById('nm').appendChild(f);
}