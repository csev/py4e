import pysrt

info = {
"Ch01.srt" : [ "00:00:12:25", "12:22:21:29", "21:36:36:15", "36:13:45:07", "45:03:55:52"] ,
"Ch02.srt" : [ "00:00:20:04", "20:01:43:03"],
"Ch03.srt" : [ "00:00:14:38", "14:34:26:41", "26:37:38:20"],
"Ch05.srt" : [ "00:00:21:17", "21:18:36:28", "36:27:46:48"] 
}

for k,v in info.items() :
    print k,v
    subs = pysrt.open(k)
    count = 1
    for ran in v: 
        t = ran.split(':')
        if len(t) != 4 : 
            print "Bad value ", ran
            quit()
        nsrt = subs.slice(starts_after={'minutes': int(t[0]), 'seconds': int(t[1])}, 
            ends_before={'minutes': int(t[2]), 'seconds': int(t[3])})
        nsrt.shift(seconds=-1*(int(t[0])*60+int(t[1])))
        ind = 1
        for n in nsrt:
            n.index = ind
            ind = ind + 1
        nfil = k.replace(".srt",'-'+str(count)+".srt");
        count = count + 1
        print nfil
        nsrt.save(nfil)
        
