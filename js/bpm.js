/** BPM-Berechnung **/
var beats = 0;
var ms = 0;
var ms2 = 0;
var measurement = 60000;	// 60 Sekunden
var beatcount = 0;
function beat() {
    s = new Date;
    ms = s.getTime();
    if(ms-ms2>=2000) {
        beatcount = 0;
        ms1=0;
    }
    if(beatcount==0)
    {
        ms1 = ms;
        beatcount = 1;
    }
    else {
        bpm = measurement*beatcount / (ms2+1-ms1);
        beatcount++;	// Beats hochzÃ¤hlen
					
    }
                    
    ms2 = ms;	// Differenzwert
    did('anzbeats',beatcount);
    did('bpm_now',bpm);
		
}
function did(id,wrl) {
    d = document.getElementById(id);
    d.innerHTML = wrl;
}
