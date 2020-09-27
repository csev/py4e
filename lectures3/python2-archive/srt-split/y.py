import pysrt

shifts = {
"Ch01-4.srt" : -1,
"Ch01-5.srt" : -1.5,
"Ch02-2.srt" : -2.3,
"Ch03-2.srt" : -1.25,
"Ch03-3-manual.srt" : -1
}

for k,v in shifts.items() :
    print k,v
    subs = pysrt.open(k)
    subs.shift(seconds=v);
    nfil = k.replace(".srt",'-shift.srt');
    print nfil
    subs.save(nfil)
        
