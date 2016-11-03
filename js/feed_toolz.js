var xmlHttp = null;
try {
    // Mozilla, Opera, Safari sowie Internet Explorer (ab v7)
    xmlHttp = new XMLHttpRequest();
} catch (e) {
    try {
        // MS Internet Explorer (ab v6)
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
        try {
            // MS Internet Explorer (ab v5)
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = null;
        }
    }
}
var co;
function set_viewport() {
    bo = document.getElementById('menu');
    co = document.getElementById('contents');
    h = window.innerHeight;
    bo.style.height = h + 'px';
    co.style.height = h + 'px';
}


set_viewport();
window.onresize = function(event) {
    set_viewport();
}

function load_feed(id) {
    cont = document.getElementById('contents');
    co.scrollTop = 0;
    if (xmlHttp) {
        co.innerHTML = '<img src="'+WEBROOT+'web/ajax.gif" />';
        xmlHttp.open('GET', WEBROOT+'reader/getfeed/' + id + '/?ajax=' + id + '&nohead=1', true);
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                co.innerHTML = (xmlHttp.responseText);
            }
        };
        xmlHttp.send(null);
    }
    return false;
}
