fhand = open('mbox-short.txt')
for γραμμή in fhand:
    γραμμή = γραμμή.rstrip()
    # Παράκαμψη `αδιάφορων` γραμμών
    if not γραμμή.startswith('From:'):
        continue
    # Επεξεργασία 'ενδιαφερόντων' γραμμών
    print(γραμμή)
